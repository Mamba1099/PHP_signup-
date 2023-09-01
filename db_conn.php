<?php

$host = "localhost";
$dbname = "Logins";
$username = "root";
$password = "";

$mysqli = new mysqli(
    hostname: $host,
    database: $dbname,
    username: $username,
    password: $password
);

if ($mysqli->connect_error) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
