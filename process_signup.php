<?php

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

// check if the password match
if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Password must match!! <br>");
}

// make password secure
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);


$mysqli = require __DIR__ . "/db_conn.php";

$email = $_POST["email"];

$sql = "SELECT * FROM Info WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo ("Email already taken");
} else {
    $sql = "INSERT INTO Info (name, email, password_hash) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("MySQL error: " . $mysqli->error);
    }
    $name = $_POST["name"];
    $password_hash = $_POST["password_hash"];


    // Assuming $password_hash is properly defined elsewhere
    $stmt->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash);

    if ($stmt->execute()) {
        header("location: signup_success.html");
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
$conn->close();
