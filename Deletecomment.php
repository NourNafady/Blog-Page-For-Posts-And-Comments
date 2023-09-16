<?php
session_start();
require_once("classes.php");
$user = unserialize($_SESSION["user"]);
if (!empty($_GET["number2"])) {
    $user->DeleteComment($_GET["number2"]);
    if (!empty($_GET["from"]) && $_GET["from"] == 'my') {
        header("location:myposts.php");
    } 
    else {
        header("location:home.php");
    }
}
