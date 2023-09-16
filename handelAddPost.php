<?php
session_start();
require_once('classes.php');

// var_dump($_POST);

if (empty($_POST["content"]) || empty($_FILES["image"])) {
   
    header("location: profile.php?msg=empty_field");
}
else
{
    $user = unserialize($_SESSION["user"]);
    $content = htmlspecialchars(trim($_POST["content"]));
    
    $extention = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

   $newname = "images/posts/". date("YmdHis"). "." . $extention;
   $user_id = $user->id;
   move_uploaded_file($_FILES["image"]["tmp_name"], $newname);

   $result = $user->addPost($content, $newname, $user_id);
   header("location: profile.php?msg=done");

}


