<?php
    //HELLO SAM
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
 
    

    
    $name = $_POST["name"];
    $age = $_POST["age"];
    $username = $_POST["username"];
    $password = $_POST["password"];
     
    //$stmt = $conn->prepare("INSERT INTO user (name, username, age, password) VALUES (?, ?, ?, ?)");
    //$stmt->bind_param("ssis", $name, $username, $age, $password);
    //$stmt->execute();
    $statement = mysqli_prepare($conn, "INSERT INTO user (name, username, age, password) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement, "ssis", $name, $username, $age, $password);
    mysqli_stmt_execute($statement);
    
    
    
    $stmt->close();
    $conn->close();
	
    $response = array();
    $response["success"] = true;  
    
    echo json_encode($response);

?>