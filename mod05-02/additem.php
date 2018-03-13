<?php
session_start();
require 'connection.php';

$target_dir = "assets/img/";
$target_file =$target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// check if image file is a actual image or fake image
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);


$name = $_POST['name'];
$description = $_POST['description'];
$image = $target_file;
$price = $_POST['price'];
$category = $_POST['category'];

$sql = "INSERT INTO items (name, description, price, img, category_id) VALUES ('$name','$description','$price','$image','$category')";

mysqli_query($conn,$sql) or die(mysqli_error($conn));

header('location: items.php');