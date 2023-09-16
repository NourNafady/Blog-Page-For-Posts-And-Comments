<?php
session_start();
require_once('classes.php');

if (empty($_FILES["image"])) {
    header("location:profile.php");
} else {
    $user = unserialize($_SESSION["user"]);

    $extention = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

    $newname = "images/user/". date("YmdHis"). "." . $extention;
    move_uploaded_file($_FILES["image"]["tmp_name"], $newname);
    $user->updateProfileImage($newname, $user->id);
    header("location:UserImage.php?msg=done");
}

?>