<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'pinoyware';

$conn = mysqli_connect($host, $username, $password, $db);

mysqli_set_charset($conn,"utf8");