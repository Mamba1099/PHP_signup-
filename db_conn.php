<?php

$host = "localhost";
$dbname = "Logins";
$username = "root";
$password = "";

$conn = new mysqli(hostname:$host,
                     database: $dbname, 
                     username: $username, 
                     password: $password);

if ($conn->connect_error) {
    die("Connection error: " . $mysqli->connect_error);
}
