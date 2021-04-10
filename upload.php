<?php
    include_once(__DIR__ . "/classes/Post.php");

    if(!empty($_POST)){
        $post = new Post();
        //$post->UploadImage($_POST["UploadImage"]);
        $post->setImage($_POST["uploadImage"]);
        $post->setDescription($_POST["description"]);
        var_dump($_POST["UploadImage"]);
    }
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include_once("nav.inc.php");?>

    <form action="" method="post" enctype="multipart/form-data">
        //select a picture
        <input type="file" name="uploadImage" id="uploadImage">
        <input type="text" name="description" id="description">
        <input type="submit" value="Upload Image" name="submit" id="submit">
        //add a description to the picture

        //tags like #breakfast must redirect to other pictures with this tag

        //upload the picture to the feed/profile (reduce size and quality first)
    </form>

</body>
</html>