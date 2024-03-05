<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "qlbanhang";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $oldpassword = $_POST['pass_cu'];
        $newpassword = $_POST['pass_moi'];
        $confirmpasword = $_POST['pass_moi1'];

        session_start();
        $id = $_SESSION['id'];
        $sql = "SELECT password FROM customers WHERE id = '$id'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $row =$result->fetch_assoc();
            $storepassword = $row['password'];

            if(md5($oldpassword) != $storepassword) {
                echo "Mat khau cu khong dung";
                header('Refresh: 3;url=sua_mk.php');

            }else{
                if($newpassword !== $confirmpasword) {
                    echo "Mat khau khong trung khop";
                    header("Refresh: 3;url=sua_mk.php");
                }elseif($newpassword === $oldpassword) {
                    echo "Mat khau moi phai khac mat khau cu!";
                    header("Refresh: 3;url=sua_mk.php");
                }else{
                    $hashpassword = md5($newpassword);

                    $updateSql = "UPDATE customers SET password = '$hashpassword' WHERE id = '$id'";
                    if($conn->query($updateSql) === TRUE) {
                        echo "Mat khau da duoc thay doi thanh cong!";
                        echo '<a href="login.php"> Trang home</a>';
                    }else{
                        echo "Loi khi cap nhat mat khau: " .$conn->error;
                    }
                }
            }
        }else{
            echo "Khong thay nguoi dung nay";
        }
    }



?>