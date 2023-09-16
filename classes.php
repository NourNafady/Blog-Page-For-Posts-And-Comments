<?php

class user
{

    public $id;
    public $name;
    public $email;
    protected $password;
    public $role = 'user';

    public function __construct($id, $name, $email, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }


    static function login($email, $password)
    {
        $user = null;
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);

        //   if ($connect->connect_error) {
        //     die("Connection failed: ".$connect->connect_error);
        //   } else {
        //     echo "Connected Successfully";
        //   }
        $qry = "SELECT * FROM users WHERE `email`='$email' AND `password` = '$password'";

        $rsult = mysqli_query($connect, $qry);

        if ($result = mysqli_fetch_assoc($rsult)) {
            switch ($result["role"]) {
                case 'user':
                    $user = new user($result["id"], $result["name"], $result["email"], $result["password"]);
                    break;

                case 'admin':
                    $user = new admin($result["id"], $result["name"], $result["email"], $result["password"]);
                    break;
            }

            mysqli_close($connect);
            return $user;
        }
    }

    static function signup($name, $email, $password)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);

        //   if ($connect->connect_error) {
        //     die("Connection failed: ".$connect->connect_error);
        //   } else {
        //     echo "Connected Successfully";
        //   }
        $qry = "INSERT INTO users (name, email ,password) values('$name','$email','$password')";
        try {

            $rsult = mysqli_query($connect, $qry);
            mysqli_close($connect);
            header("location:index.php?msg=done");
        } catch (\Throwable $th) {
            mysqli_close($connect);
            header("location:signup.php?msg=error");
        }
    }


    function get_image ($user_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "SELECT users.image FROM users WHERE id = $user_id";
        $result = mysqli_query($connect, $qry);
        $data = mysqli_fetch_assoc($result);
        mysqli_close($connect);
        return $data;
    }

    function addPost($content, $image, $user_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "INSERT INTO posts (content, image, users_id) values('$content', '$image', '$user_id')";
        $result = mysqli_query($connect, $qry);
        mysqli_close($connect);
        return $result;
    }

    function DeletePost($post_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "DELETE FROM posts WHERE id = $post_id ";
        $result = mysqli_query($connect, $qry);
        mysqli_close($connect);
    }
    function updatePostContent($content, $post_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "UPDATE posts SET `content` = '$content' WHERE id = $post_id";
        $result = mysqli_query($connect, $qry);
        mysqli_close($connect);
    }

    function updateProfileImage($image, $user_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "UPDATE users SET `image` = '$image' WHERE id = $user_id";
        $result = mysqli_query($connect, $qry);
        mysqli_close($connect);
    }

    function updatePostImage($image, $post_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "UPDATE posts SET `image` = '$image' WHERE id = $post_id";
        $result = mysqli_query($connect, $qry);
        mysqli_close($connect);
    }

    function showMyPosts($user_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "SELECT * FROM posts WHERE users_id = $user_id ORDER BY created_at DESC";
        $result = mysqli_query($connect, $qry);
        $data = mysqli_fetch_all($result);
        mysqli_close($connect);
        return $result;
    }
    
    function showPost ($post_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "SELECT * FROM posts WHERE id = $post_id";
        $result = mysqli_query($connect, $qry);
        mysqli_close($connect);
        return $result;

    }
    function showLastPost ()
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 1";
        $result = mysqli_query($connect, $qry);
        $data = mysqli_fetch_assoc($result);
        mysqli_close($connect);
        return $data;
    }
    
    static function showAllPosts()
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "SELECT * FROM posts ORDER BY created_at DESC ";
        $result = mysqli_query($connect, $qry);
        $data = mysqli_fetch_all($result);
        mysqli_close($connect);
        return $result;
    }

    static function showAllComments($post_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "SELECT * FROM comments  WHERE posts_id = $post_id ORDER BY created_at DESC LIMIT 4";
        $result = mysqli_query($connect, $qry);
        $data = mysqli_fetch_all($result);
        mysqli_close($connect);
        return $result;
    }

    function showMyComments($user_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "SELECT * FROM comments WHERE users_id = $user_id ORDER BY created_at DESC";
        $result = mysqli_query($connect, $qry);
        $data = mysqli_fetch_all($result);
        mysqli_close($connect);
        return $result;
    }


    function user_nameFromPosts($user_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "SELECT users.name FROM users WHERE id = $user_id ";
        $result = mysqli_query($connect, $qry);
        $data = mysqli_fetch_assoc($result);
        mysqli_close($connect);
        return $data;
    }

    function user_nameFromComments($user_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "SELECT users.name FROM users WHERE id = $user_id ";
        $result = mysqli_query($connect, $qry);
        $data = mysqli_fetch_assoc($result);
        mysqli_close($connect);
        return $data;
    }


    function addComment($content, $post_id, $user_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "INSERT INTO comments (content, posts_id, users_id) values('$content', '$post_id', '$user_id')";
        $result = mysqli_query($connect, $qry);
        mysqli_close($connect);
        return $result;
    }

    function DeleteComment($comment_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "DELETE FROM comments WHERE id = $comment_id ";
        $result = mysqli_query($connect, $qry);
        mysqli_close($connect);
        return $result;
    }

    function updateComment($content, $comment_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "UPDATE comments SET content = '$content' WHERE id = $comment_id";
        $result = mysqli_query($connect, $qry);
        mysqli_close($connect);
        return $result;
    }   

}




class admin extends user
{
    public $role = 'admin';

    function DeleteUser($user_id)
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "DELETE * FROM users WHERE id = $user_id";
        $result = mysqli_query($connect, $qry);
        mysqli_close($connect);
        return $result;
    }

    function showAllUsers()
    {
        require_once('config.php');
        $connect = new mysqli(DB_host, DB_user_name, DB_user_password, DB_name);
        $qry = "SELECT * FROM users ORDER BY created_at DESC";
        $result = mysqli_query($connect, $qry);
        $data = mysqli_fetch_all($result);
        mysqli_close($connect);
        return $result;
    }
}
