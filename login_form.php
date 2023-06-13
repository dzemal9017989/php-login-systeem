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

$mysqli = new mysqli(hostname: $host, 
                     username: $username,
                     password: $password,
                     database: $dbname);

if ($mysqli->connect_errno)
{
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;

?>

