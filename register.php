<?php
require 'connection/connection.php';
require 'helpers/register_helper.php';
require 'helpers/login_helper.php';
?>

<html>
<head>
    <title> Registration Page</title>
    <link rel = "stylesheet" type = "text/css" href = "assets/css/register.css">
</head>
<body>

<div class="login_content">
    <div class="inner_login_content">
        <div class="login_tile">
            <div class="login_title">
                <form action = "register.php" method = "POST">
                    <ul class="list">
                        <li>Login</li>
                        <li><input type="email" name = "login_email" placeholder = "Enter Email Address"/></li>
                        <li><input type="password" name = "login_password" placeholder = "Enter Password"/></li>
                        <li><input type="submit" name = "login_button" value = "Login"/></li>
                        
                        <?php if(in_array("Email or password was incorrect<br>", $error_messages)){
                                    echo "Email or password was incorrect<br>";
                        }
                        ?>
                        
                    </ul>
                </form>
            </div>
        </div>
        <div class="register_tile">
            <div class="login_tile">
                <div class="register_title">
                    <ul class="list">
                        <form action = "register.php" method = "POST">
                            <li>Register</li>
                            <li><input type="text" name = "reg_firstname" placeholder = "Enter First Name" required></li>
                            <?php if(in_array("First name must be in between 2 and 30 letters<br>", $error_messages)){
                                    echo "First name must be in between 2 and 30 letters<br>";
                            }
                            ?>
                            <li><input type="text" name = "reg_lastname" placeholder = "Enter Last Name" required></li>
                            
                            <?php if(in_array("Last name must be in between 2 and 30 letters<br>", $error_messages)){
                                    echo "Last name must be in between 2 and 30 letters<br>";
                            } ?>
                            <li><input type="email" name = "reg_email" placeholder = "Enter Email" required></li>
                            <li><input type="email" name = "reg_confirmemail" placeholder = "Confirm Email" required></li>
                            
                            <?php if(in_array("Email is already in use<br>", $error_messages)){
                                        echo "Email is already in use<br>";
                            } 
                            else if(in_array("Email is invalid<br>", $error_messages)){
                                        echo "Email is invalid<br>";
                            } 
                            else if(in_array("Emails do not match. Please fill out form again<br>", $error_messages)){
                                    echo "Emails do not match. Please fill out form again<br>";
                            } ?>


                            <li><input type="password" name = "reg_password" placeholder = "Enter Password" required></li>
                            
                            <li><input type="password" name = "reg_confirmpassword" placeholder = "Confirm Password" required></li>
                            
                            <?php if(in_array("Passwords do not match<br>", $error_messages)){
                                        echo "Passwords do not match<br>";
                            } 
                            else if(in_array("Error: Password can only contain letters and number<br>", $error_messages)){
                                        echo "Error: Password can only contain letters and number<br>";
                            } 
                            else if(in_array("Password must be of length in between 4 and 30<br>", $error_messages)){
                                        echo "Password must be of length in between 4 and 30<br>";
                            } ?>

                            <li><input type="submit" name="register_button" value="Register"></li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>