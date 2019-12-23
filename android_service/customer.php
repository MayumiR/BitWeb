<?php
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
$response = array();
//echo $_REQUEST['repcode'];
if (isset($_REQUEST['repcode']) && $_REQUEST['repcode'] != "") {
    $query_customer = "SELECT cusname, cuscode, routecode, address, mobile, status, email
					FROM customer WHERE 
                                        routecode in (select routecode from route_rep where repcode = '" .$_REQUEST['repcode'] . "') "
            . "AND status = '1'";
            
//    $query_customer = "SELECT c.cusname, c.cuscode, c.routecode, c.address, c.mobile, c.status, c.email
//					FROM customer c , User u
//					WHERE 
//                                        u.Code='" .$_REQUEST['repcode'] . "' and c.status = '0'";
     $result_customer = mysqli_query($connection,$query_customer);  
     $outlets = array();
       if (mysqli_num_rows($result_customer) != 0) {
        while($row_customer= mysqli_fetch_array($result_customer)){
                        $makeOutletArr['cusname']=$row_customer['cusname'];
			$makeOutletArr['cuscode']=$row_customer['cuscode'];
			$makeOutletArr['routecode']=$row_customer['routecode'];
			$makeOutletArr['address']=$row_customer['address'];
			//$makeOutletArr['addressline2']=$row_customer['addressline2'];
                        $makeOutletArr['mobile']=$row_customer['mobile'];
			$makeOutletArr['status']=$row_customer['status'];
			$makeOutletArr['email']=$row_customer['email'];
			array_push($response,$makeOutletArr);
        }	
        $outlets["result"] = "true";
        $outlets["outlets"] = $response;
        echo json_encode($outlets);
    } else {
        $response["result"] = "false";
    }
} else {
    $response["result"] = "false";
}
// echo json_encode($outlets);
//$createConnection->closeConnection();


