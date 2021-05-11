<?php
    include_once(__DIR__ . "./../classes/Like.php");
    if(!empty($_POST)){
        session_start();
        $l = new Like();
        $l->setUserId($_SESSION['id']);
        $l->setPostId($_POST['postId']);
        $l->unLike();

        $response = [
            'status' => "succes",
            'message' => "Post Unliked"
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
}