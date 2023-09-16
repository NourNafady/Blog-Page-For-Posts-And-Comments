<?php
session_start();

if (empty($_SESSION["user"])) {
    header("location:unauthorized.php");
}

require_once('classes.php');
$user = unserialize($_SESSION["user"]);
$image = $user->get_image($user->id);
require_once('navbar.php');


?>
<title>Profile Page</title>
<style>
.container1 {
    position: relative;
}

.container1 .btn {
    position: absolute;
    top: 75%;
    left: 50%;
    transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    background-color: dodgerblue;
    color: white;
    font-size: 16px;
    padding: 12px 24px;
    border: none;
    cursor: pointer;
}

.container1 .btn:hover {
    background-color: black;
}

.container1 .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>

<div class="container">
    <div class="row">
        <div class="col text-center">
            <!-- <h1>Welcome </h1> -->
            <div class="container1">
                <?php
                if (empty($image["image"])) {
                ?>
                <img src="images/user/user (1).png" style="width :200px; border-radius: 50%;" alt="" class="center">
                <?php
                }else{
                ?>
                <img src="<?= $image["image"] ?>" style="width :200px; border-radius: 50%;" alt="" class="center">
                <?php
                }
                ?>
                <!-- <button class="w-20 btn btn-primary">Button</button> -->
                <a name="image" id="" class="w-20 btn btn-primary" href="UserImage.php" role="button">Upload Image</a>
            </div>
            <h2><?= $user->name ?></h2>

        </div>

    </div>


</div>

<form action="handelAddPost.php" method="post" enctype="multipart/form-data">
    <div class="row my-5">
        <div class="col-2"></div>
        <div class="col-8">
            <?php
        if (!empty($_GET["msg"]) && $_GET["msg"] == 'done') {
        ?>

            <div class="alert alert-success" role="alert">
                <strong>Successfully Add Post</strong>
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
            <div class="mb-4">
                <input type="file" class="form-control" name="image" id="" placeholder="" aria-describedby="fileHelpId">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Share Your Ideas:</label>
                <textarea class="form-control" name="content" id="content" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="col-2"></div>
    </div>
</form>
</div>





<?php
require_once('footer.php');

?>