<?php
session_start();
require 'connection.php';
$username = $_POST['username'];

$sql = "SELECT username FROM users WHERE username = '$username'";

$result = mysqli_query($conn,$sql);


// print_r($result);
// $row = mysqli_num_rows($result);

// printf($row);

if (mysqli_num_rows($result)>0) {
    echo true;
} else {
    echo false;
}