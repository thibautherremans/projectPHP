<?php
    include_once(__DIR__ . "./../classes/Comment.php");
    if(!empty($_POST)){
        session_start();
        $c = new Comment();
        $c->setPostId($_POST["postId"]);
        $c->setText($_POST["text"]);
        $c->setUserId($_SESSION['id']);
        $c->save();

        $response = [
            'status' => "succes",
            'message' => "Comment Saved",
            'body' => htmlspecialchars($c->getText())
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
    }