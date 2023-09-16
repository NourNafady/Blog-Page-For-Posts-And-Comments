<!-- validation
filteration -->
<?php
session_start();
require_once('classes.php');


if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    echo "<h1>10/10</h1>";
    
    $email =htmlspecialchars( trim($_POST["email"]));
    $password = md5(trim($_POST["password"]));
    
   
            $user = user::login($email, $password);
            
            if ($user == NULL) {
                header("location:index.php?msg=w_e_p");
            } 
            else {
                $_SESSION["user"] = serialize($user);
                header("location: home.php");
            }
            

} 


else {
    header("location: index.php?msg=empty_field");
}






?>