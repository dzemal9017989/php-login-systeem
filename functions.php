<?php 


function ConnectDb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function GetData($sql, $params = array()){
    
    $conn = ConnectDb();

    try {
        $query = $conn->prepare($sql);
        $query->execute($params);
        $result = $query->fetchAll();
        return $result;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function Overzicht(){
    if(!empty(isset($_SESSION["user"]))){
        $username = $_SESSION["user"];

        
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = GetData($sql);
        if ($result !== null && count($result) > 0) {
            $password = $result[0]["password"];

            echo "<h2>Het spel kan beginnen</h2>";
            echo "<p>Je bent ingelogd met:</p>";
            echo "Username: $username <br>";
            echo "Password: $password";
        }
    } else{
        echo "<p>U bent niet ingelogd. Log in om verder te gaan.</p>";
    }

    echo "<br><br>";

    if(!empty(isset($_SESSION["user"]))){
        echo"   <form action='logout.php' method='post'>
                    <button name='submit'>Log out</button>	 
                </form>";
    } else{
        echo "<a href='login_form.php'>Log in</a>";
    }
}

function Login(){
    if(!empty(isset($_POST['username']) && isset($_POST['password']))){
        $sql = "SELECT * FROM user";
        $result = GetData($sql);
        var_dump($result);
        $username = $_POST['username'];
        $password = $_POST['password'];
        var_dump($_POST);
        #exit;
        foreach ($result as $row){
            if ($row["username"] == $username && $row["password"] == $password){
                $_SESSION["account"] = $row["username"];
                header("Location: index.php");
            }
        }

    } elseif(!empty(isset($_GET['username']) && isset($_GET['password']))){
        $sql = "SELECT * FROM user";
        $result = GetData($sql);

        $username = $_GET['username'];
        $password = $_GET['password'];

        foreach ($result as $row){
            if($row["username"] == $username && $row["password"] == $password){
                $_SESSION["user"] = $row["username"];
                header("Location: index.php");
            }
        }
    }
}

function Logout(){
    session_unset();
    header('Location: index.php');
}

function Registration(){
    if(!empty(isset($_POST['username']) && isset($_POST['password']))){
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        
        $sql = "SELECT * FROM user WHERE username = :username";
        $existingUser = GetData($sql, [':username' => $username]);
    
        if (count($existingUser) > 0) {
            
            echo "Username already exists. Please choose a different username.";
        } else{
            
            
            $sql = "INSERT INTO user (username, password) 
                    VALUES (:username, :password)";
            $params = [
                ':username' => $username,
                ':password' => $password
            ];
            GetData($sql, $params);
    
            
            $url = "login.php?username=" . urlencode($username) . "&password=" . urlencode($password);
            header("Location: " . $url);
        }
    }
}

?>