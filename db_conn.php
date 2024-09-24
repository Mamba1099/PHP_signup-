<?php
$host = "localhost";
$dbname = "Logins";
$username = "mamba";
$password = "Mamba@100#"; // Use the updated password

// Debugging: Check if the script is being executed
echo "db_conn.php script started<br>";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection error: " . $mysqli->connect_error);
} else {
    echo "Connected to the database<br>";
}

return $mysqli;
?>