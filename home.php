<?php
session_start();

if (empty($_SESSION["user"])) {
    header("location:unauthorized.php");
}

require_once('classes.php');
$user = unserialize($_SESSION["user"]);
require_once('navbar.php');
$posts = user::showAllPosts();
?>

<title>Home Page</title>
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

<main class="container">
    <div class="p-4 p-md-5 md-4 " style="width:fit-content">
        <div class="col-d-md-flex px-0">
        <h3 class="fst-italic border-bottom">
                    Recent Post
                </h3>
            <?php
           $Lpost = $user->showLastPost();
           $updated_content = substr($Lpost["content"], 0, 20);
           $image = $user->get_image($Lpost["users_id"]);
           $data = $user->user_nameFromPosts($Lpost["users_id"]);
           ?>
            <div class="card" style="width: 1000px">
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
                    <span class="card-text" style="font-size: smaller;"><?= $Lpost["updated_at"] ?></span><br>
                    <span class="card-text"><?= $updated_content ?></span>
                    <a href="showCompleteContent.php?number=<?= $Lpost["id"] ?>"> ..See More</a>
                </div>
                <img src="<?= $Lpost["image"] ?>" class="card-img-top" alt="...">
            </div>
        </div>


        <div class="row g-5 mt-2">
            <div class="col-md-8">
                <h3 class="pb-4 mb-4 fst-italic border-bottom">
                    Posts
                </h3>

                <?php
            foreach ($posts as $post) {
                $data = $user->user_nameFromPosts($post["users_id"]);
                $updated_content = substr($post["content"], 0, 20);
                $image = $user->get_image($post["users_id"]);
            ?>


                <div class="row gap-2">
                    <div class="col mt-3 mb-3" style="display: flex;">
                        <div class="card" style="width:fit-content;">
                            <div class="card-body">
                                <?php
                                if ($image["image"] == NULL) {
                                ?>
                                <img src="images/user/user (1).png" alt=""
                                    style="width:40px; height:40px; border-radius: 50%;">
                                <?php
                                } else {
                                ?>

                                <img src="<?= $image["image"] ?>" alt=""
                                    style="width:40px; height:40px; border-radius: 50%;">
                                <?php
                                }
                                ?>
                                <span class="card-text"><b><?= $data["name"] ?></b></span><br>
                                <span class="card-text"
                                    style="font-size: smaller;"><?= $post["updated_at"] ?></span><br>
                                <span class="card-text"><?= $updated_content ?></span>
                                <a href="showCompleteContent.php?number=<?= $post["id"] ?>"> ..See More</a>
                            </div>
                            <img src="<?= $post["image"] ?>" class="card-img-top" alt="...">
                            <a name="comment" id="" class="w-50 btn btn-primary mt-3"
                                href="AddComment.php?number=<?= $post["id"] ?>" role="button">Add Comment</a>
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
                                <img src="images/user/user (1).png" alt=""
                                    style="width:40px; height:40px; border-radius: 50%;">
                                <?php
                                    } else {
                                    ?>

                                <img src="<?= $image["image"] ?>" alt=""
                                    style="width:40px; height:40px; border-radius: 50%;">
                                <?php
                                    }
                                    ?>
                                <span><b><?= $data["name"] ?></b></span><br>
                                <span style="font-size: smaller;"><?= $comment["created_at"] ?></span>
                                <p><?= $comment["content"] ?></p>
                                <?php
                                    if ($comment["users_id"] == $user->id) {
                                    ?>
                                <a name="update" id="" class="w-20  btn btn-primary mt-2 btn-space"
                                    style="text-align: left;" href="Updatecomment.php" role="button">Update
                                    Comment</a>
                                <a name="delete" id="" class="w-20  btn btn-primary mt-2" style="text-align: left;"
                                    href="Deletecomment.php?number2=<?= $comment["id"] ?>&from=h" role="button">Delete
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
                </div>



                <?php

            }

            ?>


            </div>

            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="p-4 mb-3 bg-light rounded">
                        <h4 class="fst-italic">About</h4>
                        <p class="mb-0">Customize this section to tell your visitors a little bit about your
                            publication,
                            writers, content, or something else entirely. Totally up to you.</p>
                    </div>


                </div>
            </div>
        </div>

</main>

<?php
require_once('footer.php');

?>

</body>

</html>