<?php
require 'connection/connection.php';

if(isset($_SESSION['username'])){
    $user_logged_in = $_SESSION['username'];
    $user_info = mysqli_query($conn, "select * from users where username = '$user_logged_in'");
    $user = mysqli_fetch_array($user_info);
}
else{
    header("Location: register.php");
}
?>

<html>
<head>
    <title>Social Network Feed</title>   
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
                <i>Home</i>
            </a>
            <a href="#">
                <i>Friends</i>
            </a>
            <a href="#">
                <i>Notifications</i>
            </a>
            <a href="#">
                <i>Settings</i>
            </a>
        </nav>
    </div>

