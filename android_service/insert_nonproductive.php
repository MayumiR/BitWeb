<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();

$json_decode = json_decode($_REQUEST['jsonString'], TRUE);
$userId = $_REQUEST['repcode'];
$value = $json_decode['NonProductives'];
$valuedet = $value['NonProductiveDets'];
$cusCode = $value['cusCode'];
$addDate = $value['addDate']; 
$remark = $value['remark'];
$txnDate = $value['txnDate']; 
$nextNumVal = $value['nextNumVal'];
$repCode = $value['repCode'];
$refno = $value['refno'];
$longitude = $value['longitude'];
$latitude = $value['latitude'];

$num=0;
$all_query = true;
mysqli_query($connection,"SET AUTOCOMMIT=0");
mysqli_query($connection,"START TRANSACTION");
     //echo $_REQUEST['jsonString'];
if(isset($json_decode) && count($json_decode) > 0){
	/*check nonproductive already exist or not*/
	$query_ck="SELECT `refno` FROM `DaynPrdHed` WHERE RefNo ='$refno' AND "
                . " txndate='$txnDate'";
        
       // echo ''.$query_ck;
	$result_query = mysqli_query($connection,$query_ck);
        if(mysqli_num_rows($result_query) == 0){
	
		/*Insert nonproductives*/
		$query_sales="INSERT INTO `DaynPrdHed`"
                        . "(RefNo,TxnDate,RepCode,Remarks,AddDate,CusCode,Longitude,Latitude) "
                        . "values('$refno','$txnDate','$repCode','$remark','$addDate','$cusCode',"
                        . "'$longitude',"
                        . "'$latitude')";
                $result_queryh = mysqli_query($connection,$query_sales);
		$result_queryh ? $num++ : $all_query = false;
		
		/*Insert nonproductive details*/
		foreach ($valuedet as $value1) {
			$refno = $value1['refno'];
			$reasoncode = $value1['reasonCode'];
			$reason=$value1['reason'];
			
			//check already exist
			$query_det="SELECT refno FROM DaynPrdDet WHERE refno='$refno' AND ReasonCode='$reasoncode'";
			$result_query2 = mysqli_query($connection,$query_det);
                        if(mysqli_num_rows($result_query2) == 0){
				$query_products="INSERT INTO DaynPrdDet(refno,ReasonCode,Reason) "
                                        . "VALUES('$refno','$reasoncode','$reason')";
                        $result_query3 = mysqli_query($connection,$query_products);
				$result_query3 ? $num++ : $all_query = false;
			}
		}
		
		
		
		/*update nnumval */
		$query_update = "UPDATE reference set nNumVal = '$nextNumVal' where repCode = '$repCode' and settingCode = 'NONPRD'";
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


