<?php
    include_once 'db-connect.php';
    
    $gender = $_POST["gender"];
    
    /*$query = "SELECT * FROM driverview WHERE gender = '".$gender."'";*/
    $query = "SELECT * FROM driverview";
    $result = mysqli_query($connect,$query);
    $querydata = array();
    
    $counter = 0;
    while($data = mysqli_fetch_array($result)) {
        $querydata[$counter] = $data;
        $counter++;
        /*$querydata[0] = array("driver"=>$data["driver"]);
        $querydata[1] = array("latt"=>$data["lattitude"]);
        $querydata[2] = array("long"=>$data["longitude"]);*/
    }
    echo json_encode($querydata);
    mysqli_close($con);
?>