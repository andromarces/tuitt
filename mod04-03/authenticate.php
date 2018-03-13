<?php
session_start();

$string = file_get_contents("users.json");
$users = json_decode($string, true);

$username = $_POST['username'];
$password = $_POST['password'];

if (array_key_exists($username, $users)) {
    if ($users[$username] == $password) {
        $_SESSION['username'] = $username;
        header('location: items.php');
    } else {
        header('location: items.php#lif');
    }} else {
    header('location: items.php#lif');
}

?>
