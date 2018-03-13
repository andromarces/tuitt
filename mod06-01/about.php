<?php

function display_title(){
  echo "About Page";
}

function display_content(){
  $ages = [
    'Peter' => 35,
    'Ben' => 37,
    'Joe' => 43
  ];

  $numbers = [0,1,2,3,4,5];

  foreach($numbers as $number){
    echo "$number <br>";
  }
}

require "template.php";

?>