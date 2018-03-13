<?php
session_start();

// $string = file_get_contents("cart.json");
// $cart = json_decode($string, true);

$string = file_get_contents("items.json");
$items = json_decode($string, true);

$index = $_GET['index'];
$cartqty = $_POST['qty'];

// echo $index;
// echo "<br>";
// echo $cartqty;

$cartitem = $items[$index]['name'];
$cartprice = $items[$index]['price'];
$cartimg = $items[$index]['img'];

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

if (!in_cart($cartitem, $cart)) {
    array_push($cart, array('name' => $cartitem, 'quantity' => $cartqty, 'price' => $cartprice, 'img' => $cartimg));
} else {
    foreach ($cart as $key => &$value) {
        // echo "$key "; print_r($value); echo " <br>";
        if ($value['name'] == $cartitem) {
            $value['quantity'] += $cartqty;
        }
    }
}
$_SESSION['cart'] = $cart;

header('location: items.php');

// var_dump($_SESSION['cart']);
