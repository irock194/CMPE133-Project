<?php
$first_name = "";
$last_name = "";
$email = "";
$confirm_email = "";
$password = "";
$confirm_password = "";
$date = "";
$error_messages = array();

if(isset($_POST['register_button'])){
    $first_name = strip_tags($_POST['reg_firstname']);
    $last_name = strip_tags($_POST['reg_lastname']);
    $email = strip_tags($_POST['reg_email']);
    $confirm_email = strip_tags($_POST['reg_confirmemail']);
    $password = strip_tags($_POST['reg_password']);
    $confirm_password = strip_tags($_POST['reg_confirmpassword']);
    $date = date("Y-m-d");

    if($email == $confirm_email){

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            $email_unique = mysqli_query($conn, "select email from users where email = '$email'");

            $num_of_rows = mysqli_num_rows($email_unique);
            if($num_of_rows > 0){
                array_push($error_messages, "Email is already in use<br>");
            }
        }
        else{
            array_push($error_messages, "Email is invalid<br>");
        }
    }
    else {
        array_push($error_messages,"Emails do not match. Please fill out form again<br>");
    }


    if(strlen($first_name) > 30 || strlen($first_name) < 2){
        array_push($error_messages,"First name must be in between 2 and 30 letters<br>");
    }

    if(strlen($last_name) > 30 || strlen($last_name) < 2){
        array_push($error_messages,"Last name must be in between 2 and 30 letters<br>");
    }

    if($password != $confirm_password){
        array_push($error_messages,"Passwords do not match<br>");
    }
    else{
        if(preg_match('/[^A-Za-z0-9]/', $password)){
            array_push($error_messages,"Error: Password can only contain letters and number<br>");
        }
    }

    if(strlen($password > 30 || strlen($password) < 4)){
        array_push($error_messages,"Password must be of length in between 4 and 30<br>");
    }

    if(empty($error_messages)){
        $password = md5($password);
        $username = strtolower($first_name . "_" . $last_name);
        $check_username = mysqli_query($conn, "select username from users where username = '$username'");

        $i = 0;
        while(mysqli_num_rows($check_username) != 0){
            $i += 1;
            $username = $username . $i;
            $check_username = mysqli_query($conn, "select username from users where username = '$username'");
        }

        $query = mysqli_query($conn, "insert into users values('', '$first_name', '$last_name', '$username', '$email', '$password', '$date', 'no', ',')");
    }
}
?>