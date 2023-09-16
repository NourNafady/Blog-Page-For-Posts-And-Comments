<!-- validation
filteration -->
<?php
require_once('classes.php');


if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    // echo "<h1>10/10</h1>";
    
    $name = htmlspecialchars(trim($_POST["name"]));
    $email =htmlspecialchars( trim($_POST["email"]));
    $password = md5(trim($_POST["password"]));
    
    

    user::signup($name,$email, $password);
} 



else {
    header("location: signup.php?msg=empty_field");
}


?>