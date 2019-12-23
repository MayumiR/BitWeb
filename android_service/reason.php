<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();

    
    $query_reason = "SELECT type, code, name
					FROM reason";
    //ech
     $result_reason = mysqli_query($connection,$query_reason);  
     $settings=array();
       if (mysqli_num_rows($result_reason) != 0) {
        while($row_reason= mysqli_fetch_array($result_reason)){
                        $makeReasonArr['type']=$row_reason['type'];
			$makeReasonArr['code']=$row_reason['code'];
                        $makeReasonArr['name']=$row_reason['name'];
			array_push($response,$makeReasonArr);
        }	
        $settings["result"] = "true";
        $settings["reasons"] = $response;
        echo json_encode($settings);
    } else {
        $response["result"] = "false";
    }

// echo json_encode($outlets);
//$createConnection->closeConnection();


