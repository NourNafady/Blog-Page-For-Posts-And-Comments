<?php
session_start();
require_once('classes.php');
require_once('navbar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Profile Image</title>
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
                    <strong>Successfully Add Profile Image</strong>
                </div>
                <?php
                }
                ?>


                <form action="handelUserImage.php" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="image">Upload Profile Image:</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder=""
                            aria-describedby="fileHelpId">
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