<?php
session_start();
require_once("classes.php");
$user = unserialize($_SESSION["user"]);
if (!empty($_GET["number"])) {
  $user->DeletePost($_GET["number"]);
  header("location:myposts.php?msg=delete");
}