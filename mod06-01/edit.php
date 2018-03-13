<?php

$index = $_GET['index'];
// $string = file_get_contents("assets/items.json");
// $items = json_decode($string, true);

require 'connection.php';
$name = mysqli_real_escape_string($conn,$_POST['name']);
$description = mysqli_real_escape_string($conn,$_POST['description']);
$price = mysqli_real_escape_string($conn,$_POST['price']);

$sql = "UPDATE items SET 
		name = '$name',
		description ='$description',
		price = '$price'
		WHERE id='$index'";
mysqli_query($conn,$sql) or die(mysqli_error($conn));

// $file = fopen('assets/items.json','w');
// fwrite($file, json_encode($items, JSON_PRETTY_PRINT)); //rewrite the json file
// fclose($file); //close the json file

header('location: menu.php');
// echo "<div class='row'>";
// echo "<div class='col-xs-4 item_display'><form><img src='$img'>";
// echo "Name: <input type='text' name='name' value='$name'><br>";
// echo "Description: <textarea>$description</textarea><br>";
// echo "Price: Php <input type='number' min=0 value='$price'><br>";
// echo "<a href='menu.php'><input type='button' class='btn btn-danger' value='Cancel'></a>";
// echo "<input type='submit' class='btn btn-success' value='Save'>";
// echo "</form></div></div>";	

?>