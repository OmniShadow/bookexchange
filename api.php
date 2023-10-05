<?php
session_start();

require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/BookController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/ExchangeController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/MessageController.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if (!isset($uri[3])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
$resource = $uri[3];
$methodName = $uri[4];
switch ($resource) {
    case "user":
        $objFeedController = new UserController();
        break;
    case "book":
        $objFeedController = new BookController();
        break;
    case "exchange":
        $objFeedController = new ExchangeController();
        break;
    case "message":
        $objFeedController = new MessageController();
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
}

if (!empty($methodName)) {
    if (in_array($methodName, $objFeedController->AVAILABLE_METHODS))
        $methodName = $methodName . 'Action';
    else
        $methodName = "resourceAction";

    $objFeedController->{$methodName}();
} else {
    header("HTTP/1.1 404 Not Found");
    exit();
}

?>