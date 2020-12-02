<?php
    include("helpers/header.php");

    if(isset($_GET['query'])){
        $query = $_GET['query'];
    }
    else{
        $query = "";
    }

    if(isset($_GET['type'])){
        $type = $_GET['type'];
    }
    else{
        $type = "name";
    }
?>

<div class = "user_results column" id = "user_results">
    <?php
    include("helpers/user.php");
        if($query == ""){
            echo "Please enter name of user you want to search";
        }
        else{
            $search_names = explode(" ", $query);
            if(count($search_names) == 3){
                $search_results_returned_query = mysqli_query($conn, "select * from users where (first_name like '$search_names[0]%' and last_name like '%$search_names[2]') and is_user_deleted = 'no'");
            }
            else if(count($search_names) == 2){
                $search_results_returned_query = mysqli_query($conn, "select * from users where (first_name like '$search_names[0]%' and last_name like '%$search_names[1]') and is_user_deleted = 'no'");
            }
            else{
                $search_results_returned_query = mysqli_query($conn, "select * from users where (first_name like '$search_names[0]%' or last_name like '%$search_names[0]') and is_user_deleted = 'no'");
            }
        }

        if(mysqli_num_rows($search_results_returned_query) == 0){
            echo "No users found with the name " . $query;
        }
        else if(mysqli_num_rows($search_results_returned_query) == 1){
            echo mysqli_num_rows($search_results_returned_query) . " user found <br> <br>";
        }
        else{
            echo mysqli_num_rows($search_results_returned_query) . " users found <br> <br>"; 
        }

        while($row = mysqli_fetch_array($search_results_returned_query)){
            $new_user = new User($conn, $user['username']);

            $button_obj = "";

            if($user['username'] != $row['username']) {
                if($new_user->follower($row['username'])){
                    $button_obj = "<input type = 'submit' name = '" . $row['username'] . "' class = 'remove' value = 'Unfollow' style = 'background-color: red;'>";
                }
                else if($new_user->getFollowRequest($row['username'])){
                    $button_obj = "<input type = 'submit' name = '" . $row['username'] . "' class = 'notification' value = 'Follow Request Sent'>";
                }
                else if($new_user->sentFollowRequest($row['username'])){
                    $button_obj = "<input type = 'submit' class = 'request_sent' value = 'Follow request sent'>";
                }
                else {
                    $button_obj = "<input type = 'submit' name = '" . $row['username'] . "' class = 'send' value = 'Follow'>";
                }

                // follow and remove follow functionality
                if(isset($_POST[$row['username']])) {
                    if($new_user->follower($row['username'])){
                        $new_user->removeFollow($row['username']);
                        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                    }
                    else if($new_user->getFollowRequest($row['username'])){
                        header("Location:follow_requests.php");
                    }
                    else if($new_user->sentFollowRequest($row['username'])){

                    }
                    else{
                        $new_user->sendFollow($row['username']);
                        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                    }
                }
            }

            echo "<div class = 'search_results'>
                    <div class = 'search_results_follow_button'>
                        <form action = '' method = 'POST'>
                            " . $button_obj . "
                            <br> <br>
                        </form>
                    </div>

                    <a href = '" . $row['username'] . "'>  " . $row['first_name'] . " " . $row['last_name'] . " 
                    <p id = 'grey' style = 'color: black;'> " . $row['username'] . "  </p>
                    </a>


                  </div>           
            <hr id = search_results_hr>";
        }
    ?>

</div>