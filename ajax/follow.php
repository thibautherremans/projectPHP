<?php
    include_once(__DIR__ . "./../classes/User.php");
    include_once(__DIR__ . "./../classes/Follow.php");
    if(!empty($_POST)){
        session_start();
        $follow = new Follow();
        $follow->setUserId($_SESSION['id']);
        $follow->setFollowerId($_POST['followerId']);
        $follow->follow();

        $response = [
            'status' => "succes",
            'message' => "Follow Saved"
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
    }
