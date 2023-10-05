<?php
class ExchangeController extends BaseController
{
    public function __construct()
    {
        $this->AVAILABLE_METHODS = ["list", "create"];
    }
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        $responseData = array();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                //TO IMPLEMENT
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
    public function createAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        $responseData = array("message" => $_POST["offerente"]);


        if (strtoupper($requestMethod) == 'POST') {
            try {
                $exchangeModel = new ExchangeModel();
                $responseData["status"] = $exchangeModel->createExchange(
                    $_POST["offerente"],
                    $_POST["proponente"],
                    $_POST["libroOfferto"],
                    $_POST["libroProposto"],
                );
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
                    $scambioId = $uriSegments[4];
                    if (!isset($uriSegments[5]))
                        throw new Error("method not specified");
                    $subMethod = $uriSegments[5];
                    switch ($subMethod) {
                        default:
                            throw new Error("method not supported");
                        case 'updateStatus':
                            $exchangeId = $_POST["scambioId"];
                            $exchangeStatus = $_POST["stato"];
                            $exchangeModel = new ExchangeModel();
                            $responseData["stato"] = $exchangeModel->updateExchangeStatus($exchangeId, $exchangeStatus);
                            break;
                        case 'commit':
                            $exchangeModel = new ExchangeModel();
                            $responseData["stato"] = $exchangeModel->commitExchange($scambioId);
                            break;
                    }
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