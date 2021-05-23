<?php
    session_start();
    include_once(__DIR__ . "./classes/User.php");
    include_once(__DIR__ . "./classes/Post.php");
    include_once(__DIR__ . "./classes/Comment.php");
    include_once(__DIR__ . "./classes/Like.php");
    include_once(__DIR__ . "./database/Db.php");


    $i = 0;

    $user = new User();
    $post = new Post();

    $posts = $post->load20();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/index.css">
    <title>Document</title>
</head>
<body>
    <?php include_once(__DIR__ . "/nav.inc.php"); ?>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
    <?php foreach($posts as $post => $p): ?>
        <section class="post_<?php echo $p["id"]?>" id="postsSection">
            <?php
                $info = $user->loadInfo($p['user_id']);
                $username = $info["username"];
                $profilepicture = $info["profile_picture"];

            if($profilepicture === null){
                $profilepicture = "images/basic-profile.png";
            }else{
                $profilepicture = "uploads/profilepictures/" . $info["profile_picture"];
            }
            ?>
            <a href="profile.php?id=<?php echo $p["user_id"]; ?>" id="postLink">
                <img src="<?php echo $profilepicture; ?>" alt="profile picture" id="profilepicture">
                <h3 id="postUsername"><?php echo htmlspecialchars($username); ?></h3>
            </a>
            <img src="uploads/<?php echo $p["imagePath"];?>" alt="<?php echo $p["imagePath"]; ?>" id="postImage">
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

        </section>
    <?php endforeach; ?>

    <form action="" method="post">
        <input type="submit" value="load more" name="loadMore" class="loadMore">
    </form>

    <script src="loadMore.js"></script>
    <script src="comment.js"></script>
    <script src="like.js"></script>
    <script src="follow.js"></script>
</body>
</html>
