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

    <link rel = "stylesheet" type = "text/css" href = "assets/css/navbar.css">
    <link rel = "stylesheet" href = "//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel = "stylesheet" type = "text/css" href = "assets/css/boostrap.css">
    <link rel = "stylesheet"  href = "assets/css/style.css">
</head>
<body>

    <header>
        <div class="container">
        <h1 class="logo">
            <a href = "index.php"> Social Network Feed</a>
        </h1>

        <?php
            echo "<h1 class=\"logo\"> <b>Welcome $user_logged_in !!!</b></h1>";
        ?>
        <div class = "search">
            <form action="search.php" method = "GET" name = search_form>
                <input type = "text" name = "query" placeholder = "Search for users" id = "search_input">

                <div class = "search_button">
                    <i class = "fa fa-search fa-lg"></i>
                </div>
            </form>
        </div>

        <nav>
            <ul>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="follow_requests.php">Followers</a></li>
            <li><a href="helpers/logout.php">Logout</a></li>
            </ul>
        </nav>
        </div>
        
    </header>
	
</body>
</html>

