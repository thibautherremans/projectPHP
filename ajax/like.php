<?php
    include_once(__DIR__ . "./../classes/Like.php");
    if(!empty($_POST)){
        session_start();
        $l = new Like();
        $l->setPostId($_POST['postId']);
        $l->setUserId($_SESSION['id']);
        $l->like();

        $response = [
            'status' => "succes",
            'message' => "Like Saved"
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
    }