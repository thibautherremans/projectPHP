<?php
    session_start();
    include_once(__DIR__ . "./classes/User.php");
    include_once(__DIR__ . "./classes/Post.php");
    //$profilePicture = User::getPicture();
    $name = User::getUsernameFromDb();
    $email = $_SESSION["email"];
    $userId = User::getId();;
    $posts = Post::loadByUser($userId);

   try {
       if(!empty($_POST['name']))
           {
               $user = new User();
               $user->changeName($_POST['name']);
           }
    }catch(\Throwable $th){
       $error = $th->getMessage();
   }

    try {
       if(!empty($_POST['email']))
           {
                $user = new User();
                $user->changeEmail($_POST['email']);
           }
     }catch(\Throwable $th){
           $error = $th->getMessage();
       }

    try {
        if(!empty($_POST['confirmPassword']))
            {
                $user = new User();
                $user->changeDescription($_POST["description"]);
            }
        }catch(\Throwable $th){
        $error = $th->getMessage();
        }


    try {
        if(!empty($_POST['confirmPassword'] && $_POST["newPassword"]))
            {
                $user = new User();
                $user->changePassword($_POST['newPassword'], $_POST['confirmPassword']);
            }
    }catch(\Throwable $th){
        $error = $th->getMessage();
    }

    if(!empty($_FILES['profilePicture']))
    {
        $user = new User();
        $user->uploadProfilepicture($_FILES['profilePicture']);
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
    <title>edit profile</title>
</head>
<body>
<?php include_once("nav.inc.php"); ?>
    <?php if(isset($error)): ?>
    <div><?php echo $error ?></div>
    <?php endif; ?>

    <section class="info">
        <h2><?php echo $name["username"]; ?></h2>
        <h3><?php echo $email ?></h3>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="profilePicture">
            <input type="submit" name="submit">
        </form>

        <form action="" method="post">
            <p>change username</p>
            <input type="text" name="name">
            <p>change email</p>
            <input type="email" name="email">
            <p>add description</p>
            <input type="text" name="description">
            <p>change password</p>
            <p>new password</p>
            <input type="password" name="newPassword">
            <p>confirm password</p>
            <input type="password" name="confirmPassword">
            <input type="submit" value="change info">
        </form>

    </section>
</body>
</html>
