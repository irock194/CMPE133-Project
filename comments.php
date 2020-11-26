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
    ?>

<html>
<head>
    <link rel = "stylesheet" type = "text/css" href = "assets/css/style.css">
</head>
<body>
    
    

    <script type = "text/javascript">
        function toggle() {
            var element = document.getElementById("comment_section");

            if(element.style.display == "block"){
                element.style.display = "none";
            }
            else{
                element.style.display = "block";
            }
        }
    </script>

    <?php
        if(isset($_GET['post_id'])){
            $post_id = $_GET['post_id'];
        }

        $user_query = mysqli_query($conn, "select added_by from posts where id='$post_id'");
        $user_row = mysqli_fetch_array($user_query);

        $posted_to = $user_row['added_by'];

        if(isset($_POST['postComment' . $post_id])){
            $post_body = $_POST['post_body'];
            $post_body = mysqli_escape_string($conn, $post_body);
            $date_time = date("Y-m-d H:i:s");
            $insert_comment = mysqli_query($conn, "insert into comments values('', '$post_body', '$user_logged_in', '$posted_to', '$date_time', 'no', '$post_id')");
        }
    ?>

    <form action="comments.php?post_id=<?php echo $post_id; ?>" id = "comment_form" name = "postComment<?php echo $post_id; ?>" method = "POST">
        <textarea name="post_body"></textarea>
        <input type="submit" name = "postComment<?php echo $post_id; ?>" value = "Post">
    </form>

    <!-- load comments on page --> 
    <?php
        $get_comments_query = mysqli_query($conn, "select * from comments where post_id = '$post_id' order by id asc");
        $get_comments_row = mysqli_num_rows($get_comments_query);

        if($get_comments_row != 0){
            while($comment = mysqli_fetch_array($get_comments_query)){
                $comment_body = $comment['post_body'];
                $posted_to = $comment['posted_to'];
                $posted_by = $comment['posted_by'];
                $created_at = $comment['created_at'];
                $comment_deleted = $comment['comment_deleted'];

                        // get date and time post created at
                    $date_time = date("Y-m-d H:i:s");
                        // date and time post was made
                    $start = new DateTime($created_at); 
                        // current time viewing post
                    $end = new DateTime($date_time);
                    $interval = $start->diff($end);
                        // if interval is 1 or more years
                    if($interval->y >= 1){
                        if($interval->y == 1){
                            $time_posted = $interval->y . "year ago";
                        }
                        else{
                            $time_posted = $interval->y . "years ago";
                        }
                    }

                        // less than 1 year ago posted
                        // get how long the post has been there
                    else if($interval->m >= 1){
                        if($interval->d == 0){
                            $days = "ago";
                        }
                        else if($interval->d == 1){
                            $days = $interval->d . " day ago";
                        }
                        else{
                            $days = $interval->d . " days ago";
                        }

                        if($interval->m == 1){
                            $time_posted = $interval->m . " month" . $days;
                        }
                        else{
                            $time_posted = $interval->m . " months" . $days;
                        }
                    }

                        // get days
                    else if($interval->d >= 1){
                        if($interval->d == 1){
                            $time_posted = "yesterday";
                        }
                        else{
                            $time_posted = $interval->d . " days ago";
                        }
                    }

                        // get hours
                    else if($interval->h >= 1){
                        if($interval->h == 1){
                            $time_posted = $interval->h . " hour ago";
                        }
                        else{
                            $time_posted = $interval->h . " hours ago";
                        }
                    }

                        // get minutes
                    else if($interval->i >= 1){
                        if($interval->i == 1){
                            $time_posted = $interval->i . " minute ago";
                        }
                        else{
                            $time_posted = $interval->i . " minutes ago";
                        }
                    }

                        // get seconds
                    else{
                        if($interval->s < 20){
                            $time_posted = "just now";
                        }
                        else{
                            $time_posted = $interval->s . " seconds ago";
                        }
                    }

                    $new_user = new User($conn, $posted_by);
                ?>
                <div class = "comment_section">
                    <a href="<?php echo $posted_by?>"> <?php echo $new_user->getName(); ?>  </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $time_posted . "<br>" . $comment_body; ?>
                    <hr>
                </div>
            <?php
            }
        }

        else{
            echo "<center> No comments yet! </center>";
        }

    ?>

    


</body>
</html>