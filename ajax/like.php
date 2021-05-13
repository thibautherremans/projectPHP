<?php
    include_once(__DIR__ . "./../classes/Like.php");
    if(!empty($_POST)){
        session_start();
        $like = new Like();
        $like->setPostId($_POST['postId']);
        $like->setUserId($_SESSION['id']);
        $like->like();

        $response = [
            'status' => "succes",
            'message' => "Like Saved"
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
    }