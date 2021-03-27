<?php
    include_once(__DIR__ . "/classes/User.php");

    if(!empty($_POST)){
        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        try{
            if($user->canLogin()){
                echo('het is gelukt!');
                //session_start();
                //$_SESSION['email'] = $_POST['email'];
            }
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
    <title>login page</title>
</head>
<body>

    //include van navigatie

    <header class="login__head">
        //logo + catchfrase
    </header>

    <main>
        <form action="" method="post" class="login__form">
            <input type="text" placeholder="email" name="email">
            <input type="password" placeholder="password" name="password">
            <input type="submit" placeholder="log-in" name="submit">
        </form>

        <a href="register.php">make an account</a>

        <?php if(isset($error)): ?>
        <div class="error" style="color= #ff0000"><?php echo $error; ?></div>
        <?php endif; ?>
    </main>

    //include van footer
</body>
</html>