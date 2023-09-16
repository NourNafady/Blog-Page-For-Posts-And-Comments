<?php
session_start();
require_once('classes.php');
$user = unserialize($_SESSION["user"]);
require_once('navbar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Commemt</title>
</head>

<body>
    <form action="handleupdatecomment.php" method="post">
        <div class="row my-5">
            <div class="col-2"></div>
            <div class="col-8">
                <?php
                if (!empty($_GET["msg"]) && $_GET["msg"] == 'done') {
                ?>

                    <div class="alert alert-success" role="alert">
                        <strong>Successfully Update Comment</strong>
                    </div>

                <?php
                }
                ?>

                <?php
                if (!empty($_GET["msg"]) && $_GET["msg"] == 'empty_field') {
                ?>

                    <div class="alert alert-warning" role="alert">
                        <strong>Please Fill Empty Field!</strong>
                    </div>

                <?php
                }
                ?>
                <div class="mb-3">
                    <label for="content" class="form-label">Update Content:</label>
                    <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
            <div class="col-2"></div>
        </div>
    </form>
</body>
<?php
require_once('footer.php');
?>

</html>