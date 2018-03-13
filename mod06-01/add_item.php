<?php

require 'connection.php';

$target_dir = "assets/images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

$name = $_POST['name'];
$description = $_POST['description'];
$image = $target_file;
$price = $_POST['price'];
$category = $_POST['category'];

$sql = "INSERT INTO items (name, description, price, image, category_id) VALUES 
	('$name', '$description', '$price', '$image', '$category')";
mysqli_query($conn,$sql) or die(mysqli_error($conn));

header('location: menu.php');

?>