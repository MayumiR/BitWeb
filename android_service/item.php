<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();

    
    $query_item = "SELECT ItemCode, ItemName, Status, UOM
					FROM item";
    //ech
     $result_item = mysqli_query($connection,$query_item);  
     $items=array();
       if (mysqli_num_rows($result_item) != 0) {
        while($row_item= mysqli_fetch_array($result_item)){
                        $makeItemArr['ItemCode']=$row_item['ItemCode'];
			$makeItemArr['ItemName']=$row_item['ItemName'];
                        $makeItemArr['Status']=$row_item['Status'];
                        $makeItemArr['UOM']=$row_item['UOM'];
			array_push($response,$makeItemArr);
        }	
        $items["result"] = "true";
        $items["items"] = $response;
        echo json_encode($items);
    } else {
        $response["result"] = "false";
    }

// echo json_encode($outlets);
//$createConnection->closeConnection();


