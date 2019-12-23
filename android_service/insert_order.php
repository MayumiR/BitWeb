<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();

$json_decode = json_decode($_REQUEST['jsonString'], TRUE);
$userId = $_REQUEST['repcode'];
$value = $json_decode['Invoice'];
$valuedet = $value['invitems'];
$totAmt = $value['total_amount'];
$manuref = $value['manualRef']; 
$remark = $value['remark'];
$outletId = $value['customer']; 
//$batteryLevel = $value['batteryLevel'];
$nextNumVal = $value['nextNumVal'];
$endTime = $value['endTime']; 
$txnDate = $value['txnDate'];
$startTime = $value['startTime'];
$repCode = $value['repCode'];
$refno = $value['refno'];
$route = $value['route'];
$longitude = $value['longitude'];
$addDate = $value['addDate'];
$latitude = $value['latitude'];
$deldate = $value['deldate'];

$num=0;
$all_query = true;
mysqli_query($connection,"SET AUTOCOMMIT=0");
mysqli_query($connection,"START TRANSACTION");
     //echo $_REQUEST['jsonString'];
if(isset($json_decode) && count($json_decode) > 0){
	/*check sales order already exist or not*/
	$query_ck="SELECT `refno` FROM `OrderHeader` WHERE repcode='$userId' AND "
                . "cuscode='$outletId' AND txndate='$txnDate' AND `starttime`='$startTime'";
        
       // echo ''.$query_ck;
	$result_query = mysqli_query($connection,$query_ck);
        if(mysqli_num_rows($result_query) == 0){
	
		/*Insert Sales Order*/
		$query_sales="INSERT INTO `orderheader`"
                        . "(refno,adddate,cuscode,starttime,endtime,longitude,latitude,manuref,"
                        . "remark,repcode,totamt,txndate,deldate,routecode) "
                        . "values('$refno','$addDate','$outletId','$startTime','$endTime',"
                        . "'$longitude',"
                        . "'$latitude','$manuref','$remark','$repCode','$totAmt','$txnDate','$deldate','$route')";
                $result_queryh = mysqli_query($connection,$query_sales);
		$result_queryh ? $num++ : $all_query = false;
		
//		$query_sales_id=mysql_query("SELECT MAX(s_id) AS s_id FROM `tbl_sales_order` WHERE u_id='$userId'");
//		$row_sales_id=mysql_fetch_row($query_sales_id);
//		
		/*Insert sales products*/
		foreach ($valuedet as $value1) {
			$qty = $value1['qty'];
			$refno = $value1['refno'];
			$itemcode = $value1['itemcode'];
			$price = $value1['price'];
			$itemname = $value1['itemname'];
			$sp_amount=$value1['amount'];
			
			//check already exist
			$query_det="SELECT refno FROM orderdetail WHERE refno='$refno' AND itemcode='$itemcode'";
			$result_query2 = mysqli_query($connection,$query_det);
                        if(mysqli_num_rows($result_query2) == 0){
				$query_products="INSERT INTO orderdetail(refno,itemcode,itemname,price,qty,"
                                        . "amount) VALUES('$refno','$itemcode','$itemname','$price',"
                                        . "'$qty','$sp_amount')";
                        $result_query3 = mysqli_query($connection,$query_products);
				$result_query3 ? $num++ : $all_query = false;
			}
		}
		
		
		
		/*update nnumval */
		$query_update = "UPDATE reference set nNumVal = '$nextNumVal' where repCode = '$repCode' and settingCode = 'SFAORDER'";
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


