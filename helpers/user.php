<?php
class User{
    private $user;
    private $conn;

    public function __construct($conn, $user){
        $this->conn = $conn;
        $user_info = mysqli_query($conn, "select * from users where username = '$user'");
        $this->user = mysqli_fetch_array($user_info);
    }

    public function getUsername(){
        return $this->user['username'];
    }

    public function getName(){
        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "select first_name, last_name from users where username = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['first_name'] . " " . $row['last_name'];
    }

    public function closed(){
        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "select is_user_deleted from users where username = '$username'");
        $row = mysqli_fetch_array($query);

        if($row['is_user_deleted'] == 'yes'){
            return true;
        }
        else{
            return false;
        }
    }

    public function follower($is_username_follower){
        $usernameSplit = "," . $is_username_follower . ",";
        if(strstr($this->user['followers'], $usernameSplit) || $is_username_follower == $this->user['username']){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function getFollowRequest($send_to_user) {
        $send_from_user = $this->user['username'];
        $follow_request_query = mysqli_query($this->conn, "select * from follow_requests where send_to_user = '$send_to_user' and send_from_user = '$send_from_user'");
        if(mysqli_num_rows($follow_request_query) > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function sentFollowRequest($send_from_user) {
        $send_to_user = $this->user['username'];
        $follow_request_query = mysqli_query($this->conn, "select * from follow_requests where send_to_user = '$send_to_user' and send_from_user = '$send_from_user'");
        if(mysqli_num_rows($follow_request_query) > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function removeFollow($remove_user){
        $user_logged_in = $this->user['username'];
        $query = mysqli_query($this->conn, "select followers from users where username = '$remove_user'");
        $row = mysqli_fetch_array($query);
        $followers_username = $row['followers'];

        // search for user who is removed, replace with empty string, update the column in the user table
        $remove_followers = str_replace($remove_user . ",", "", $this->user['followers']);
        $update_followers = mysqli_query($this->conn, "update users set followers = '$remove_followers' where username = '$user_logged_in'");

        // repeat step to remove followers/friends for other user as well
        $remove_followers = str_replace($this->user['followers'] . ",", "", $followers_username);
        $update_followers = mysqli_query($this->conn, "update users set followers = '$remove_followers' where username = '$remove_user'");
    }

    public function sendFollow($send_to_user){
        $send_from_user = $this->user['username'];
        $query = mysqli_query($this->conn, "insert into follow_requests values('', '$send_to_user', '$send_from_user')");
    }

    public function getFollowers() {
        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "select followers from users where username = '$username'");
        $row = mysqli_fetch_array($query);
        return $row['followers'];
    }
}
?>