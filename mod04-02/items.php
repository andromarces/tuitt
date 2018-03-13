<?php


function display_title() {
    echo "Items";
}
// $ages = [
//     'Peter' => 35,
//     'Ben' => 37,
//     'Joe' => 43,
// ];

// echo $ages['Peter']."<br>";
// echo $ages['Ben']."<br>";
// echo $ages['Joe']."<br>";

// foreach ($ages as $name => $age) {
//     echo "$name $age <br>";
// }

$item1 = [
    'name' => 'Coffee',
    'description' => 'Powerful coffee drink.',
    'price' => 1,
    'img' => 'assets/img/coffee.jpeg',
    'category' => 'Drinks',
];

$item2 = [
    'name' => 'Juice',
    'description' => 'Natural fruit juice.',
    'price' => 1,
    'img' => 'assets/img/juice.jpeg',
    'category' => 'Drinks',
];

$item3 = [
    'name' => 'Donut',
    'description' => 'A ring of goodness.',
    'price' => 1,
    'img' => 'assets/img/donut.jpeg',
    'category' => 'Food',
];

$item4 = [
    'name' => 'Cake',
    'description' => 'A slice of heaven.',
    'price' => 1,
    'img' => 'assets/img/cake.jpeg',
    'category' => 'Food',
];

$item5 = [
    'name' => 'Water',
    'description' => "Good ol' H2O.",
    'price' => 1,
    'img' => 'assets/img/water.jpeg',
    'category' => 'Drinks',
];

$item6 = [
    'name' => 'Ice Cream',
    'description' => 'Great for those hot days.',
    'price' => 1,
    'img' => 'assets/img/icecream.jpeg',
    'category' => 'Food',
];

$items = [
    $item1,
    $item2,
    $item3,
    $item4,
    $item5,
    $item6,
];

// foreach ($items as $item) {
//     // print_r($item);
//     foreach ($item as $key => $value) {
//         echo "$key: $value <br>";
//     }
//     echo "<hr>";
// }

function display_content () {
    global $items;
    $categories = array_unique(array_column($items,'category'));
    
    echo "<div class='col-12 col-md-8 col-lg-9'>";
    echo "<div class='row mb-1'><select class='custom-select col-2'><option selected>Display All</option>";
    foreach ($categories as $category) {
        echo "<option>$category</option>";
    }
    echo "</select><button type='button' class='btn btn-info'>Sort By Category</button></div>";

    echo "<div class='row'>";
    foreach ($items as $item) {
        echo "<div class='col-12 col-md-6 col-lg-4 card' style='width: 18rem;'>";
        echo "<img class='card-img-top' src='".$item['img']."' alt='img' style='max-height: 165px;'>";
        echo "<div class='card-body'> <p>";
        echo "Name: ".$item['name']."<br>";
        echo "Description: ".$item['description']."<br>";
        echo "Price: Php".$item['price']."<br>";
        echo "Category: ".$item['category'];
        echo "</p> </div> </div>";
    }
    echo "</div> </div>";
}

require "template.php";

?>