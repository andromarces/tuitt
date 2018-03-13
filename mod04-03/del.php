<?php

$index = $_GET['index'];
$string = file_get_contents("items.json");
$items = json_decode($string, true);
// echo $index;

array_splice($items, $index, 1);

// var_dump($items);


$file = fopen('items.json', 'w');
fwrite($file, json_encode($items, JSON_PRETTY_PRINT));
fclose($file);

header('location: items.php');