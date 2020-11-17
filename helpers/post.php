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
            $date_posted = date("Y-m-d H:i:s");

            $user_added_by = $this->new_user->getUsername();

            //insert post
            $query = mysqli_query($this->conn, "insert into posts values('', '$body', '', '$date_posted', 'no', 'no', '0')");
            $returned_id = mysqli_insert_id($this->conn);

        }

    }
}
?>