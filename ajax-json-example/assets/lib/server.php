<?php

$pikachu = [];
$pikachu['name'] = 'Pikachu';
$pikachu['type'] = 'electric';
$pikachu['moves'] = [];
$pikachu['moves']['basic'] = 'Thunderbolt';
$pikachu['moves']['special'] = 'Thundershock';

$charmander = [];
$charmander['name'] = 'Charmander';
$charmander['type'] = 'fire';
$charmander['moves'] = [];
$charmander['moves']['basic'] = 'Tail Whip';
$charmander['moves']['special'] = 'Flamethrower';

$squirtle = [];
$squirtle['name'] = 'Squirtle';
$squirtle['type'] = 'water';
$squirtle['moves'] = [];
$squirtle['moves']['basic'] = 'Tackle';
$squirtle['moves']['special'] = 'Watergun';

$pokemons = [
    'pikachu' => $pikachu,
    'charmander' => $charmander,
    'squirtle' => $squirtle,
];

$key = $_GET['pokemon'];

if (array_key_exists($key, $pokemons)) {

    echo json_encode($pokemons[$key]);
} else {
    echo 0;
}
