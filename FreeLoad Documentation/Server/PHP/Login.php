<?php

//Using Netbeans IDE
   $servername = "ec2-52-25-133-35.us-west-2.compute.amazonaws.com";
   $server_username = "username";
   $server_password = "password";
   $server_dbname = "FreeLoad";

   $conn = mysqli_connect($servername, $server_username, $server_password, $server_dbname);
   
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $statement = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ? AND password = ?");
    mysqli_stmt_bind_param($statement, "ss", $username, $password);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID, $name, $username, $age, $password);
    
    $response = array();
    $response["success"] = false;  
    
    while(mysqli_stmt_fetch($statement)){
        $response["success"] = true;  
        $response["name"] = $name;
        $response["age"] = $age;
        $response["username"] = $username;
        $response["password"] = $password;
    }
    
    echo json_encode($response);
?>