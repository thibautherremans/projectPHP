<?php
    include_once(__DIR__ . "/classes/User.php");

    if(!empty($_POST)){
        try{
            $user = new User();
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST["password"]);
            $user->setUsername($_POST["username"]);

            $user->register();

            ession_start();
            $_SESSION["username"] = $user->getUsername();
            //header("location: index.php");

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/register.css">
    <title>register page</title>
</head>
<body class="text-center">
    <?php include_once(__DIR__ . "/nav.inc.php"); ?>

    <header class="register__head m-auto">
        <img src="/images/logo-insta.png" alt="" class="mb-4" width="70" height="70">
        <h1 class="h3 mb-3 fw-normal">Please register</h1>
    </header>

    <main class="form-register m-auto">
        <form action="" method="post" class="register__form">

        <div class="form-floating pb-4">
            <input type="text" placeholder="email" name="email" class="form-control" >
            <label for="floatingInput">Email address</label>
        </div>

        <div class="form-floating pb-4">
            <input type="text" placeholder="username" name="username" class="form-control">
            <label for="floatingUsername">Username</label>
        </div>    

        <div class="form-floating pb-4">
            <input type="password" placeholder="password" name="password" class="form-control">
            <label for="floatingPassword">Password</label>
        </div>
        
        <div class="form-floating pb-4">     
            <input type="password" placeholder="confirm password" name="password__confirm" class="form-control">
            <label for="floatingPasswordConfirm">Confirm password</label>        
        </div>    
        <button class="w-50 btn btn-lg btn-primary" type="submit" name="Register">Register</button>
        </form>

        <?php if(isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
    </main>

    //include van footer
</body>
</html>