<?php

require 'connection.php';
session_start();

$username = $_POST['username'];
$password = sha1($_POST['pw']);

$sql = "INSERT INTO users (username,password,role) VALUES ('$username','$password','regular')";
mysqli_query($conn,$sql) or die(mysqli_error($conn));

$_SESSION['username'] = $username;
$_SESSION['role'] = 'regular';
header('location: menu.php');

// $string = file_get_contents("assets/users.json");
// $users = json_decode($string, true);
// echo "original users array: "; print_r($users);

// $users[$username] = $password;
// echo "<br> new users array: "; print_r($users);

// $file = fopen("assets/users.json","w"); //open the json file
// fwrite($file, json_encode($users, JSON_PRETTY_PRINT)); //rewrite the json file
// fclose($file); //close the json file

?>