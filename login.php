<?php
    include_once(__DIR__ . "/classes/User.php");

    if(!empty($_POST)){
        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        try{
            if($user->canLogin()){
                session_start();
                $_SESSION['email'] = $_POST['email'];
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
    <link rel="stylesheet" href="./style/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>login page</title>
</head>
<body class="text-center">

    <?php include_once(__DIR__ . "/nav.inc.php"); ?>

    <header class="login__head m-auto">
        <img src="/images/logo-insta.png" alt="" class="mb-4" width="70" height="70">
        <h1 class="h3 mb-3 fw-normal">Please login</h1>
    </header>

    <main class="form-login m-auto">
        <form action="" method="post" class="login__form">
            

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="email" name="email">
                <label for="floatingInput">Email address</label>
            </div>
            
            <div class="form-floating pb-3">
            <label for="floatingPassword">Password</label>
                <input type="password" placeholder="password" id="floatingPassword" name="password" class="form-control">
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>

            <button class="w-50 btn btn-lg btn-primary" type="submit" name="login">Log in</button>
        </form>

        <a href="register.php">make an account</a>

        <?php if(isset($error)): ?>
        <div class="error" ><?php echo $error; ?></div>
        <?php endif; ?>
    </main>

    //include van footer
</body>
</html>