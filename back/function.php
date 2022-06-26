<?php
    require 'connect.php';
//  Вывод постов
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
//  Добавление поста 
    function addPost($connect, $data){
        $title = $data['title'];
        $body = $data['body'];
        mysqli_query($connect, "INSERT INTO `post` (`title`, `body`) VALUES ('$title', '$body')");
        http_response_code(201);
        $res = [
            "status" => true,
            "post_id" => mysqli_insert_id($connect)
        ];
        echo json_encode($res);
    }
//  Изменение поста
    function updatePost($connect, $id, $data){
        $title = $data['title'];
        $body = $data['body'];
        mysqli_query($connect, "UPDATE `post` SET `title` = '$title', `body` = '$body' WHERE `post`.`id` = '$id'");
        http_response_code(200);
        $res = [
            "status" => true,
            "message" => "Пост был успешно изменен"
        ];
        echo json_encode($res);
    }
?>