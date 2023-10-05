<?php
session_start();
$_SESSION["loggedin"] = false;
$_SESSION["user"] ="";
session_destroy();
header("Location: home.php");
die();
?>