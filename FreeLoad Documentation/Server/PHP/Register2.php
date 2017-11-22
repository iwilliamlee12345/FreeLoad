<?php
    require("password.php");
    
    
    $servername = "ec2-52-25-133-35.us-west-2.compute.amazonaws.com";
    $server_username = "username";
    $server_password = "password";
    $server_dbname = "FreeLoad";

    $conn = mysqli_connect($servername, $server_username, $server_password, $server_dbname);
    
        // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
       
    
    $name = $_POST["name"];
    $age = $_POST["age"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    function registerUser() {       
        global $connect, $name, $age, $username, $password;
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $statement = mysqli_prepare($connect, "INSERT INTO user (name, age, username, password) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($statement, "siss", $name, $age, $username, $passwordHash);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement); 
    }
    
    function registerUser2() {       
        global $conn, $name, $age, $username, $password;
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $statement = mysqli_prepare($conn, "INSERT INTO user (name, username, age, password) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($statement, "ssis", $name, $username, $age, $passwordHash);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement); 
    }
    
    
    function usernameAvailable() {
        global $conn, $username;
        $statement = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ?"); 
        mysqli_stmt_bind_param($statement, "s", $username);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 
        if ($count < 1){
            return true; 
        }else {
            return false; 
        }
    }
    
    $response = array();
    $response["success"] = false; 
    
    if (usernameAvailable()){
        registerUser2();
        $response["success"] = true;  
    }
    
    echo json_encode($response);
    
?>