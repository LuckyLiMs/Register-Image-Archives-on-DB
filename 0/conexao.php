<?php

$host = 'localhost';
$user = 'root';
$pass = '123456';
$bd = 'upload';

$mysqli = new mysqli($host, $user, $pass, $bd);

//check conection
if ($mysqli->connect_errno) {
    echo 'Connect failed: ' . $mysqli->connect_error;
    exit();
}
?>