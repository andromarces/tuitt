<?php

$newTask = $_POST['task'];

$todos = file_get_contents('todos.json');
$todos = json_decode($todos, true);

// append new task to array $todos
array_push($todos, array('task' => $newTask, 'done' => false));

// update json file
$file = fopen('todos.json', 'w');
fwrite($file, json_encode($todos, JSON_PRETTY_PRINT));
fclose($file);

// return id of new task to front-end
// $id = count($todos) - 1;
// echo $id;
end($todos);
echo key($todos);
