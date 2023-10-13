<?php
function file_get_contents_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

class UserController extends BaseController
{

    public function __construct()
    {
        $this->AVAILABLE_METHODS = ["list", "login", "register", "logout"];
    }
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();
                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }

                $arrUsers = $userModel->getUsers($intLimit);

                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong!';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }




    private function userProfile($user, $uriSegments)
    {

        $profilePageTemplate = file_get_contents("profile.html");
        $personalNavInfo = "";
        if (isset($_SESSION["user"]) && $_SESSION["user"]["id"] == $user["id"]) {
            $personalNavInfo = file_get_contents("templates/personalInfoNavTemplate.html");
            $to_replace_nav = array(
                '{userId}' => $user["id"],
            );
            $personalNavInfo = strtr($personalNavInfo, $to_replace_nav);
            $profilePageTemplate = strtr($profilePageTemplate, array('{navInfo}' => $personalNavInfo));
        }
        $to_replace = array(
            '{userId}' => $uriSegments[4],
            '{username}' => $user["username"],
            '{avatar}' => $user["avatar"],
            '{email}' => $user["email"],
            '{subMenu}' => "",
            '{navInfo}' => "",
        );


        if (isset($uriSegments[6])) {
            $subMenu = $uriSegments[6];
            $subMenuTemplate = "";

            $to_replace_subMenu = array();
            switch ($subMenu) {
                case 'info':
                    $subMenuTemplate = file_get_contents("userinfo.html");
                    $userModel = new UserModel();
                    $books = $userModel->getUserBooks($user["id"]);
                    $to_replace_some_books = array();
                    $to_replace_subMenu = array(
                        '{username}' => $user["username"],
                        '{avatar}' => $user["avatar"],
                        '{email}' => $user["email"],
                        '{userId}' => $user["id"],
                        '{loggedUser}' => isset($_SESSION["user"]) ? $_SESSION["user"]["id"] : "",
                        '{book1}' => "",
                        '{book2}' => "",
                        '{book3}' => "",
                    );

                    if (!empty($books)) {

                        $to_replace_some_books = array(
                            '{book1}' => array_key_exists(0, $books) ? $books[0]["titolo"] : "",
                            '{book2}' => array_key_exists(1, $books) ? $books[1]["titolo"] : "",
                            '{book3}' => array_key_exists(2, $books) ? $books[2]["titolo"] : "",

                        );
                    }
                    $to_replace_subMenu = array_merge($to_replace_subMenu, $to_replace_some_books);
                    $to_replace = array_merge($to_replace, array('{infoActive}' => 'active', ));
                    break;
                case 'books':
                    $subMenuTemplate = $this->listUserBooks($user);
                    $to_replace = array_merge($to_replace, array('{libriActive}' => 'active', ));
                    break;
                case 'addbook':
                    if (!isset($_SESSION["user"]))
                        break;
                    if ($_SESSION["user"]["id"] != $user["id"])
                        break;
                    $subMenuTemplate = file_get_contents("addbook.html");
                    $to_replace = array_merge($to_replace, array('{addActive}' => 'active', ));
                    $query = "";
                    $queryPresente = "";
                    if (isset($_GET["q"])) {
                        $query = $_GET["q"];
                        $queryPresente = true;
                    }
                    $to_replace_subMenu = array(
                        '{query}' => "value =" . '"' . $query . '"',
                        '{queryPresente}' => $queryPresente,
                    );
                    break;
                case 'exchanges':
                    if (!isset($_SESSION["user"]))
                        break;
                    if ($_SESSION["user"]["id"] != $user["id"])
                        break;
                    $subMenuTemplate = $this->listaExchanges($user);
                    $to_replace = array_merge($to_replace, array('{scambiActive}' => 'active', ));
                    break;
                case 'messages':
                    if (!isset($_SESSION["user"]))
                        break;
                    if ($_SESSION["user"]["id"] != $user["id"])
                        break;
                    if (isset($uriSegments[7])) {
                        //lista messaggi conversazione
                        $conversazioneId = $uriSegments[7];
                        $subMenuTemplate = $this->listaMessaggi($conversazioneId, $user);
                    } else {
                        $subMenuTemplate = $this->listaConversazioni($user);
                    }
                    $to_replace = array_merge($to_replace, array('{messaggiActive}' => 'active', ));
                    break;
                default:
                    break;
            }

            $subMenuPage = strtr($subMenuTemplate, $to_replace_subMenu);
            $to_replace["{subMenu}"] = $subMenuPage;
        }

        $profilePage = strtr($profilePageTemplate, $to_replace);

        return $profilePage;

    }
    public function resourceAction()
    {
        $strErrorDesc = '';
        $requestMethod = strtoupper($_SERVER["REQUEST_METHOD"]);
        $uriSegments = $this->getUriSegments();
        $responseData = array();
        $isJson = true;

        switch ($requestMethod) {
            default:
                $strErrorDesc = 'Method not supported';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                break;
            case 'GET':
                try {
                    $userModel = new UserModel();
                    $userId = $uriSegments[4];
                    $user = $userModel->getUser($userId)[0];
                    if ($user == false) {
                        throw new Error("User not Found");
                    }

                    $responseData["user"] = $user;
                    if (isset($uriSegments[5])) {
                        $subMethod = $uriSegments[5];
                        switch ($subMethod) {
                            case 'books':
                                $books = $userModel->getUserBooks($userId);
                                $responseData = $books;
                                break;
                            case 'profile':
                                $user["id"] = $userId;
                                $isJson = false;
                                $responseData = $this->userProfile($user, $uriSegments);
                                break;
                            default:
                                throw new Error("Action not supported");
                        }
                    }

                } catch (Error $e) {
                    $strErrorDesc = 'Something went wrong!' . "\\n" . $e->getMessage();
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                break;

            case 'POST':
                try {

                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . 'Something went wrong!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                break;

        }


        if (!$strErrorDesc) {
            if ($isJson)
                $this->sendOutput(
                    json_encode($responseData),
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
            else
                $this->sendOutput(
                    $responseData,
                );

        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function registerAction()
    {

        $strErrorDesc = '';
        $requestMethod = strtoupper($_SERVER["REQUEST_METHOD"]);
        $responseData = array();
        switch ($requestMethod) {
            default:
                $strErrorDesc = 'Method not supported';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                break;
            case 'POST':
                try {
                    $userModel = new UserModel();
                    $file_name = $_FILES["avatar"]["name"];
                    if (empty($file_name)) {
                        $target_file = "/bookexchange/imgs/useravatars/default-avatar.png";
                    } else {
                        $target_dir = "imgs/useravatars/";
                        $target_file = $target_dir . $_POST["email"] . "avatar." . strtolower(pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION));
                        move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
                        $target_file = "/bookexchange/$target_file";
                    }
                    $username = $_POST["username"];
                    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $email = $_POST["email"];

                    $responseData["status"] = $userModel->registerUser($username, $email, $password, $target_file);
                    $responseData["message"] = $userModel->getMessage();
                    if ($responseData["status"])
                        $responseData["html"] = file_get_contents("registersuccess.html");
                    else
                        $responseData["html"] = file_get_contents("registerfailed.html");

                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . 'Something went wrong!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                break;

        }
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData["html"],
                array('refresh:3, url=/bookexchange/login.php', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }

    }

    public function loginAction()
    {
        $strErrorDesc = '';
        $requestMethod = strtoupper($_SERVER["REQUEST_METHOD"]);
        $responseData = array();

        switch ($requestMethod) {
            default:
                $strErrorDesc = 'Method not supported';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                break;
            case 'POST':
                try {
                    $userModel = new UserModel;

                    $userEmail = $_POST["email"];
                    $userPassword = $_POST["password"];
                    $responseData["status"] = $userModel->loginUser($userEmail, $userPassword);
                    $responseData["message"] = $userModel->getMessage();
                    if ($responseData["status"]) {
                        $_SESSION["loggedin"] = true;
                        $user = $responseData["status"];
                        $_SESSION["user"] = $user[0];
                    } else {
                        $_SESSION["loggedin"] = false;
                    }

                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . 'Something went wrong!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                break;

        }


        if (!$strErrorDesc) {
            if ($responseData["status"])
                $this->sendOutput(
                    "",
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK', 'Location: /bookexchange/loginsuccess.php')
                );
            else
                $this->sendOutput(
                    "",
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK', 'Location: /bookexchange/loginfailed.php')
                );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }

    }

    public function logoutAction()
    {
        $strErrorDesc = '';
        $requestMethod = strtoupper($_SERVER["REQUEST_METHOD"]);
        $responseData = array();

        switch ($requestMethod) {
            default:
                $strErrorDesc = 'Method not supported';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                break;
            case 'POST':
                try {
                    $userModel = new UserModel;
                    $userId = $_POST["id"];

                    if (isset($_SESSION["user"]["id"]) && $_SESSION["user"]["id"] == $userId) {
                        $responseData["status"] = $userModel->logoutUser($userId);
                        if (!$responseData["status"])
                            throw new Error("System error ");
                        session_destroy();
                    } else
                        throw new Error("User not logged in");

                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . ' Something went wrong!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                break;

        }


        if (!$strErrorDesc) {
            $this->sendOutput(
                json_encode($responseData),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    private function listUserBooks($user)
    {
        $subMenuTemplate = file_get_contents("templates/userBooksTemplate.html");
        $bookTemplate = file_get_contents("templates/booktemplate.html");
        $books = "";
        $userModel = new UserModel();
        $bookModel = new BookModel();

        $userBooks = $userModel->getUserBooks($user["id"]);
        foreach ($userBooks as $userBook) {

            $deleteButton = "";
            $addHref = isset($_SESSION["user"]);
            if (isset($_SESSION["user"]) && $_SESSION["user"]["id"] == $user["id"]) {
                $deleteButton = file_get_contents("templates/deleteBookButtonTemplate.html");
                $to_replace_button = array(
                    '{userId}' => $user["id"],
                    '{descrizione}' => $userBook["descrizione"],
                    '{id}' => $userBook["id"],
                );
                $deleteButton = strtr($deleteButton, $to_replace_button);

            }

            $autoriArray = $bookModel->getBookAuthors($userBook["id"]);
            $autori = "";
            foreach ($autoriArray as $autore) {
                if ($addHref)
                    $autori = $autori . '<a href="/bookexchange/api.php/user/' . $_SESSION["user"]["id"] . '/profile/addbook?q=' . "inauthor:" . $autore["autore"] . '">' . $autore["autore"] . ", </a>";
                else
                    $autori = $autori . $autore["autore"];
            }
            $categorieArray = $bookModel->getBookCategories($userBook["id"]);
            $categorie = "";
            foreach ($categorieArray as $categoria) {
                if ($addHref)
                    $categorie = $categorie . '<a href="/bookexchange/api.php/user/' . $_SESSION["user"]["id"] . '/profile/addbook?q=' . "insubject:" . $categoria["categoria"] . '">' . $categoria["categoria"] . ", </a>";
                else
                    $categorie = $categorie . $categoria["categoria"];
            }

            $to_replace_book = array(
                '{titolo}' => $userBook["titolo"],
                '{id}' => $userBook["id"],
                '{editore}' => $userBook["editore"],
                '{anno}' => $userBook["anno"],
                '{lingua}' => $userBook["lingua"],
                '{autori}' => $autori,
                '{categorie}' => $categorie,
                '{copertina}' => $userBook["copertina"],
                '{deleteButton}' => $deleteButton,
                '{descrizione}' => $userBook["descrizione"],
            );
            $books = $books . strtr($bookTemplate, $to_replace_book);
        }
        $to_replace_subMenu = array(
            '{bookListItems}' => $books,
            '{username}' => $user["username"],
        );
        return strtr($subMenuTemplate, $to_replace_subMenu);
    }

    private function listaConversazioni($user)
    {
        $subMenuTemplate = file_get_contents("templates/userConversazioniTemplate.html");
        $conversazioneTemplate = file_get_contents("templates/conversazioneTemplate.html");
        $conversazioniHtml = "";
        $messageModel = new MessageModel();
        $conversazioni = $messageModel->getUserConversations($user["id"]);
        $userModel = new UserModel();
        foreach ($conversazioni as $conversazione) {

            $destinatarioId = $conversazione["utente1"] != $user["id"] ?
                $conversazione["utente1"] :
                $conversazione["utente2"];
            $destinatario = $userModel->getUser($destinatarioId)[0];
            $messages = $messageModel->getMessages($conversazione["id"]);
            $lastMessage = empty($messages) ? "" : end($messages)["messaggio"];
            $to_replace_conversazione = array(
                '{userId}' => $user["id"],
                '{destinatario}' => $destinatario["username"],
                '{destinatarioId}' => $destinatarioId,
                '{destinatarioAvatar}' => $destinatario["avatar"],
                '{lastMessage}' => $lastMessage,
                '{conversazioneId}' => $conversazione["id"],
                '{stato}' => $destinatario["stato"] == 0 ? "offline" : "online",
                '{statoColor}' => $destinatario["stato"] == 0 ? "color:darkRed" : "color:green",
            );

            $conversazioniHtml = $conversazioniHtml . strtr($conversazioneTemplate, $to_replace_conversazione);

        }
        $to_replace_subMenu = array(
            '{conversazioni}' => $conversazioniHtml,
        );
        return strtr($subMenuTemplate, $to_replace_subMenu);
    }

    private function listaExchanges($user)
    {
        $subMenuTemplate = file_get_contents("templates/userExchangesTemplate.html");
        $exchangeTemplate = file_get_contents("templates/exchangeTemplate.html");
        $exchangeElements = "";

        $userModel = new UserModel();
        $scambi = $userModel->getUserExchanges($user["id"]);

        foreach ($scambi as $scambio) {
            $buttonTemplate = "";
            $buttonTemplate2 = "";
            if ($scambio["offerente_id"] == $user["id"] && $scambio["stato"] == "pending") {
                $buttonTemplate = file_get_contents("templates/acceptExchangeButtonTemplate.html");
                $to_replace_button = array(
                    '{scambioId}' => $scambio["id"]
                );
                $buttonTemplate = strtr($buttonTemplate, $to_replace_button);

                $buttonTemplate2 = file_get_contents("templates/refuseExchangeButtonTemplate.html");
                $to_replace_button = array(
                    '{scambioId}' => $scambio["id"]
                );
                $buttonTemplate2 = strtr($buttonTemplate2, $to_replace_button);
            } else if ($scambio["offerente_id"] != $user["id"] && $scambio["stato"] == "pending") {
                $buttonTemplate = file_get_contents("templates/cancelExchangeButtonTemplate.html");
                $to_replace_button = array(
                    '{scambioId}' => $scambio["id"]
                );
                $buttonTemplate = strtr($buttonTemplate, $to_replace_button);
            }
            $stato = "";
            switch ($scambio["stato"]) {
                case 'pending':
                    $stato = <<<HTML
                    <h4 class="text-muted">Pending...</h4>
HTML;
                    break;
                case 'accepted':
                    $stato = <<<HTML
                    <h4 class="text-success">Accettata</h4>
HTML;
                    break;
                case 'refused':
                    $stato = <<<HTML
                        <h4 class="text-danger">Rifiutata</h4>
HTML;
                    break;
                case 'cancelled':
                    $stato = <<<HTML
                        <h4 class="text-warning">Annullata</h4>
HTML;
                    break;
            }



            $to_replace_exchange = array(
                '{stato}' => $stato,
                '{proponente}' => $scambio["proponente"],
                '{proponenteId}' => $scambio["proponente_id"],
                '{avatarProponente}' => $scambio["proponente_avatar"],
                '{libroPropostoTitolo}' => $scambio["libro_proposto_titolo"],
                '{libroPropostoCopertina}' => $scambio["libro_proposto_copertina"],
                '{offerente}' => $scambio["offerente"],
                '{offerenteId}' => $scambio["offerente_id"],
                '{avatarOfferente}' => $scambio["offerente_avatar"],
                '{libroOffertoCopertina}' => $scambio["libro_offerto_copertina"],
                '{libroOffertoTitolo}' => $scambio["libro_offerto_titolo"],
                '{button1}' => $buttonTemplate,
                '{button2}' => $buttonTemplate2,
            );
            $exchangeElements = $exchangeElements . strtr($exchangeTemplate, $to_replace_exchange);
        }

        $to_replace_subMenu = array(
            '{exchanges}' => $exchangeElements,
            '{username}' => $user["username"],
        );
        return strtr($subMenuTemplate, $to_replace_subMenu);
    }

    private function listaMessaggi($conversazioneId, $user)
    {


        $subMenuTemplate = $this->listaConversazioni($user);

        $messaggiTemplate = file_get_contents("templates/messaggiTemplate.html");
        $messaggioTemplate = file_get_contents("templates/messaggioTemplate.html");

        $messageModel = new MessageModel();
        $messaggi = $messageModel->getMessages($conversazioneId);
        $conversazione = $messageModel->getConversation($conversazioneId)[0];
        $userModel = new UserModel();
        $mittente = $_SESSION["user"]["id"];

        $destinatarioId = $conversazione["utente1"] == $mittente ?
            $conversazione["utente2"] :
            $conversazione["utente1"];
        $destinatario = $userModel->getUser($destinatarioId)[0];



        $messaggiHtml = "";
        foreach ($messaggi as $messaggio) {
            $messageType = $mittente != $messaggio["mittente"] ?
                "float-start ms-4 me-4 bg-secondary text-start" :
                "float-end me-4 ms-4 bg-primary text-end";
            $position = $mittente != $messaggio["mittente"] ?
                "chat-message-left" :
                "chat-message-right";
            $colore = $mittente != $messaggio["mittente"] ?
                "bg-primary text-white" :
                "bg-dark-subtle ";
            $to_replace_messaggio = array(
                '{colore}' => $colore,
                '{datetime}' => $messaggio["data_creazione"],
                '{messageType}' => $messageType,
                '{messaggio}' => $messaggio["messaggio"],
                '{position}' => $position,
                '{utente}' => $mittente != $messaggio["mittente"] ? $destinatario["username"] : $_SESSION["user"]["username"],
                '{avatarUtente}' => $mittente != $messaggio["mittente"] ? $destinatario["avatar"] : $_SESSION["user"]["avatar"],
                '{messageId}' => next($messaggi) == false ? "lastMessage" : $messaggio["id"],
            );

            $messaggiHtml = $messaggiHtml . strtr($messaggioTemplate, $to_replace_messaggio);

        }
        $to_replace_messaggi = array(
            '{destinatarioAvatar}' => $destinatario["avatar"],
            '{destinatario}' => $destinatario["username"],
            '{destinatarioId}' => $destinatario["id"],
            '{mittenteId}' => $mittente,
            '{conversazioneId}' => $conversazioneId,
            '{messaggi}' => $messaggiHtml,
        );

        $messaggiTemplate = strtr($messaggiTemplate, $to_replace_messaggi);

        $to_replace_subMenu = array(
            '{messaggi}' => $messaggiTemplate,
        );
        $subMenuTemplate = strtr($subMenuTemplate, $to_replace_subMenu);
        return $subMenuTemplate;
    }
}