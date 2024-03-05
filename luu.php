<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qlbanhang";

    //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

    $date = date_create($_POST["birth"]);
    // $sql = "INSERT INTO customers (fullname, email, birthday, password) 
    
    //     VALUES ('".$_POST["name"].", ".$_POST["email"]." , ".$date->format('Y-m-d').", ".md5($_POST["pass"])."') ";
    $sql = "INSERT INTO customers (fullname, email, birthday, password)

    VALUES ('".$_POST["name"] ."', '".$_POST["email"] ."', '".$date ->format('Y-m-d') ."','".md5($_POST["password"])."' )";
    if($conn->query($sql) == TRUE) {
        echo "Thêm sinh viên thành công";
    }else{
        echo "Error: ". $sql . "<br>" .$conn->error;
    }

    $conn->close();
?>