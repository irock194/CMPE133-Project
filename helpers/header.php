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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src = "assets/js/bootstrap.js"></script>
    <script src = "assets/js/searchUser.js"></script>

    <link rel = "stylesheet" href = "//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel = "stylesheet" type = "text/css" href = "assets/css/boostrap.css">
    <link rel = "stylesheet" type = "text/css" href = "assets/css/style.css">
</head>
<body>
    <div class = "top_bar">

        <div class = "logo">
            <a href="index.php"> Social Network Feed </a>
        </div>

        <div class = "search">
            <form action="search.php" method = "GET" name = search_form>
                <input type = "text" name = "query" placeholder = "Search for users" id = "search_input">

                <div class = "search_button">
                    <i class = "fa fa-search fa-lg"></i>
                </div>
            </form>
        </div>

        <nav>
            <a href="#">
                <i>Profile</i>
            </a>
            <a href="follow_requests.php">
                <i>Followers</i>
            </a>
            <a href="helpers/logout.php">
                <i>Logout</i>
            </a>
        </nav>
    </div>

    </body>
    </html>

