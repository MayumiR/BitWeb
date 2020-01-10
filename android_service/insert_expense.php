<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();

$json_decode = json_decode($_REQUEST['jsonString'], TRUE);
$userId = $_REQUEST['repcode'];
$value = $json_decode['Expences'];
$valuedet = $value['ExpenceDets'];
$totAmt = $value['total_amount'];
$remark = $value['remark'];
$txnDate = $value['txndate']; 
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
	/*check expenses already exist or not*/
	$query_ck="SELECT `refno` FROM `DayExpHed` WHERE RefNo ='$refno' AND "
                . " txndate='$txnDate'";
        
       // echo ''.$query_ck;
	$result_query = mysqli_query($connection,$query_ck);
        if(mysqli_num_rows($result_query) == 0){
	
		/*Insert expenses*/
		$query_sales="INSERT INTO `DayExpHed`"
                        . "(RefNo,TxnDate,RepCode,Remarks,Longitude,Latitude,TotalAmt) "
                        . "values('$refno','$txnDate','$repCode','$remark',"
                        . "'$longitude',"
                        . "'$latitude','$totAmt')";
                $result_queryh = mysqli_query($connection,$query_sales);
		$result_queryh ? $num++ : $all_query = false;
		
//		$query_sales_id=mysql_query("SELECT MAX(s_id) AS s_id FROM `tbl_sales_order` WHERE u_id='$userId'");
//		$row_sales_id=mysql_fetch_row($query_sales_id);
//		
		/*Insert expense details*/
		foreach ($valuedet as $value1) {
			$refno = $value1['refno'];
			$expcode = $value1['expcode'];
			$sp_amount=$value1['amount'];
			
			//check already exist
			$query_det="SELECT refno FROM DayExpDet WHERE refno='$refno' AND ExpCode='$expcode'";
			$result_query2 = mysqli_query($connection,$query_det);
                        if(mysqli_num_rows($result_query2) == 0){
				$query_products="INSERT INTO DayExpDet(refno,ExpCode,Amt) "
                                        . "VALUES('$refno','$expcode','$sp_amount')";
                        $result_query3 = mysqli_query($connection,$query_products);
				$result_query3 ? $num++ : $all_query = false;
			}
		}
		
		
		
		/*update nnumval */
		$query_update = "UPDATE reference set nNumVal = '$nextNumVal' where repCode = '$repCode' and settingCode = 'EXPENCE'";
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


