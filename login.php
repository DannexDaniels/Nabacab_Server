<?php
    include_once 'db-connect.php';
    
    $name = $_POST["user"];
    $password = $_POST["pass"];
    
    
    $myquery = "SELECT * FROM users WHERE phone = '".$name."' AND password = '".$password."'";
    $results = mysqli_query($connect,$myquery) or die(mysqli_error($connect));
    
    if (mysqli_num_rows($results) > 0) {
        while($data = mysqli_fetch_array($results)){
            echo $data['type'];
        }
    } else {
        echo "Error: User Not Found or Wrong Password";
    }
    
?>