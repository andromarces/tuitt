<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Day1</title>
    <style>
        table,
        td,
        th,
        tr {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            height: 10px;
            width: 10px;
        }

        h1,
        h2 {
            text-align: center;
            text-shadow: 3px 0 15px white, 0 3px 15px white, -3px 0 15px white,
            0 -3px 15px white, 3px 3px 15px white, -3px -3px 15px white,
            -3px 3px 15px white, 3px -3px 15px white;
        }

        div { 
            margin: 0 auto;
            height: 300px;
            width: 500px;
            text-align: center;
        }

        span {
            height: 300px;
            width: 500px;
        }

        button {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }



    </style>
</head>
<body>

<h1><?php echo "PHP Day1"; ?></h1>

<?php
// $name = "Andro";

// echo "My name is $name."

// $num = 0;

// echo $num++;

// echo "<br>";

// echo $num;

// $a = true && false;

// if ($a) {
//     echo "true";
// } else {
//     echo "false";
// }

// $phrase = "Hello World";

// echo strtoupper($phrase);
// echo "<br>";
// echo strtolower($phrase);

// $phrase = "the quick brown fox jumps over the lazy dog.";

// echo ucfirst($phrase);
// echo "<br>";
// echo ucwords($phrase);

// $phrase = "Z";

// echo ++$phrase;

// $phrase = "the quick brown jumps over fox the lazy dog.";

// echo strpos($phrase, "quick");
// echo "<br>";
// echo stripos($phrase, "qUiCk");

// echo substr($phrase, 4);
// echo "<br>";
// echo substr($phrase, 4, 10);

// echo substr($phrase, strpos($phrase, "fox"));
// echo "<br>";
// echo strlen($phrase);

// $colors = ["red","green","blue","yellow","pink"];

// echo $colors[1];
// echo "<hr>";
// for($x=0; $x<count($colors); $x++){
//     echo "$colors[$x] <br>";
// }

// echo "<ul style='list-style: none;'>";
// for($x=0; $x<count($colors); $x++){
//     echo "<li style='background-color: $colors[$x]; width: 50px;'>$colors[$x]</li>";
// }
// echo "</ul>";

// $phrase = "the quick brown fox jumps over the lazy dog.";
// for ($x=0; $x<strlen($phrase); $x++) {
//     if ($x % 2 == 0) {
//         echo $phrase[$x];
//     } else {
//         echo strtoupper($phrase[$x]);
//     }
// }

// echo "<table>";
// echo "<tr>";
// for ($x=0; $x<=12; $x++) {
//     echo "<th>$x</th>";
// }

// echo "</tr>";

// for ($x=1; $x<=12; $x++) {
//     echo "<tr><th>$x</th>";
//     for ($y=1; $y<=12; $y++) {
//         echo "<td>".$x*$y."</td>";
//     }
//     echo "</tr>";
// }
// echo "</table>";

function summation($z)
{
    if ($z == 1) {
        $y = 1;
    } else {
        $y = 0;
    }

    for ($x = 0; $x <= $z; $x++) {
        $y += $x;
    }
    echo "<h3>Sum from 1 to " . $z . " is " . $y . ".</h3>";
    return $y;
}

function factorial($factorial)
{
    $y = 1;
    for ($x = 1; $x <= $factorial; $x++) {
        $y *= $x;
    }
    echo "<h3>" . $factorial . " factorial is : " . $y . "</h3>";
    return $y;
}

function print_table($row, $column)
{
    echo "<table border=1>";
    for ($x = 0; $x < $row; $x++) {
        echo "<tr>";
        for ($y = 0; $y < $column; $y++) {
            echo "<td>(content)</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

// print_table(3,3);

// factorial(1);
// factorial(2);
// factorial(3);
// factorial(4);
// echo factorial(5)/2;

// summation(1);
// summation(2);
// summation(3);
// summation(4);
// summation(5);

require_once "phpday1extlib.php";

echo "<h2>";
echo getTitle() . "</h2>";

echo "<div> <p id='lyrics'>";
echo getLyrics(11);
echo "</p> </div>";

echo "<button id='btn'>Next Day</button>";


// echo getLyrics(0);









?>


<script type="text/javascript">
    // var verse = document.getElementById("lyrics").innerHTML;
    // console.log(verse);
    // document.getElementById("btn").onclick = function () {

    // };



</script>

</body>
</html>










