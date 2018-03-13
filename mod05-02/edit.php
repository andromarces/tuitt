<?php

// function display_title() {
    // echo "Edit / Delete Page";
// }

// function display_style() {}

// function display_content() {
    $index = $_GET['index'];
    // $string = file_get_contents("items.json");
    // $items = json_decode($string, true);
    require 'connection.php';

    
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $price = mysqli_real_escape_string($conn,$_POST['price']);
    
    // $file = fopen("items.json", "w");
    // fwrite($file, json_encode($items, JSON_PRETTY_PRINT));
    // fclose($file);

    $sql = "UPDATE items SET
            name = '$name',
            description = '$description',
            price = '$price'
            WHERE id='$index'";

    mysqli_query($conn,$sql) or die(mysqli_error($conn));

    header('location: items.php');
    ?>

    

    <?php //}
    
    // function display_script() {}
    
    
    // require "template.php";?>