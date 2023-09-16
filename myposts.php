<?php
session_start();

if (empty($_SESSION["user"])) {
    header("location:unauthorized.php");
}

require_once('classes.php');
$user = unserialize($_SESSION["user"]);
$posts = $user->showMyPosts($user->id);
require_once('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts</title>
    <style>
        .card {
            border: 2px solid darkblue;
            padding: 10px;
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

        .comment {
            border: 2px solid darkblue;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 text-center">
                <?php
                if (!empty($_GET["msg"]) && $_GET["msg"] == 'delete') {
                ?>
                    <div class="alert alert-success" role="alert">
                        <strong>Successfully Delete Post</strong>
                    </div>

                <?php
                }
                ?>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

    <?php
    foreach ($posts as $post) {
        //  var_dump($post);
        $image = $user->get_image($user->id);
    ?>
        <div class="container" style="display: flex;">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10 mt-3 mb-3">
                    <div class="card" style="width: 950px;">
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

                            <span class="card-text"><b><?= $user->name ?></b></span><br>
                            <span class="card-text" style="font-size: smaller;"><?= $post["updated_at"] ?></span><br>
                            <span class="card-text"><?= $post["content"] ?></span><br>
                        </div>
                        <img src="<?= $post["image"] ?>" class="card-img-top" alt="..."><br>
                        <a name="comment" id="" class="w-50 btn btn-primary  mt-3" href="AddComment.php?number=<?= $post["id"] ?>" role="button">Add Comment</a>
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
                                    <a name="delete" id="" class="w-20  btn btn-primary mt-2" style="text-align: left;" href="Deletecomment.php?number2=<?= $comment["id"] ?>&from=my" role="button">Delete
                                        Comment</a>
                                <?php
                                }
                                ?>
                            </div>

                        <?php
                        }
                        ?>
                        <div class="button-container">
                            <a name="update" id="" class="w-20  btn btn-primary btn-space" href="updatepost.php" role="button">Update Post</a>
                            <a name="delete" id="" class="w-20  btn btn-primary btn-space" href="Deletepost.php?number=<?= $post["id"] ?>" role="button">Delete Post</a>
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
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