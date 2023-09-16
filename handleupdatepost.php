<?php
session_start();
require_once('classes.php');

var_dump($_POST);
if (empty($_POST["content"]) || empty($_FILES["image"])) {
   
    header("location: updatepost.php?msg=empty_field");
}
else
{
    $user = unserialize($_SESSION["user"]);
    $posts = $user->showMyposts($user->id);
    foreach($posts as $post)
    {
        $id = $post["id"];
    }
    $content = htmlspecialchars(trim($_POST["content"]));
    
    $extention = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

   $newname = "images/posts/". date("YmdHis"). "." . $extention;
   move_uploaded_file($_FILES["image"]["tmp_name"], $newname);

   $user->updatePostContent($content, $id);
   $user->updatePostImage($newname, $id);
   header("location: updatepost.php?msg=done");

}