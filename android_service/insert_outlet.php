<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();

$json_decode = json_decode($_REQUEST['jsonString'], TRUE);
$userId = $_REQUEST['repcode'];
$value = $json_decode['Outlet'];

$email = $value['email']; 
$address = $value['address'];
$outletId = $value['customer']; 
$nextNumVal = $value['nextnumval'];
$refno = $value['refno'];
$route = $value['route'];
$longitude = $value['longitude'];
$mobile = $value['mobile'];
$latitude = $value['latitude'];
$status = '1';


$num=0;
$all_query = true;
mysqli_query($connection,"SET AUTOCOMMIT=0");
mysqli_query($connection,"START TRANSACTION");
     //echo $_REQUEST['jsonString'];
if(isset($json_decode) && count($json_decode) > 0){
	/*check sales order already exist or not*/
	$query_ck="SELECT cuscode FROM `customer` WHERE cuscode='$refno'";
        
       // echo ''.$query_ck;
	$result_query = mysqli_query($connection,$query_ck);
        if(mysqli_num_rows($result_query) == 0){
	
		/*Insert Sales Order*/
		$query_cus="INSERT INTO `customer`"
                        . "(cuscode,cusname,routecode,address,mobile,status,email) "
                        . "values('$refno','$outletId','$route','$address','$mobile',"
                        . "'$status',"
						. "'$email')";
						
						//echo $query_cus;
                $result_queryh = mysqli_query($connection,$query_cus);
				$result_queryh ? $num++ : $all_query = false;
		
//		
		
		
		
		
		/*update nnumval */
		$query_update = "UPDATE reference set nNumVal = '$nextNumVal' where repCode = '$userId' and settingCode = 'NEWCUS'";
		$result_numval = mysqli_query($connection,$query_update);
                 $result_numval ? $num++ : $all_query = false;		
	}else{
		$response["result"] = false;
		$response["message"] = "Already exist";
	}
}else{
                $response["result"] = false;
		$response["message"] = "No data to insert";
}

if ($all_query) {
        $response["result"] = true;
        $query = "COMMIT";
	mysqli_query($connection,$query);
	
} else {
	mysqli_query("ROLLBACK");
	$response["result"] = false;
	$response["message"] = "errorrollback";
}
if($num == 0){
	$response["result"] = false;
	$response["message"] = "errorrows";
}
echo json_encode($response);


