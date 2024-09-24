<?php

$mysqli = require __DIR__ . "/db_conn.php";

if (empty($_POST["name"])) {
    die("Valid name required <br>");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid Email required <br>");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters <br>");
}

if (!preg_match("/[a-zA-Z]/", $_POST["password"])) {
    die("Password must contain at least one letter <br>");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number <br>");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match!! <br>");
}

// Debugging: Output the POST data
echo "<pre>";
print_r($_POST);
echo "</pre>";

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Debugging: Output the hashed password
echo "Password Hash: " . $password_hash . "<br>";

$email = $_POST["email"];

// Debugging: Output the email
echo "Email: " . $email . "<br>";

$sql = "SELECT * FROM Info WHERE email = ?";
$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("MySQL error: " . $mysqli->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Debugging: Output the number of rows found
echo "Number of rows found: " . $result->num_rows . "<br>";

if ($result->num_rows > 0) {
    echo "Email already taken";
} else {
    $sql = "INSERT INTO Info (name, email, password_hash) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if (!$stmt) {
        die("MySQL error: " . $mysqli->error);
    }

    // Debugging: Output the SQL query
    echo "SQL Query: " . $sql . "<br>";

    $stmt->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash);

    // Debugging: Output the bound parameters
    echo "Bound Parameters: ";
    var_dump($_POST["name"], $_POST["email"], $password_hash);
    echo "<br>";

    if ($stmt->execute()) {
        header("Location: signup_success.html");
        exit;
    } else {
        if ($mysqli->errno === 1062) {
            echo "Email already taken";
        } else {
            die($mysqli->error . " " . $mysqli->error);
        }
    }
}

$stmt->close();
$mysqli->close();
?>