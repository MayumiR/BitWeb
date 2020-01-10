<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();

$json_decode = json_decode($_REQUEST['jsonString'], TRUE);
$Id = $_REQUEST['repcode'];
$value = $json_decode['Attendance'];
$StartTime = $value['StartTime']; 
$EndTime = $value['EndTime'];
$Vehicle = $value['Vehicle']; 
$StartKM = $value['StartKM'];
$EndKM = $value['EndKM'];
$Distance = $value['Distance'];
$RepCode = $value['RepCode'];
$Driver = $value['Driver'];
$Assist = $value['Assist'];
$Mac = $value['Mac'];
$Route = $value['Route']; 
$txndate = $value['txndate'];
$startLati = $value['startLati'];
$startLongi = $value['startLongi'];
$endLati = $value['endLati'];
$endLongi = $value['endLongi'];



$num=0;
$all_query = true;
mysqli_query($connection,"SET AUTOCOMMIT=0");
mysqli_query($connection,"START TRANSACTION");
     //echo $_REQUEST['jsonString'];
if(isset($json_decode) && count($json_decode) > 0){
	/*check sales order already exist or not*/
	// $query_ck="SELECT cuscode FROM `customer` WHERE cuscode='$refno'";
        
    //    // echo ''.$query_ck;
	// $result_query = mysqli_query($connection,$query_ck);
    //     if(mysqli_num_rows($result_query) == 0){
	
		/*Insert Sales Order*/
		$query_attendance="INSERT INTO `attendance`"
                        . " (StartTime ,EndTime ,Vehicle ,StartKM ,EndKM ,Distance ,RepCode ,Driver ,Assist ,Mac ,Route , txndate ,startLati ,startLongi ,endLati ,endLongi ) "
                        . "values('$StartTime','$EndTime','$Vehicle','$StartKM','$EndKM',"
                        . "'$Distance',"
                        . "'$RepCode',"
						. "'$Driver',"
						. "'$Assist',"
						. "'$Mac',"
						. "'$Route',"
						. "'$txndate',"
						. "'$startLati',"
						. "'$startLongi',"
						. "'$endLati',"
                        . "'$endLongi')";
                $result_queryh = mysqli_query($connection,$query_attendance);
		$result_queryh ? $num++ : $all_query = false;
		
			
	// }else{
	// 	$response["result"] = false;
	// 	$response["message"] = "Already exist";
	// }
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


