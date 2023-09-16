<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <link rel="shortcut icon" href="images/icons/login.png" type="image/x-icon">
    <title>Login Page</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .button {
        background-color: dodgerblue;
        color: white;
    }

    .button-container {
        display: flex;

    }

    .btn-space {
        margin-top: 20px;
        margin-left: 5px;
    }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/signin.css" rel="stylesheet">
</head>

<body class="text-center">

    
            


    <main class="form-signin">
        <form style="text-align: left;" action="handellogin.php" method="post">
            <img class="mb-4" src="images/icons/login.png" alt="" width="75" height="75">
            <h1 class="h4 mb-3 fw-normal">Please Log in</h1>
           
           <?php
            if (!empty($_GET["msg"]) && $_GET["msg"] == 'done') {
                ?>

              <div class="alert alert-success" role="alert">
                <strong>Successfully SignUp </strong>Please Login.  
              </div>
              
            <?php    
            }
            ?>

            <?php
            if (!empty($_GET["msg"]) && $_GET["msg"] == 'empty_field') {
                ?>

            <div class="alert alert-warning" role="alert">
                <strong>Please Fill Empty Fields!</strong>
            </div>
            
            <?php    
            }
            ?>
            
            
            <?php
            if (!empty($_GET["msg"]) && $_GET["msg"] == 'w_e_p') {
                ?>

            <div class="alert alert-danger" role="alert">
                <strong>Wrong Email or Password! </strong>Try again
            </div>
            
            <?php    
            }
            ?>




            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                    validate>
                <label for="floatingInput">Email address:</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Password:</label>
            </div>

            <!-- <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label> -->
            </div>
            <div>
                <span>Don't have an account yet?</span> <a href="signup.php">Sign Up</a>
            </div>

            <div class="button-container">
                <button class="w-50 btn  btn-primary btn-space" type="submit">Log in</button>
                <button class="w-50 btn  btn-primary btn-space" type="reset" onclick="alert('Do you want to reset?')">Reset</button>
            </div>

            <!-- <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p> -->
        </form>
    </main>



</body>

</html>