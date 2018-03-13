<?php

function getTitle()
{
    return "12 Days of Christmas";
}

function getLyrics($date)
{
    $days = array(
        "first", "second", "third", "fourth", "fifth", "sixth", "seventh", "eighth", "ninth", "tenth", "eleventh", "twelfth",
    );

    $gifts = array(
        "A partridge in a pear tree",
        "Two turtle doves",
        "Three french hens",
        "Four calling birds",
        "Five golden rings",
        "Six geese a-laying",
        "Seven swans a-swimming",
        "Eight maids a-milking",
        "Nine ladies dancing",
        "Ten lords a-leaping",
        "Eleven pipers piping",
        "Twelve drummers drumming",
    );

    $verse1 = "On the " . $days[$date] . " day of Christmas, my true love sent to me:<br>";
    $verse2 = "";

    for ($date; $date >= 0; $date--) {
        if ($date > 0) {
            $verse2 .= $gifts[$date] . ", ";
        } else if (strlen($verse2) == 0) {
            $verse2 = $gifts[$date];
        } else {
            $verse2 .= "and " . $gifts[$date];
        }
    }

    $verse2 .= ".";

    return $verse1 . ucfirst(strtolower($verse2));

}
