<?php
ob_start();
session_start();

$timezone = date_default_timezone_set("America/Los_Angeles");
$conn = mysqli_connect("localhost", "root", "", "socialnetwork");

if(mysqli_connect_errno())
{
    echo "Error, Failure to connect: " . mysqli_connect_errno();
}
?>