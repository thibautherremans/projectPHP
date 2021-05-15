<?php
    session_start();
    include_once(__DIR__ . "./classes/User.php");
    include_once(__DIR__ . "./classes/Post.php");
    include_once(__DIR__ . "./classes/Comment.php");
    include_once(__DIR__ . "./classes/Like.php");

    $i = 0;

    $u = new User();
    $post = new Post();

    $id = $_GET['id'];
    $info = $u->loadInfo($id);
    $name = $info["username"];
    $email = $info["email"];
    $description = $info["description"];
    $posts = $post->loadByUser($id);

    $profilepicture = "uploads/profilepictures/" . $info["profile_picture"];
    if($profilepicture === null){
        $profilepicture = "images/basic-profile.png";
    }

    var_dump($_POST['delete']);
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
        <img src="<?php echo $profilepicture; ?>" alt="profile picture">
        <h2><?php echo htmlspecialchars($name); ?></h2>
        <h3><?php echo htmlspecialchars($email); ?></h3>
        <p><?php echo htmlspecialchars($description); ?></p>
    </section>

    <section class="follow">
        <input type="submit" value="follow this user" class="btnFollow" data-userid="<?php echo $id ?>">
    </section>

    <?php if($_SESSION['id'] == $id): ?>
        <a href="editProfile.php">edit profile</a>
    <?php endif; ?>

    <?php foreach($posts as $p): ?>
        <?php if (++$i == 21) break; ?>
        <section class="post_<?php echo $p["id"]?>">

            <img src="uploads/<?php echo $p["imagePath"];?>" alt="<?php echo $p["imagePath"]; ?>">
            <p><?php echo $p["description"];?></p>

            <?php
                $l = new Like();
                $likes = $l->loadLikes($p["id"]);
                $likesAmount = count($likes);
            ?>
            <form action="" method="post">
                <input type="submit" value="like" name="like" data-postid = "<?php echo $p['id']; ?>" id="btnLike" class="btnLike_<?php echo $p['id']; ?>">
                <span class="likeAmount"><?php echo $likesAmount ?></span>
            </form>

            <form action="" method="post">
                <input class="commentText_<?php echo $p['id']; ?>" type="text" name="comment" placeholder="place comment">
                <a href="#" class="btnAddComment" data-postid= "<?php echo $p['id'];?>">add comment</a>
            </form>

            <?php
                $comment = new Comment;
                $comments =  $comment->loadComments($p['id']);
                foreach($comments as $c): ?>
            <ul class="commentList_<?php echo $p['id']; ?>">
                <li><?php echo htmlspecialchars($c["message"]) ; ?> <?php echo $c["post_date"]?></li>
            </ul>
            <?php endforeach; ?>

            <?php
                if(!empty($_POST["delete"]))
                {
                    $post->delete($p['id']);
                }

                if($_SESSION['id'] == $id): ?>
                    <form action="" method="post">
                        <input type="submit" value="delete this post" name="delete" id="delete">
                    </form>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>

    <a href="#">load more</a>

    //include van footer with "add picture" function

    <script src="comment.js"></script>
    <script src="like.js"></script>
    <script src="follow.js"></script>
</body>
</html>