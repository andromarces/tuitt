<?php
$users = [
    ['name' => 'Juan Dela Cruz', 'email' => 'juan.delacruz@gmail.com', 'password' => 'abc123'],
    ['name' => 'John Smith', 'email' => 'john.smith@bing.com', 'password' => 'xyz234'],
    ['name' => 'John Doe', 'email' => 'john.doe@yahoo.com', 'password' => 'thu456'],
];

echo json_encode($users);
