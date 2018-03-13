<?php
session_start();

$index = $_GET['index'];
$cartqty = $_POST['qty'];

$cart = $_SESSION['cart'];


// echo $index;
// echo "<br>";
// echo $cartqty;
// echo "<br>";
// echo "<br>";

// var_dump($cart);
// echo "<br>";
// echo "<br>";

if ($cartqty == 0) {
    // echo "true";
    array_splice($cart, $index, 1);
} else {
    // echo "false";
    $cart[$index]['quantity'] = $cartqty;
}

// var_dump($cart);


$_SESSION['cart'] = $cart;

header('location: items.php');