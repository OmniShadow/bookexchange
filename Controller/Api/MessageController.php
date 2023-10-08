<?php
class MessageController extends BaseController
{
    public function __construct()
    {
        $this->AVAILABLE_METHODS = ["send", "startconv"];
    }

    public function startconvAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $responseData = array();

        switch (strtoupper($requestMethod)) {
            case 'POST':
                try {
                    $destinatario = $_POST["userId"];

                    if (!isset($_SESSION["user"]))
                        throw new Error("user not logged in\n");
                    if ($_SESSION["user"]["id"] == $destinatario)
                        throw new Error("user not authorized\n");
                    $mittente = $_SESSION["user"]["id"];

                    $messageModel = new MessageModel();

                    $conversazione = $messageModel->hasConversationWith($mittente, $destinatario);
                    if (!$conversazione) {
                        $responseData["status"] = $messageModel->createConversation(
                            $mittente,
                            $destinatario,
                        );
                        $conversazione = $messageModel->getUserConversations($mittente);
                        if (empty($conversazione))
                            throw new Error("Errore nella creazione della conversazione");
                        $conversazione = $conversazione[0]["id"];
                    }
                    else
                        $responseData["status"] = true;
                    $responseData["conversazione"] = $conversazione;

                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . 'Something went wrong!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                break;
            default:
                $strErrorDesc = 'Method not supported';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
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

    public function sendAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $responseData = array();

        switch (strtoupper($requestMethod)) {
            case 'POST':
                try {
                    //TO IMPLEMENT
                    $mittente = $_POST["mittente"];
                    $destinatario = $_POST["destinatario"];
                    $conversazioneId = $_POST["conversazione"];
                    $messaggio = $_POST["messaggio"];

                    // if (!isset($_SESSION["user"]))
                    //     throw new Error("user not logged in\n");
                    // if ($_SESSION["user"]["id"] != $mittente)
                    //     throw new Error("user not authorized\n");


                    $messageModel = new MessageModel();
                    $responseData["status"] = $messageModel->sendMessage(
                        $conversazioneId,
                        $messaggio,
                        $mittente,
                        $destinatario,
                    );
                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . 'Something went wrong!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                break;
            default:
                $strErrorDesc = 'Method not supported';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
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
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        $responseData = array();

        switch (strtoupper($requestMethod)) {
            case 'GET':
                try {
                    //TO IMPLEMENT
                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . 'Something went wrong!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                break;
            default:
                $strErrorDesc = 'Method not supported';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
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
    public function resourceAction()
    {
        $strErrorDesc = '';
        $requestMethod = strtoupper($_SERVER["REQUEST_METHOD"]);
        $uriSegments = $this->getUriSegments();
        $responseData = array();


        switch ($requestMethod) {
            default:
                $strErrorDesc = 'Method not supported';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                break;
            case 'GET':
                try {


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
}