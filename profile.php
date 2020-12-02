<?php
include("helpers/header.php");
include("helpers/user.php");
?>

  <?php
    echo "<div class=\"welcome\"> Welcome $user_logged_in! </div>";
   ?>
<br>
<br>
<br>

<form action="profile.php" method="post">
Update Name here
<input type="text" name = "first_name" placeholder = "Enter New First Name"/>
<input type="text" name = "last_name" placeholder = "Enter New Last Name"/>
<input type="submit" name = "Submit" placeholder = "Submit" style = 'background-color: lightgreen; border-radius: 6px; border-outline: none;'/>

</form>

<form action="profile.php" method="post">
Update email here
<input type="text" name = "email" placeholder = "Enter New Email"/>
<input type="submit" name = "Submit_2" placeholder = "Submit" style = 'background-color: lightgreen; border-radius: 6px; border-outline: none;'/>

</form>

<?php

if(isset($_POST['Submit'])){
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];

$query = mysqli_query($conn, "UPDATE users SET first_name = '$firstname' , last_name = '$lastname' WHERE username = '$user_logged_in'");

}

if(isset($_POST['Submit_2'])){
$email = $_POST['email'];

$query = mysqli_query($conn, "UPDATE users SET email = '$email' WHERE username = '$user_logged_in'");

}

 ?>
