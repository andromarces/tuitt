<?php
	$index = $_GET['index'];

	require 'connection.php';

	$sql = "DELETE FROM items WHERE id = '$index'";
	mysqli_query($conn,$sql) or die(mysqli_error($conn));
	// $string = file_get_contents("assets/items.json");
	// $items = json_decode($string, true);

	// unset($items[$index]);

	// $file = fopen('assets/items.json','w');
	// fwrite($file, json_encode($items, JSON_PRETTY_PRINT)); 
	// fclose($file);

	header('location: menu.php');

?>