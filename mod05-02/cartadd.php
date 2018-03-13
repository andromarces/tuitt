<?php
session_start();
require 'connection.php';
// $string = file_get_contents("cart.json");
// $cart = json_decode($string, true);

// $string = file_get_contents("items.json");
// $items = json_decode($string, true);

$index = $_GET['index'];
$cartqty = $_POST['qty'];

$sql = "SELECT * FROM items WHERE id=$index";
$result = mysqli_query($conn, $sql);
$items = array();
$row = mysqli_fetch_assoc($result);
extract($row);
    // print_r($items);

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = array();
}

function in_cart($needle, $haystack, $strict = false)
{
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_cart($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}



if (!in_cart($name, $cart)) {
    array_push($cart, array('name' => $name, 'quantity' => $cartqty, 'price' => $price, 'img' => $img));
} else {
    foreach ($cart as $key => &$value) {
        // echo "$key "; print_r($value); echo " <br>";
        if ($value['name'] == $name) {
            $value['quantity'] += $cartqty;
        }
    }
}
$_SESSION['cart'] = $cart;

header('location: items.php');

// var_dump($_SESSION['cart']);
