<?php
    session_start();
    include_once(__DIR__ . "./classes/User.php");
    include_once(__DIR__ . "./classes/Post.php");
    //$profilePicture = User::getPicture();
    $name = User::getUsername();
    $email = $_SESSION["email"];
    $userId = User::getId();
    $posts = Post::loadByUser($userId);

    var_dump($name);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Profile</title>
</head>
<body>
    <?php include_once("nav.inc.php");?>


    <section class="info">
        <h2><?php echo $name["username"]; ?></h2>
        <h3><?php echo $email ?></h3>
    </section>

    <?php foreach($posts as $p): ?>
    <section class="posts">
        <img src="<?php echo $p["imagePath"]; ?>" alt="">
    </section>
    <?php endforeach; ?>
    //profile picture and name

    //profile description

    //change password

    //change email

    //list of all posts of this user

    //include van footer with "add picture" function


</body>
</html>