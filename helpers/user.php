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

    public function friend($is_username_friend){
        $usernameSplit = "," . $is_username_friend . ",";
        if(strstr($this->user['friends'], $usernameSplit) || $is_username_friend == $this->user['username']){
            return true;
        }
        else{
            return false;
        }
    }
    
}
?>