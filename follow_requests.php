<?php
    include("helpers/header.php");
    include("helpers/user.php");
    include("helpers/post.php");
?>

<div class = "user_results column" id = "user_results">
    <h5> Follow Requests </h5>

    <?php
        $query = mysqli_query($conn, "select * from follow_requests where send_to_user = '$user_logged_in'");
        if(mysqli_num_rows($query) == 0){
            echo "No follow requests";
        }
        else{
            while($row = mysqli_fetch_array($query)){
                $send_from_user = $row['send_from_user'];
                $new_send_from_user = new User($conn, $send_from_user);
                echo $new_send_from_user->getName() . " sent you a follow request. ";

                $user_from_followers_column = $new_send_from_user->getFollowers();
                
                if(isset($_POST['accept_follow_request' . $send_from_user])){
                    $accept_follow_query = mysqli_query($conn, "update users set followers = concat(followers, '$send_from_user', ',') where username = '$user_logged_in'");
                    $accept_follow_query = mysqli_query($conn, "update users set followers = concat(followers, '$user_logged_in', ',') where username = '$send_from_user'");

                    $delete_query = mysqli_query($conn, "delete from follow_requests where send_to_user = '$user_logged_in' and send_from_user = '$send_from_user'");
                    echo "Follow request accepted from '$send_from_user'";
                    header("Location: follow_requests.php");
                }

                if(isset($_POST['decline_follow_request' . $send_from_user])){
                    $delete_query = mysqli_query($conn, "delete from follow_requests where send_to_user = '$user_logged_in' and send_from_user = '$send_from_user'");
                    echo "Follow request declined from '$send_from_user'";
                    header("Location: follow_requests.php");
                }
                ?>

                <form action="follow_requests.php" method = "POST">
                    <input type = "submit" name = "accept_follow_request<?php echo $send_from_user; ?>" id = "accept_follow_button" value = "Accept and follow back">
                    <input type = "submit" name = "decline_follow_request<?php echo $send_from_user; ?>" id = "decline_follow_button" value = "Decline follow request">
                </form>

                <?php
            }
        }
    ?>

    


</div>