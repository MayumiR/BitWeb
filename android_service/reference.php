<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();

if (isset($_REQUEST['repcode']) && $_REQUEST['repcode'] != "") {
    
    $query_ref = "SELECT settingCode, repCode, nNumVal, nMonth, nYear
					FROM reference
					WHERE 
                                        repCode = '" .$_REQUEST['repcode']."'";
    //ech
     $result_ref = mysqli_query($connection,$query_ref);  
     $references=array();
       if (mysqli_num_rows($result_ref) != 0) {
        while($row_ref= mysqli_fetch_array($result_ref)){
                        $makeRefArr['settingCode']=$row_ref['settingCode'];
			$makeRefArr['repCode']=$row_ref['repCode'];
                        $makeRefArr['nNumVal']=$row_ref['nNumVal'];
                        $makeRefArr['nMonth']=$row_ref['nMonth'];
                        $makeRefArr['nYear']=$row_ref['nYear'];
			array_push($response,$makeRefArr);
        }	
        $references["result"] = "true";
        $references["references"] = $response;
        echo json_encode($references);
    } else {
        $response["result"] = "false";
    }
} else {
    $response["result"] = "false";
}
// echo json_encode($outlets);
//$createConnection->closeConnection();


