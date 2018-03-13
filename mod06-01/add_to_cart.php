<?php

session_start();

$index = $_GET['index'];

//from menu page
if(isset($_POST['quantity'])){
	$quantity = $_POST['quantity'];

	if(isset($_SESSION['cart'][$index]))
		$_SESSION['cart'][$index] += $quantity;
	else
		$_SESSION['cart'][$index] = $quantity;

	header('location: menu.php');
}

if(isset($_POST['change_quantity'])){
	$quantity = $_POST['change_quantity'];
	$_SESSION['cart'][$index] = $quantity;

	header('location: cart.php');

}

?>