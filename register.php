<?php
    include_once(__DIR__ . "/classes/User.php");

    if(!empty($_POST)){
        try{
            $user = new User();
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST["password"]);
            $user->setUsername($_POST["username"]);

            $user->register();

            /*session_start();
            $_SESSION["username"] = $user->getUsername();
            header("location: index.php");*/

        }catch(\Throwable $th){
            $error = $th->getMessage();
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register page</title>
</head>
<body>
    //include van navigatie

    <header class="register__head">
        //logo + catchfrase
    </header>

    <main>
        <form action="" method="post" class="register__form">
            <input type="text" placeholder="email" name="email">
            <input type="text" placeholder="username" name="username">
            <input type="password" placeholder="password" name="password">
            <input type="password" placeholder="confirm password" name="password__confirm">
            <input type="submit" placeholder="register account" name="submit">
        </form>

        <?php if(isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
    </main>

    //include van footer
</body>
</html>