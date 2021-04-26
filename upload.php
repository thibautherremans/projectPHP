<?php

    include_once(__DIR__ . "/classes/Post.php");


    if(!empty($_POST)){
        $post = new Post();
        //$post->UploadImage($_POST["UploadImage"]);
        //$post->setImage($_FILES["uploadImage"]);
        $post->setDescription($_POST["description"]);
    }

$statusMsg = '';

// File upload path
$targetDir = (__DIR__ . "./uploads");
$fileName = basename($_FILES["uploadImage"]['name']);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
var_dump($fileName);
var_dump($fileType);
var_dump($_FILES["uploadImage"]["tmp_name"]);

if(isset($_POST["submit"]) && !empty($_FILES["uploadImage"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $query = new PDO('mysql:host=localhost;dbname=technodb', "root", "root");
            $statement = $query->prepare("insert into posts (mediafile) values(:upload)");
            $statement->bindValue(":upload", $fileName);
            $result = $statement->execute();
            //$insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
            if($result){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            }
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
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