<?php
// session_start();

// $user = $_POST['username'];
// echo "Hello $user";


// $_SESSION['username'] = $_POST['username'];


?>

<form method="POST" action="authenticate.php">
    <input type="text" name="username"><br>
    <input type="password" name="password"><br>
    <input type="submit" name="submit" value="Login"><br>
</form>

<?php

// echo htmlspecialchars($_GET['input'])." ".htmlspecialchars($_GET['name']);

// echo "user input is: ".$_GET['username'];

// echo "user input is: " . $_POST['username'];


$num = 5;
$output = ($num%2==0) ? "even" : "odd";
echo $output;
?>