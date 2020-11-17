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
        return $row['first_name'] . " " . $row['last_name'];
    }
}
?>