<?php
    include_once(__DIR__ . "./../classes/Post.php");
    if(!empty($_POST)){
        $p = new Post();
        $p->load40();

        $response = [
            'status' => "succes",
            'message' => "Load More"
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
    }
