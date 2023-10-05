<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");
// include main configuration file 
require_once PROJECT_ROOT_PATH . "/inc/config.php";
// include the base controller file 
require_once PROJECT_ROOT_PATH . "/Controller/Api/BaseController.php";
// include the model files 
require_once PROJECT_ROOT_PATH . "/Model/UserModel.php";
require_once PROJECT_ROOT_PATH . "/Model/BookModel.php";
require_once PROJECT_ROOT_PATH . "/Model/ExchangeModel.php";
require_once PROJECT_ROOT_PATH . "/Model/MessageModel.php";
?>