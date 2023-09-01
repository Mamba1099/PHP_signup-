<?php

$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/db_conn.php";

    $sql = sprintf(
        "SELECT * FROM Info WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"])
    );

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    var_dump($user);
    exit;
}

?>
<!DOCTYPE html>
<html lang="eng">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css" />
    <STYle>
        h1 {
            text-transform: capitalize;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            color: coral;
        }
    </STYle>
</head>

<body>
    <h1>Login</h1>
    <?php if ($is_invalid) : ?>
        <em>Invalid login</em>
    <?php endif; ?>

    <form method="post">
        <div>
            <label for="email">Enter Email</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="password">Enter Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <button>Log In</button>
        </div>
    </form>
</body>

</html>