<?php
session_start();
require_once('classes.php');
$user = unserialize($_SESSION["user"]);
if (empty($_GET["number"]) || empty($_POST["comment"])) {
    header("location: AddComment.php?msg=empty-field");
}
else
{
    $result = $user->addComment($_POST["comment"], $_GET["number"], $user->id);
    header("location:AddComment.php?msg=done");
}
