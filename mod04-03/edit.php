<?php

// function display_title() {
    // echo "Edit / Delete Page";
// }

// function display_style() {}

// function display_content() {
    $index = $_GET['index'];
    $string = file_get_contents("items.json");
    $items = json_decode($string, true);
    
    $items[$index]['name'] = htmlspecialchars($_POST['name']);
    $items[$index]['description'] = htmlspecialchars($_POST['description']);
    $items[$index]['price'] = htmlspecialchars($_POST['price']);
    
    $file = fopen("items.json", "w");
    fwrite($file, json_encode($items, JSON_PRETTY_PRINT));
    fclose($file);

    header('location: items.php');
    ?>

    

    <?php //}
    
    // function display_script() {}
    
    
    // require "template.php";?>