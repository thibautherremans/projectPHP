<?php
    session_start();
    include_once(__DIR__ . "./classes/User.php");
    include_once(__DIR__ . "./classes/Post.php");
    include_once(__DIR__ . "./classes/Comment.php");
    //$profilePicture = User::getPicture();

    $i = 0;

    $u = new User();
    $post = new Post();
    $comment = new Comment();

    $id = $_GET['id'];
    $info = $u->loadInfo($id);
    $name = $info["username"];
    $email = $info["email"];
    $description = $info["description"];
    $posts = $post->loadByUser($id);
    $comments = $comment->loadComments(7);

    $profilepicture = $info["profile_picture"];
    if($profilepicture === null){
        $img = "images/basic-profile.png";
    }
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
        <img src="<?php echo $img ?>" alt="profile picture">
        <h2><?php echo $name; ?></h2>
        <h3><?php echo $email; ?></h3>
        <p><?php echo $description; ?></p>
    </section>

    <?php if($_SESSION['id'] == $id): ?>
        <a href="editProfile.php">edit profile</a>
    <?php endif; ?>

    <?php foreach($posts as $p): ?>
        <?php if (++$i == 21) break; ?>
    <section class="posts">
        <img src="uploads/<?php echo $p["imagePath"];?>" alt="<?php echo $p["imagePath"]; ?>">
        <p><?php echo $p["description"];?></p>
        <a href="#">like</a>

        <form action="" method="post">
            <input class="commentText" type="text" name="comment" placeholder="place comment">
            <a href="#" class="btnAddComment" data-postid= "<?php echo $p['id'];?>">add comment</a>
        </form>

        <?php foreach($comments as $c): ?>
        <ul class="comment__list">
            <li><?php echo $c["message"]; ?> <?php echo $c["post_date"]?></li>
        </ul>
        <?php endforeach; ?>
    </section>
    <?php endforeach; ?>

    <a href="#">load more</a>

    //include van footer with "add picture" function

    <script src="app.js"></script>
</body>
</html>