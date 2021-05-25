<?php
    session_start();
    include_once(__DIR__ . "./classes/User.php");
    include_once(__DIR__ . "./classes/Post.php");
    include_once(__DIR__ . "./classes/Comment.php");
    include_once(__DIR__ . "./classes/Like.php");
    include_once(__DIR__ . "./database/Db.php");

    $i = 0;

    $u = new User();
    $post = new Post();

    try{
        $id = $_GET['id'];
        $info = $u->loadInfo($id);
        $name = $info["username"];
        $email = $info["email"];
        $description = $info["description"];
        $posts = $post->loadByUser($id);
        $profilepicture = $info["profile_picture"];
    }catch(\Throwable $th){
        $error = $th->getMessage();
    }


    if($profilepicture === null){
        $profilepicture = "images/basic-profile.png";
    }else{
        $profilepicture = "uploads/profilepictures/" . $info["profile_picture"];
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
    <link rel="stylesheet" href="style/profile.css">
    <title>Profile</title>
</head>
<body>
    <?php include_once("nav.inc.php");?>

    <?php if(isset( $error)): ?>
        <div><?php echo $error ?></div>
    <?php endif; ?>

    <section class="info">
        <img src="<?php echo $profilepicture; ?>" alt="profile picture" id="profileProfilepicture">
        <h2><?php echo htmlspecialchars($name); ?></h2>
        <h3><?php echo htmlspecialchars($email); ?></h3>
        <p><?php echo htmlspecialchars($description); ?></p>

        <section class="follow">
            <input type="submit" value="follow this user" class="btnFollow" data-userid="<?php echo $id ?>">
        </section>

        <?php if($_SESSION['id'] == $id): ?>
            <a href="editProfile.php" id="btnEdit">edit profile</a>
        <?php endif; ?>
    </section>



    <?php foreach($posts as $p): ?>
        <?php if (++$i == 21) break; ?>
        <section class="post_<?php echo $p["id"]?>" id="profilePost">

            <img src="uploads/<?php echo $p["imagePath"];?>" alt="<?php echo $p["imagePath"];?>" id="profilePostPicture">
            <p><?php echo $p["description"];?></p>

            <?php
                $like = new Like();
                $likes = $like->loadLikes($p["id"]);
                $likesAmount = count($likes);
            ?>
            <form action="" method="post">
                <input type="submit" value="like" name="like" data-postid = "<?php echo $p['id']; ?>" id="btnLike" class="btnLike_<?php echo $p['id']; ?>">
                <span class="likeAmount"><?php echo $likesAmount ?></span>
            </form>

            <form action="" method="post">
                <input class="commentText_<?php echo $p['id']; ?>" type="text" name="comment" placeholder="place comment" id="postInputComment">
                <a href="#" class="btnAddComment" data-postid= "<?php echo $p['id'];?>">add comment</a>
            </form>

            <?php
                $comment = new Comment;
                $comments =  $comment->loadComments($p['id']);
                foreach($comments as $c): ?>
            <ul class="commentList_<?php echo $p['id']; ?>" id="postCommentList">
                <li><?php echo htmlspecialchars($c["message"]) ; ?> <?php echo $c["post_date"]?></li>
            </ul>
            <?php endforeach; ?>

            <?php
                if(!empty($_POST["delete_" . $p['id']]))
                {
                    $post->delete($p['id']);
                }

                if($_SESSION['id'] == $id): ?>
                    <form action="" method="post">
                        <input type="submit" value="delete this post" name="delete_<?php echo $p['id']?>" id="delete">
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