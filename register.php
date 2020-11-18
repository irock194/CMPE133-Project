<?php
require 'connection/connection.php';
require 'helpers/register_helper.php';
require 'helpers/login_helper.php';
?>

<html>
<head>
    <title> Registration Page</title>
    <link rel = "stylesheet" type = "text/css" href = "assets/css/register.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<div class= "background_color">

    <div class = "login_tile">

    <div class = "second">  
            <form action = "register.php" method = "POST">
                <input type="text" name = "reg_firstname" placeholder = "Enter First Name" required>
                <br>
                <?php if(in_array("First name must be in between 2 and 30 letters<br>", $error_messages)){
                            echo "First name must be in between 2 and 30 letters<br>";
                }
                ?>


                <input type="text" name = "reg_lastname" placeholder = "Enter Last Name" required>
                <br>
                <?php if(in_array("Last name must be in between 2 and 30 letters<br>", $error_messages)){
                            echo "Last name must be in between 2 and 30 letters<br>";
                } ?>


                <input type="email" name = "reg_email" placeholder = "Enter Email" required>
                <br>
                <input type="email" name = "reg_confirmemail" placeholder = "Confirm Email" required>
                <br>
                <?php if(in_array("Email is already in use<br>", $error_messages)){
                            echo "Email is already in use<br>";
                } 
                else if(in_array("Email is invalid<br>", $error_messages)){
                            echo "Email is invalid<br>";
                } 
                else if(in_array("Emails do not match. Please fill out form again<br>", $error_messages)){
                            echo "Emails do not match. Please fill out form again<br>";
                } ?>


                <input type="password" name = "reg_password" placeholder = "Enter Password" required>
                <br>
                <input type="password" name = "reg_confirmpassword" placeholder = "Confirm Password" required>
                <br>
                <?php if(in_array("Passwords do not match<br>", $error_messages)){
                            echo "Passwords do not match<br>";
                } 
                else if(in_array("Error: Password can only contain letters and number<br>", $error_messages)){
                            echo "Error: Password can only contain letters and number<br>";
                } 
                else if(in_array("Password must be of length in between 4 and 30<br>", $error_messages)){
                            echo "Password must be of length in between 4 and 30<br>";
                } ?>

                <input type="submit" name = "register_button" value = "Register">
                <br>


            </form>
        </div>

        <div class = "first">
            <form action="register.php" method = "POST">
                <input type="email" name = "login_email" placeholder = "Enter Email Address">
                <br>

                <input type="password" name = "login_password" placeholder = "Enter Password">
                <br>
        

                <input type="submit" name = "login_button" value = "Login">
                <br>
                <?php if(in_array("Email or password was incorrect<br>", $error_messages)){
                            echo "Email or password was incorrect<br>";
                }
                ?>
                <br>
            </form>
        </div>


        

    </div>

    </div>
</body>
</html>