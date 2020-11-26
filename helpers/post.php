<?php

class Post{
    private $new_user;
    private $conn;
    

    public function __construct($conn, $user){
        $this->conn = $conn;
        $this->new_user = new User($conn, $user);

    }
    
    public function submitPost($body){
        $body = strip_tags($body);
        $body = mysqli_real_escape_string($this->conn, $body);
        $check_empty = preg_replace('/\s+/', '', $body);

        if($check_empty != ""){
            $created_at = date("Y-m-d H:i:s");

            $added_by = $this->new_user->getUsername();

            //insert post
            $query = mysqli_query($this->conn, "insert into posts values('', '$body', '$added_by', '$created_at', 'no', '0', '0')");
            $returned_id = mysqli_insert_id($this->conn);

        }
    }

    public function loadPost(){
        $user_logged_in = $this->new_user->getUsername();
        $output_string = "";
        $data = mysqli_query($this->conn, "select * from posts where post_deleted = 'no' order by id desc");

        while($row = mysqli_fetch_array($data)){
            $id = $row['id'];
            $body = $row['body'];
            $added_by = $row['added_by'];
            $created_at = $row['created_at'];
            
            // if user is deleted
            $added_by_obj = new User($this->conn, $added_by);
            if($added_by_obj -> closed()){
                continue;
            }

            $user_logged_in_obj = new User($this->conn, $user_logged_in);
            if($user_logged_in_obj->follower($added_by)){

                // get user
                $user_info = mysqli_query($this->conn, "select first_name, last_name from users where username = '$added_by'");
                $user_row = mysqli_fetch_array($user_info);
                $first_name = $user_row['first_name'];
                $last_name = $user_row['last_name'];
            ?>

            <script type = "text/javascript">
                function toggle<?php echo $id;?>() {
                    var element = document.getElementById("toggleComment<?php echo $id; ?>");

                    if(element.style.display == "block"){
                        element.style.display = "none";
                    }
                    else{
                        element.style.display = "block";
                    }
                }
            </script>

            <?php

                $comments_count = mysqli_query($this->conn, "select * from comments where post_id = '$id'");
                $comments_count_row = mysqli_num_rows($comments_count);

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

                $output_string = $output_string . "<div class = 'text_posted' onClick = 'javascript:toggle$id()'>
                                                        <div class = 'posted_by' style='color:#ACACAC;'>
                                                            <a href = '$added_by'> $first_name $last_name </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $time_posted
                                                        </div>

                                                        <div id = post_body>
                                                            $body<br><br>
                                                        </div>

                                                        <div class = 'newsfeedOptions'>
                                                            Comments($comments_count_row)&nbsp; &nbsp; &nbsp; &nbsp;
                                                            <iframe src ='upvotes.php?post_id=$id' scrolling='no'></iframe>
                                                            <iframe src ='downvotes.php?post_id=$id' scrolling='no'></iframe>
                                                        </div>

                                                    </div>

                                                    <div class = 'post_comment' id = 'toggleComment$id' style = 'display:none;'>
                                                        <iframe src ='comments.php?post_id=$id' id = 'comment_iframe' frameborder = '0'>
                                                        </iframe>
                                                    </div>
                                                    <hr>";
            }

        }

        echo $output_string;

    }
}
?>