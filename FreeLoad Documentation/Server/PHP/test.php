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
    
    
    
    //$Sql_Query = "INSERT INTO User_Details_Table (User_Email,User_Password,User_Full_Name) values ('$Email','$Password','$Full_Name')";
    $stmt = "INSERT INTO test (name, age) VALUES ('$name', '$age')";
    mysqli_query($conn, $stmt);
    //$statement = mysqli_prepare($conn, "INSERT INTO user (name, username, age, password) VALUES (?, ?, ?, ?)");
    //mysqli_stmt_bind_param($statement, "ssis", $name, $username, $age, $password);
    //mysqli_stmt_execute($statement);
      
    
    $stmt->close();
    $conn->close();
	
    $response = array();
    $response["success"] = true;  
    
    if($stmt) {
        echo json_encode($response);
    }
    echo "Statement failed";

?>