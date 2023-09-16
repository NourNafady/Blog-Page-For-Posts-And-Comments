<?php
session_start();
require_once('classes.php');
$user = unserialize($_SESSION["user"]);
$posts = $user->showPost($_GET["number"]);
require_once('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <style>
        .card {
            border: 2px solid darkblue;
            padding: 10px;
        }

        .comment {
            border: 2px solid darkblue;
            padding: 10px;
        }
    </style>
</head>

<body>

    <?php
    foreach ($posts as $post) {
        $data = $user->user_nameFromPosts($post["users_id"]);
        $image = $user->get_image($post["users_id"]);

    ?>
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8 mt-3 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if ($image["image"] == NULL) {
                            ?>
                                <img src="images/user/user (1).png" alt="" style="width:40px; height:40px; border-radius: 50%;">
                            <?php
                            } else {
                            ?>

                                <img src="<?= $image["image"] ?>" alt="" style="width:40px; height:40px; border-radius: 50%;">
                            <?php
                            }
                            ?>

                            <span class="card-text"><b><?= $data["name"] ?></b></span><br>
                            <span class="card-text" style="font-size: smaller;"><?= $post["updated_at"] ?></span><br>
                            <span class="card-text"><?= $post["content"] ?></span><br>
                        </div>
                        <img src="<?= $post["image"] ?>" class="card-img-top" alt="...">
                        <a name="comment" id="" class="w-50 btn btn-primary mt-3" href="AddComment.php?number=<?= $post["id"] ?>" role="button">Add Comment</a>
                        <label for="" style="margin-top: 2;"><b>Comments:</b></label>
                        <?php
                        $comments = user::showAllComments($post["id"]);
                        foreach ($comments as $comment) {
                            $data = $user->user_nameFromComments($comment["users_id"]);
                            $image = $user->get_image($comment["users_id"]);
                        ?>
                            <div class="comment mt-3 mb-3">
                                <?php
                                if ($image["image"] == NULL) {
                                ?>
                                    <img src="images/user/user (1).png" alt="" style="width:40px; height:40px; border-radius: 50%;">
                                <?php
                                } else {
                                ?>

                                    <img src="<?= $image["image"] ?>" alt="" style="width:40px; height:40px; border-radius: 50%;">
                                <?php
                                }
                                ?>


                                <span><b><?= $data["name"] ?></b></span><br>
                                <span style="font-size: smaller;"><?= $comment["created_at"] ?></span>
                                <p><?= $comment["content"] ?></p>
                                <?php
                                if ($comment["users_id"] == $user->id) {
                                ?>
                                    <a name="update" id="" class="w-20  btn btn-primary mt-2 btn-space" style="text-align: left;" href="Updatecomment.php" role="button">Update
                                        Comment</a>
                                    <a name="delete" id="" class="w-20  btn btn-primary mt-2 btn-space" style="text-align: left;" href="Deletecomment.php?number2=<?= $comment["id"] ?>&from=show" role="button">Delete
                                        Comment</a>
                                <?php
                                }
                                ?>
                            </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>




    <?php
    }
    ?>


</body>

<?php
require_once('footer.php');
?>

</html>