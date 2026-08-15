<?php

$env = parse_ini_file(__DIR__. '/.env');

$host = $env['DB_HOST'];
$user = $env['DB_USER'];
$password = $env['DB_PASSWORD'];
$database = $env['DB_NAME'];
$conn = mysqli_connect($host, $user, $password, $database);
if(!$conn){
    die("Connection failed: ". mysqli_connect_error());
} 

?>