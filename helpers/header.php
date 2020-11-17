<?php
require 'connection/connection.php';

?>

<html>
<head>
    <title>Social Network Feed</title>   
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src = "assets/js/bootstrap.js"></script>

    <link rel = "stylesheet" href = "//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel = "stylesheet" type = "text/css" href = "assets/css/boostrap.css">
    <link rel = "stylesheet" type = "text/css" href = "assets/css/style.css">
</head>
<body>
    <div class = "top_bar">

        <div class = "logo">
            <a href="index.php"> Social Network Feed </a>
        </div>

        <nav>
            <a href="#">
                <i class = "fa fa-home fa-lg"></i>
            </a>
            <a href="#">
                <i class = "fa fa-users fa-lg"></i>
            </a>
            <a href="#">
                <i class = "fa fa-envelope fa-lg"></i>
            </a>
            <a href="#">
                <i class = "fa fa-cog fa-lg"></i>
            </a>
        </nav>
    </div>
</body>
</html>