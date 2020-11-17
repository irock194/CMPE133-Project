<?php

if(isset($_POST['login_button'])){
    $email = filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL);
    $_SESSION['login_email'] = $email;
    $password = md5($_POST['login_password']);

    $check_database = mysqli_query($conn, "select * from users where email = '$email' and password = '$password'");
    $check_login = mysqli_num_rows($check_database);

    if($check_login == 1){
        $row = mysqli_fetch_array($check_database);
        $username = $row['username'];

        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    }
    else{
        array_push($error_messages, "Email or password was incorrect<br>");
    }
}
?>