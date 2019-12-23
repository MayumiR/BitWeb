<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();

    
    $query_itempri = "SELECT ItemCode, Price
					FROM itempri where ActiveStatus = '1'";
    //ech
     $result_itempri = mysqli_query($connection,$query_itempri);  
     $itemprices=array();
       if (mysqli_num_rows($result_itempri) != 0) {
        while($row_itempri= mysqli_fetch_array($result_itempri)){
                        $makeItemPriArr['ItemCode']=$row_itempri['ItemCode'];
			$makeItemPriArr['Price']=$row_itempri['Price'];
                        //$makeItemPriArr['PriceLvlCode']=$row_itempri['PriceLvlCode'];
                       
			array_push($response,$makeItemPriArr);
        }	
        $itemprices["result"] = "true";
        $itemprices["itemprices"] = $response;
        echo json_encode($itemprices);
    } else {
        $response["result"] = "false";
    }

// echo json_encode($outlets);
//$createConnection->closeConnection();


