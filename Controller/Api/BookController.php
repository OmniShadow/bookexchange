<?php
class BookController extends BaseController
{

    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = strtoupper($_SERVER["REQUEST_METHOD"]);
        $arrQueryStringParams = $this->getQueryStringParams();

        switch ($requestMethod) {
            default:
                $strErrorDesc = 'Method not supported';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                break;
            case 'GET':
                try {
                    $bookModel = new BookModel();
                    $q = "";
                    $limit = 10;

                    if (isset($arrQueryStringParams['q'])) {
                        $q = $arrQueryStringParams['q'];
                    }

                    if (isset($arrQueryStringParams['limit'])) {
                        $limit = $arrQueryStringParams['limit'];
                    }

                    $arrBooks = $bookModel->getBooks($q, $limit);

                    $responseData = json_encode($arrBooks);

                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . 'Something went wrong!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                break;
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

    public function resourceAction()
    {
        $strErrorDesc = '';
        $uriSegments = $this->getUriSegments();
        $requestMethod = strtoupper($_SERVER["REQUEST_METHOD"]);
        $responseData = array();
        switch ($requestMethod) {
            default:
                $strErrorDesc = 'Method not supported';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                break;
            case 'GET':
                try {
                    $bookModel = new BookModel();
                    $lastSegment = $uriSegments[4];
                    $bookId = "";
                    if (!empty($lastSegment)) {
                        $bookId = $lastSegment;
                    }

                    $book = $bookModel->getBook($bookId);
                    $responseData = json_encode($book);
                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . 'Something went wrong!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                break;
            case 'POST':
                try {
                    $bookModel = new BookModel();
                    $userId = $_POST["userId"];
                    $bookId = $uriSegments[4];
                    $description = $_POST["description"];



                    /*TO IMPLEMENT PROPER SESSION CHECKING*/
                    // if (isset($_COOKIE["user"]))
                    //     $sessionId = $_COOKIE["user"];

                    // if ($sessionId == $_SESSION["user"]) {
                    //     $responseData["success"] = $bookModel->addBook($userId, $bookId,$description);
                    //     $responseData = json_encode($responseData);
                    // } else {
                    //     $strErrorDesc = 'Something went wrong!';
                    //     $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                    // }
                    /**************************************/

                    /*TEMPORARY FOR TESTING ONLY*/
                    $responseData["status"] = $bookModel->addBook($userId, $bookId, $description);
                    if ($responseData["status"])
                        $responseData["message"] = "Book added successfully";
                    else
                        $responseData["message"] = "Book not added";
                    $responseData = json_encode($responseData);
                    /*TEMPORARY FOR TESTING ONLY*/

                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . 'Something went wrong!';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
                break;
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


}