<?php
session_start();
require 'connection.php';

$index = $_GET['index'];

$sql = "DELETE FROM items WHERE id = $index";
mysqli_query($conn,$sql) or die(mysqli_error($conn));
// $string = file_get_contents("items.json");
// $items = json_decode($string, true);
// echo $index;

// array_splice($items, $index, 1);

// var_dump($items);


// $file = fopen('items.json', 'w');
// fwrite($file, json_encode($items, JSON_PRETTY_PRINT));
// fclose($file);

header('location: items.php');