<?php
    header('Content-type: json-application');
    require 'connect.php';

    $posts = mysqli_query($connect, "SELECT * FROM `post`");

    $postList = [];
    while($post = mysqli_fetch_assoc($posts)){
        $postList[] = $post;
    }
    echo json_encode($postList)
?>