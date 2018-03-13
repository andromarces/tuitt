<?php
session_start();
require 'connection.php';
// $string = file_get_contents("assets/users.json");
// $users = json_decode($string, true);
if(isset($_POST['login'])){
	$username = $_POST['username']; //user input
	$password = sha1($_POST['password']); //user input

	$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'"; //step 1
	$result = mysqli_query($conn,$sql); //step 2

	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $username;
		$_SESSION['role'] = $row['role'];
		header('location: menu.php');
	} else {
		echo "failed to login. incorrect login credentials.";
		echo " please login again <a href='login.php'>here</a>";	
	}
}

if(isset($_POST['register'])){
	$username = $_POST['username'];
	$sql = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0){
		echo "invalid";
	} else {
		echo "valid";
	}
}
// if(isset($users[$username]) && $users[$username] == $password){
// 	$_SESSION['username'] = $username;
// 	header('location: menu.php');
// } else {
// 	echo "failed to login. incorrect login credentials.";
// 	echo " please login again <a href='login.php'>here</a>";
// }

?>