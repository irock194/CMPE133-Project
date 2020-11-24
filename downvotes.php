<html>
<head>
    <title></title>
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

    $get_downvotes = mysqli_query($conn, "select added_by, downvotes from posts where id = '$post_id'");
    $row = mysqli_fetch_array($get_downvotes);
    $total_downvotes = $row['downvotes'];
    $user_downvoted = $row['added_by'];

    $user_info = mysqli_query($conn, "select * from users where username = '$user_downvoted'");
    $row = mysqli_fetch_array($user_info);


    // downvote 
    if(isset($_POST['downvote_button'])){
        $total_downvotes += 1;
        $query = mysqli_query($conn, "update posts set downvotes='$total_downvotes' where id = '$post_id'");
        $insert_downvotes = mysqli_query($conn, "insert into downvotes values('', '$user_logged_in', '$post_id')");
    }

    // undo downvote
    if(isset($_POST['undo_downvote_button'])){
        $total_downvotes -= 1;
        $query = mysqli_query($conn, "update posts set downvotes='$total_downvotes' where id='$post_id'");
        $insert_downvotes = mysqli_query($conn, "delete from downvotes where username = '$user_logged_in' and post_id = '$post_id'");
    }
    
    // check for downvotes from database
    $check_downvotes_query = mysqli_query($conn, "select * from downvotes where username = '$user_logged_in' and post_id = '$post_id'");
    $num_rows = mysqli_num_rows($check_downvotes_query);

    if($num_rows > 0){
        echo '<form action = "downvotes.php?post_id=' . $post_id . '" method = "POST">
                <input type = "submit" class="comment_downvote" name="undo_downvote_button" value = "&#xf063;">
                <div class = "downvote_value">
                ' . $total_downvotes . ' Downvotes
                </div>
            </form>
        ';
    }
    else{
        echo '<form action = "downvotes.php?post_id=' . $post_id . '" method = "POST">
                <input type = "submit" class="comment_downvote" name="downvote_button" value = "&#xf063;">
                <div class = "downvote_value">
                ' . $total_downvotes . ' Downvotes
                </div>
            </form>
        ';
    }
    ?>
</body>
</html>