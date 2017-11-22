<?php

    require("password.php");
    
   $servername = "ec2-52-25-133-35.us-west-2.compute.amazonaws.com";
   $server_username = "username";
   $server_password = "password";
   $server_dbname = "FreeLoad";

    $con = mysqli_connect($servername, $server_username, $server_password, $server_dbname);
   
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $statement = mysqli_prepare($con, "SELECT * FROM user WHERE username = ?");
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $colUserID, $colName, $colUsername, $colAge, $colPassword);
    
    $response = array();
    $response["success"] = false;  
    
    while(mysqli_stmt_fetch($statement)){
        if (password_verify($password, $colPassword)) {
            $response["success"] = true;  
            $response["name"] = $colName;
            $response["age"] = $colAge;
        }
    }
    echo json_encode($response);
?>