<html>
<head>
    <link rel = "stylesheet" type = "text/css" href = "assets/css/style.css">
    <link rel = "stylesheet" href = "//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
    <?php
    require 'connection/connection.php';
    include("helpers/user.php");
    include("helpers/post.php");

    if(isset($_SESSION['username'])){
        $user_logged_in = $_SESSION['username'];
        $user_info = mysqli_query($conn, "select * from users where username = '$user_logged_in'");
        $user = mysqli_fetch_array($user_info);
    }
    else{
        header("Location: register.php");
    }

    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
    }

    $get_upvotes = mysqli_query($conn, "select added_by, upvotes from posts where id = '$post_id'");
    $row = mysqli_fetch_array($get_upvotes);
    $total_upvotes = $row['upvotes'];
    $user_upvoted = $row['added_by'];

    $user_info = mysqli_query($conn, "select * from users where username = '$user_upvoted'");
    $row = mysqli_fetch_array($user_info);


    // upvote 
    if(isset($_POST['upvote_button'])){
        $total_upvotes += 1;
        $query = mysqli_query($conn, "update posts set upvotes='$total_upvotes' where id = '$post_id'");
        $insert_upvotes = mysqli_query($conn, "insert into upvotes values('', '$user_logged_in', '$post_id')");
    }

    // undo upvote
    if(isset($_POST['undo_upvote_button'])){
        $total_upvotes -= 1;
        $query = mysqli_query($conn, "update posts set upvotes='$total_upvotes' where id='$post_id'");
        $insert_upvotes = mysqli_query($conn, "delete from upvotes where username = '$user_logged_in' and post_id = '$post_id'");
    }
    
    // check for upvotes from database
    $check_upvotes_query = mysqli_query($conn, "select * from upvotes where username = '$user_logged_in' and post_id = '$post_id'");
    $num_rows = mysqli_num_rows($check_upvotes_query);

    if($num_rows > 0){
        echo '<form action = "upvotes.php?post_id=' . $post_id . '" method = "POST">
                <input type = "submit" class="comment_upvote" name="undo_upvote_button" value="&#xf062;" style = "color:green;">
                <div class = "upvote_value">
                ' . $total_upvotes . ' 
                </div>
            </form>
        ';
    }
    else{
        echo '<form action = "upvotes.php?post_id=' . $post_id . '" method = "POST">
                <input type = "submit" class="comment_upvote" name="upvote_button" value="&#xf062;" style = "color:black;">
                <div class = "upvote_value">
                ' . $total_upvotes . ' 
                </div>
            </form>
        ';
    }
    ?>
</body>
</html>