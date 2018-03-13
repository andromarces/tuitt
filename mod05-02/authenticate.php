<?php
session_start();
require 'connection.php';
// $string = file_get_contents("users.json");
// $users = json_decode($string, true);

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username'"; /* step 1 */

$result = mysqli_query($conn,$sql); /* step 2 */

if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $row['role'];
    header('location: items.php');
} else {
    header('location: items.php#lif');
}} else {
    header('location: items.php#lif');
}
// if (array_key_exists($username, $users)) {
//     if ($users[$username] == $password) {
//         $_SESSION['username'] = $username;
//         header('location: items.php');
//     } else {
//         header('location: items.php#lif');
//     }} else {
//     header('location: items.php#lif');
// }

?>
