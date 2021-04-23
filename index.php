<?php

$i = 0;

$posts = [
    [
        "username" => "johnwick",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Yeah man!"
    ],
    [
        "username" => "youngthugg",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ski!"
    ],
    [
        "username" => "stevejobs",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ciao!"
    ],
    [
        "username" => "johnwick",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Yeah man!"
    ],
    [
        "username" => "youngthugg",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ski!"
    ],
    [
        "username" => "stevejobs",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ciao!"
    ],[
        "username" => "johnwick",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Yeah man!"
    ],
    [
        "username" => "youngthugg",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ski!"
    ],
    [
        "username" => "stevejobs",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ciao!"
    ],[
        "username" => "johnwick",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Yeah man!"
    ],
    [
        "username" => "youngthugg",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ski!"
    ],
    [
        "username" => "stevejobs",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ciao!"
    ],[
        "username" => "johnwick",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Yeah man!"
    ],
    [
        "username" => "youngthugg",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ski!"
    ],
    [
        "username" => "stevejobs",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ciao!"
    ],
    [
        "username" => "johnwick",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Yeah man!"
    ],
    [
        "username" => "youngthugg",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ski!"
    ],
    [
        "username" => "stevejobs",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ciao!"
    ],
    [
        "username" => "johnwick",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Yeah man!"
    ],
    [
        "username" => "youngthugg",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ski!"
    ],
    [
        "username" => "stevejobs",
        "image" => "https://placeimg.com/640/480/any",
        "description" => "Ciao!"
    ]
]



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include_once(__DIR__ . "/nav.inc.php"); ?>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        
    <?php foreach($posts as $post => $v): ?>
    <?php if (++$i == 21) break; ?>
    <article >
        <a href="#<?php echo $post;?>" class="justify-content-center">
            <h3><?php echo $v['username']; ?></h3>
            <img src="<?php echo $v['image']; ?>" alt="img">
            <h6><?php echo $v['description']; ?></h6>
        </a>
    </article>
    <?php endforeach; ?>
</body>
</html>
