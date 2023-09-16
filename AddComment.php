<?php
session_start();
require_once('classes.php');
$user = unserialize($_SESSION["user"]);
require_once('navbar.php');
if (!empty($_GET["number"])) {
    $number = $_GET["number"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Comment</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <?php
                if (!empty($_GET["msg"]) && $_GET["msg"] == 'done') {
                ?>

                    <div class="alert alert-success" role="alert">
                        <strong>Successfully Add Comment</strong>
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
                <form action="handleAddComment.php?number=<?= $number ?>" method="post">
                    <div class="mb-3">
                        <label for="comment" class="form-label">Add Comment:</label>
                        <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                    </div>
                    <button type="submit" class="w-20 btn btn-primary mb-3">Done</button>


                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
<?php
require_once('footer.php');
?>

</html>