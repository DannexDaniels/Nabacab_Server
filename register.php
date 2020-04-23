<?php
    include_once 'db-connect.php';
    
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $myquery1 = "INSERT INTO users VALUE ('".$phone."','".$password."','client')";
    $myquery = "INSERT INTO clients VALUES ('".$name."','".$email."','".$phone."','".$password."')";
    
    if (mysqli_query($connect,$myquery1)) {
        if (mysqli_query($connect,$myquery)) {
            echo "success_new";
        }else{
            echo "Error: ".mysqli_error($connect);
        }
    } else {
        echo "Error: ".mysqli_error($connect);
    }
    
?>