<?php
class UserController extends BaseController
{
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
                    $userModel = new UserModel();
                    $userId = $uriSegments[4];
                    $user = $userModel->getUser($userId);
                    if ($user == false) {
                        throw new Error("User not Found");
                    }

                    $responseData["user"] = $user;
                    if (isset($uriSegments[5])) {
                        $subMethod = $uriSegments[5];
                        switch ($subMethod) {
                            case 'books':
                                $bookIds = $userModel->getUserBookIds($userId);
                                //get list of books from google API
                                $responseData["books"] = $bookIds;
                                break;
                            default:
                                throw new Error("Action not supported");
                        }
                    }

                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . 'Something went wrong!';
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