<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP login systeem</title>
</head>
<body>
    <h1>PHP - PDO Login and Registration</h1><br>
    <h2>Login here.........</h2>
    <form action="login_form.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required><br>
      
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required><br>
      
        <button type="submit">Login</button>
      </form>
      <a href="registration.php">Registration</a>
</body>
</html>

<?php

$host = "localhost";
$dbname = "login";
$username = "root";
$password = "";

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
    
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $pdo;
} catch(PDOException $e) {
    die("Connection error: " . $e->getMessage());
}

?>

