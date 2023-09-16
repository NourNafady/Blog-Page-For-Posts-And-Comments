<?php
session_start();
require_once('classes.php');

if (empty($_POST["content"])) {
    header("location:Updatecomment.php?msg=empty_field");
}
else {
    $user = unserialize($_SESSION["user"]);
    $content = htmlspecialchars(trim($_POST["content"]));
    
    $comments = $user->showMyComments($user->id);
    foreach ($comments as $comment) {
        $id = $comment["id"];
    }
    $user->updatecomment($content, $id);
    header("location:Updatecomment.php?msg=done");
}