<?php
    require 'connect.php';

    function getPosts($connect){
        $posts = mysqli_query($connect, "SELECT * FROM `post`");

        $postList = [];
        while($post = mysqli_fetch_assoc($posts)){
        $postList[] = $post;
        }
        echo json_encode($postList);
    }
    function getPost($connect, $id){
        $post = mysqli_query($connect, "SELECT * FROM `post` WHERE `id` = '$id'");
        if(mysqli_num_rows($post) === 0){
            $res = [
                "status" => false,
                "message" => "Post not found"
            ];
            echo json_encode($res);
        }else{
            $post = mysqli_fetch_assoc($post);
            echo json_encode($post);
        }
    }
?>