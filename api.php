<?php

require __DIR__ . "/inc/bootstrap.php";
require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
require PROJECT_ROOT_PATH . "/Controller/Api/BookController.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if (!isset($uri[3])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
$resource = $uri[3];
$methodName = $uri[4];

if (is_numeric($methodName)) {
    $methodName = "resource";
}

switch ($resource) {
    case "user":
        $objFeedController = new UserController();
        break;

    case "book":
        $objFeedController = new BookController();
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit(); 
}
if (!empty($methodName)) {
    $methodName = $methodName . 'Action';
    $objFeedController->{$methodName}();
} else {
    header("HTTP/1.1 404 Not Found");
    exit();
}

?>