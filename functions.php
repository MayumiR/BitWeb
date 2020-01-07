<?php

require_once 'db/DBConnection.php';
$connection=(new DBConnection())->getDBConnection();
class dataFunctions {

    public static function CheckUser($uname,$pwd,$connection){
		$user_info=array();
		$query_log="SELECT UserName, Code, Name From user where UserName = '$uname' and Password =  md5($pwd)";
    $result_log= mysqli_query($connection,$query_log) or die(mysqli_error($connection));
		$row_reg=mysqli_fetch_row($result_log);
		if(mysqli_num_rows($result_log) != 0){
			$user_info['u_name']=$row_reg[0];
                        $user_info['u_rep']=$row_reg[1];
                        $user_info['u_repname']=$row_reg[2];


		}else{
			$user_info['u_name']= "";
                        $user_info['u_repname']= "";
                        $user_info['u_rep']= "";
		}
		return $user_info;
	}

    public static function saveUsers($connection,$code,$Repname, $RepAddress, $RepPwd, $RepMobile, $RepPrefix, $status, $uname, $target){

    $sql = "INSERT INTO user(Code, Name, Address, Password , Mobile, Prefix , Status , UserName, Target)"
            . "VALUES ('$code','$Repname','$RepAddress','$RepPwd','$RepMobile','$RepPrefix','$status','$uname','$target')";

            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
            //echo $result;
//
    if($result == true){
        echo '200';
    }else{
        echo '400';
         //echo $sql;
    }
    }
	public static function saveRoutes($connection,$code,$name,$status){

    $sql = "INSERT INTO route(routecode, routename, status)"
            . "VALUES ('$code','$name','$status')";

            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
            //echo $result;
//
    if($result == true){
        echo '200';
    }else{
        echo '400';
         //echo $sql;
    }
    }

    // public static function removeUser($connection,$param){
                  
    //     $sql_remove ="DELETE FROM User Where Code = '$param'";
    //     $result = mysqli_query($connection,$sql_remove) or die(mysqli_error($connection));
       
    //         if($result == true){
    //             echo '200';
    //         }else{
    //             echo '400';
    //         }    
    //     }

        public static function removeTxn($connection,$param,$txn){
                  if($txn == 'usertxn'){
                    //$sql_remove ="DELETE FROM User Where Code = '$param'";
                    $sql_remove ="Update User SET Status = '0' Where Code = '$param'";
                  }else if($txn == 'customertxn'){
                    //$sql_remove ="DELETE FROM Customer Where cuscode = '$param'";
                    $sql_remove ="Update Customer SET status = '0' Where cuscode = '$param'";
                  }else if($txn == 'Routetxn'){
                    //$sql_remove ="DELETE FROM route Where routecode = '$param'";
                    $sql_remove ="Update route SET status = '0' Where routecode = '$param'";
                  }else if($txn == 'itemtxn'){
                   // $sql_remove ="DELETE FROM item Where ItemCode = '$param'";
                   $sql_remove ="Update item SET Status = '0' Where ItemCode = '$param'";
                  }
            
            $result = mysqli_query($connection,$sql_remove) or die(mysqli_error($connection));
           
            if($result == true){
                echo '200';
            }else{
                echo '400';
            }    
            }
        public static function assignMac($connection,$mac,$code){
             
            $sql = "UPDATE User SET MacId='$mac' WHERE Code='$code'";
           
            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
            //echo $result;
            
            if($result == true){
                return '200';
            }else{
                return '400';
                 
            }                 
            }
        public static function updateData($connection,$name,$code,$address,$mob,$type){

            if($type == 'user'){
                $sql = "UPDATE User SET Name='$name', Address = '$address', Mobile = '$mob' WHERE Code  ='$code'";
               
            }else if($type == 'customer'){
                $sql = "UPDATE Customer SET cusname='$name', address = '$address', mobile = '$mob' WHERE cuscode = '$code'";
               
            }else if($type == 'route'){
                $sql = "UPDATE route SET routename='$name' WHERE routecode = '$code'";
               
            }else if($type == 'item'){
                $sql = "UPDATE item SET ItemName='$name', UOM = '$address' WHERE ItemCode = '$code'";
               
            }
             
                
                $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
                //echo $result;
                
                if($result == true){
                    return '200';
                }else{
                    return '400';
                     
                }                 
            }
    public static function assignRoutes($connection,$rpcode,$rtcode){

    $sql = "INSERT INTO route_rep(repcode, routecode)"
            . "VALUES ('$rpcode','$rtcode')";

            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
            //echo $result;
//
    if($result == true){
        echo '200';
    }else{
        echo '400';
         //echo $sql;
    }
    }
    public static function saveItems($connection,$code,$name,$status,$uom){

    $sql = "INSERT INTO item(ItemCode, ItemName, UOM, Status)"
            . "VALUES ('$code','$name','$uom','$status')";

            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
            //echo $result;
//
    if($result == true){
        echo '200';
    }else{
        echo '400';
         //echo $sql;
    }
    }
    public static function saveItemsNew($connection,$code,$name,$status,$uom,$price){

        $query_check_exist = "select * from itempri where ItemCode = '$code'";
        $result1=mysqli_query($connection,$query_check_exist) or die(mysqli_error($connection));
        $rowcount=mysqli_num_rows($result1);
        if($rowcount == 0){
            //if item has no previous records then item insert item table and item price table

            $sql = "INSERT INTO item(ItemCode, ItemName, UOM, Status)"
            . "VALUES ('$code','$name','$uom','$status')";

            $result2=mysqli_query($connection,$sql) or die(mysqli_error($connection));

            if($result2 == true){
                $sql2 = "INSERT INTO itempri(ItemCode, Price, ActiveStatus, allocatedDate)"
              . "VALUES ('$code','$price','1',curdate())";
               $result=mysqli_query($connection,$sql2) or die(mysqli_error($connection));
               }else{
                $result = $result2;
               }
        }else{
            // if item has previous records then insert item table and update itempri table 

            $sql3 = "INSERT INTO item(ItemCode, ItemName, UOM, Status)"
            . "VALUES ('$code','$name','$uom','$status')";
            $result3=mysqli_query($connection,$sql3) or die(mysqli_error($connection));

            if($result3 == true){
                $sql4 = "update itempri set ActiveStatus = '0' where ItemCode = '$code'";
               $result4=mysqli_query($connection,$sql4) or die(mysqli_error($connection));

               if($result4 == true){
                      $sql5 = "INSERT INTO itempri(ItemCode, Price, ActiveStatus, allocatedDate)"
                   . "VALUES ('$code','$price','1',curdate())";
                    $result=mysqli_query($connection,$sql5) or die(mysqli_error($connection));
               }else{
                $result = $result4;
               }
               }else{
                $result = $result3;
               }

        }

           //echo $result;
//
   if($result == true){
       echo '200';
   }else{
       echo '400';
        //echo $sql;
   }
   }
     public static function priceAllocate($connection,$code,$price){

         $query_check_exist = "select * from itempri where ItemCode = '$code'";
         $result1=mysqli_query($connection,$query_check_exist) or die(mysqli_error($connection));
         $rowcount=mysqli_num_rows($result1);
         if($rowcount == 0){
             $sql = "INSERT INTO itempri(ItemCode, Price, ActiveStatus, allocatedDate)"
            . "VALUES ('$code','$price','1',curdate())";
             $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
         }else{
             $sql = "update itempri set ActiveStatus = '0' where ItemCode = '$code'";
             $result2=mysqli_query($connection,$sql) or die(mysqli_error($connection));
             if($result2 == true){
              $sql2 = "INSERT INTO itempri(ItemCode, Price, ActiveStatus, allocatedDate)"
            . "VALUES ('$code','$price','1',curdate())";
             $result=mysqli_query($connection,$sql2) or die(mysqli_error($connection));
             }else{
                 $result = $result2;
             }

         }

            //echo $result;
//
    if($result == true){
        echo '200';
    }else{
        echo '400';
         //echo $sql;
    }
    }
    public static function saveReasons($connection,$code,$name,$type,$status){

    $sql = "INSERT INTO reason(code, name, type, status)"
            . "VALUES ('$code','$name','$type','$status')";

            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
            //echo $result;
//
    if($result == true){
        echo '200';
    }else{
        echo '400';
         //echo $sql;
    }
    }
    public static function saveCustomers($connection,$code,$name, $Address, $email, $Mobile, $Route, $status){

    $sql = "INSERT INTO customer(cuscode, cusname, address, email , mobile, routecode , status)"
            . "VALUES ('$code','$name','$Address','$email','$Mobile','$Route','$status')";

            $result=mysqli_query($connection,$sql) or die(mysqli_error($connection));
            //echo $result;
//
    if($result == true){
        echo '200';
    }else{
        echo '400';
         //echo $sql;
    }
    }
//     public static function getUsers($connection) {
//       // $sql ="SELECT Route,fa.Debcode FROM fDebtor as fd INNER JOIN fAJobHed as fa ON fd.DebCode=fa.Debcode";
// $sql ="SELECT routecode ,routename FROM route";

// $result_route = mysqli_query($connection,$sql);
// $routes["routes"] = array();
//   if (mysqli_num_rows($result_route) != 0) {
//    while($row_route= mysqli_fetch_array($result_route)){
//                    $makeRouteArr['code']=$row_route['routecode'];
//  $makeRouteArr['name']=$row_route['routename'];

//  array_push($routes["routes"],$makeRouteArr);
//    }
//    return $routes["routes"];
// } else {
//  return $routes["routes"];
// }


// }
    public static function getRoutes($connection) {
           // $sql ="SELECT Route,fa.Debcode FROM fDebtor as fd INNER JOIN fAJobHed as fa ON fd.DebCode=fa.Debcode";
     $sql ="SELECT routecode ,routename FROM route";

     $result_route = mysqli_query($connection,$sql);
     $routes["routes"] = array();
       if (mysqli_num_rows($result_route) != 0) {
        while($row_route= mysqli_fetch_array($result_route)){
                        $makeRouteArr['code']=$row_route['routecode'];
			$makeRouteArr['name']=$row_route['routename'];

			array_push($routes["routes"],$makeRouteArr);
        }
        return $routes["routes"];
    } else {
      return $routes["routes"];
    }


    }

    public static function getRouteDetails($connection) {
        $date = date('Y-m-d');
        $response = array();

        $sql = "SELECT * FROM route where status = '1'";

       $result= mysqli_query($connection,$sql);
        while ($row = mysqli_fetch_array($result)){

            $temp['Name']=$row['routename'];
            $temp['Code']=$row['routecode'];
            

        $response[]= $temp;
        }

         $results = array(
"draw" => 1,
"recordsTotal" => count($response),
"recordsFiltered" => count($response),
"data"=>$response);


        return $results;

    }
     public static function getRouteName($connection, $code) {
           // $sql ="SELECT Route,fa.Debcode FROM fDebtor as fd INNER JOIN fAJobHed as fa ON fd.DebCode=fa.Debcode";
     $sql ="SELECT routename FROM route where routecode = '$code'";

     $result_route = mysqli_query($connection,$sql);


       if (mysqli_num_rows($result_route) != 0) {
        while($row_route= mysqli_fetch_row($result_route)){
			$route=$row_route['routename'];
        }
              echo $route;

    } else {
      echo "";
    }


    }
    public static function getOrderDetail($connection, $refno) {
           // $sql ="SELECT Route,fa.Debcode FROM fDebtor as fd INNER JOIN fAJobHed as fa ON fd.DebCode=fa.Debcode";
     $sql ="select ItemCode, ItemName, Amount, Price, Qty from orderdetail where refno = '$refno'";

     $result_rr = mysqli_query($connection,$sql);
     $detail["detail"] = array();
       if (mysqli_num_rows($result_rr) != 0) {
        while($row_rr= mysqli_fetch_array($result_rr)){
                        $makeRrArr['ItemCode']=$row_rr['ItemCode'];

                        $makeRrArr['Amount']=$row_rr['Amount'];
			$makeRrArr['Price']=$row_rr['Price'];
                        $makeRrArr['Qty']=$row_rr['Qty'];

                        $code = $row_rr['ItemCode'];
			 $sql2 ="select ItemName from item where itemcode = '$code'";

                         $result_rr2 = mysqli_query($connection,$sql2);
                        while($row_rr2= mysqli_fetch_array($result_rr2)){
                        $makeRrArr['ItemName']=$row_rr2['ItemName'];
                        }
                        array_push($detail["detail"],$makeRrArr);
        }

        return $detail["detail"];
    } else {
      return $detail["detail"];
    }


    }
    public static function getOrdDetails($connection,$refno){
        $date = date('Y-m-d');
        $response = array();

        $sql ="select ItemCode, ItemName, Amount, Price, Qty from orderdetail where refno = '$refno'";


       $result= mysqli_query($connection,$sql);
        while ($row = mysqli_fetch_array($result)){

            $temp['ItemCode']=$row['ItemCode'];
            $code = $row['ItemCode'];
            $sql2 = "SELECT ItemName FROM item WHERE ItemCode = '$code'";

            $result2= mysqli_query($connection,$sql2);
        while ($row2 = mysqli_fetch_array($result2)){

            $temp['ItemName'] = $row2['ItemName'];

            }
            $temp['Amount']=$row['Amount'];
            $temp['Price']=$row['Price'];
            $temp['Qty']=$row['Qty'];

        $response[]= $temp;
        }

         $results = array(
"draw" => 1,
"recordsTotal" => count($response),
"recordsFiltered" => count($response),
"data"=>$response);


        return $results;

    }
    public static function getDailyOrderDetails($connection, $date){

        $response = array();

             $sql = "SELECT * FROM orderheader where TxnDate = '$date'";

       $result= mysqli_query($connection,$sql);
        while ($row = mysqli_fetch_array($result)){

//            $temp['RefNo']=$row['RefNo'];
//            $temp['CusCode']=$row['CusCode'];
//            $temp['TotAmt']=$row['TotAmt'];
//            $temp['Date']=$row['TxnDate'];
//            $temp['RepCode']=$row['Repcode'];
//            $temp['RouteCode']=$row['RouteCode'];
//            $temp['Remark']=$row['Remark'];

            $temp['RefNo']=$row['RefNo'];
            $temp['CusCode']=$row['CusCode'];
            $temp['TotAmt']=$row['TotAmt'];
            $temp['TxnDate']=$row['TxnDate'];
            $temp['Repcode']=$row['Repcode'];
            $temp['RouteCode']=$row['RouteCode'];
            $temp['Remark']=$row['Remark'];
             $cuscode =$row['CusCode'];
             $routecode = $row['RouteCode'];
            $sql2 = "SELECT cusname FROM customer WHERE cuscode = '$cuscode'";

            $result2= mysqli_query($connection,$sql2);
        while ($row2 = mysqli_fetch_array($result2)){

            $temp['CusName'] = $row2['cusname'];

            }
            $sql3 = "SELECT routename FROM route WHERE routecode = '$routecode'";

            $result3= mysqli_query($connection,$sql3);
        while ($row3 = mysqli_fetch_array($result3)){

            $temp['RouteName'] = $row3['routename'];

            }

//            $taskId =$row['IndexNo'];
//            $sql2 = "SELECT SUM(hours) as ActualH FROM fDailyActivity WHERE TaskId = '$taskId'";
//
//            $result2=sqlsrv_query($this->conn,$sql2);
//            while ($row2=sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)){
//
//            $temp['ActualHrs'] = $row2['ActualH'];
//
//            }

        $response[]= $temp;


        }

         $results = array(
"draw" => 1,
"recordsTotal" => count($response),
"recordsFiltered" => count($response),
"data"=>$response);


        return $results;

    }
     public static function getUsers($connection) {
           // $sql ="SELECT Route,fa.Debcode FROM fDebtor as fd INNER JOIN fAJobHed as fa ON fd.DebCode=fa.Debcode";
     $sql ="SELECT name , code FROM user where code <> ''";

     $result_rr = mysqli_query($connection,$sql);
     $users["users"] = array();
       if (mysqli_num_rows($result_rr) != 0) {
        while($row_rr= mysqli_fetch_array($result_rr)){
                        $makeRrArr['code']=$row_rr['code'];
			$makeRrArr['name']=$row_rr['name'];

			array_push($users["users"],$makeRrArr);
        }
        return $users["users"];
    } else {
      return $users["users"];
    }


    }
     public static function getCustomers($connection) {
           // $sql ="SELECT Route,fa.Debcode FROM fDebtor as fd INNER JOIN fAJobHed as fa ON fd.DebCode=fa.Debcode";
     $sql ="SELECT cuscode , cusname FROM Customer";

     $result_rr = mysqli_query($connection,$sql);
     $users["customers"] = array();
       if (mysqli_num_rows($result_rr) != 0) {
        while($row_rr= mysqli_fetch_array($result_rr)){
                        $makeRrArr['code']=$row_rr['cuscode'];
			$makeRrArr['name']=$row_rr['cusname'];

			array_push($users["customers"],$makeRrArr);
        }
        return $users["customers"];
    } else {
      return $users["customers"];
    }


    }

      public static function getRouteWiseOrders($connection,$code) {
        $date = date('Y-m-d');
        $response = array();

        $sql = "SELECT * FROM orderheader WHERE RouteCode = '$code'";

       $result= mysqli_query($connection,$sql);
        while ($row = mysqli_fetch_array($result)){

//            $temp['RefNo']=$row['RefNo'];
//            $temp['CusCode']=$row['CusCode'];
//            $temp['TotAmt']=$row['TotAmt'];
//            $temp['Date']=$row['TxnDate'];
//            $temp['RepCode']=$row['Repcode'];
//            $temp['RouteCode']=$row['RouteCode'];
//            $temp['Remark']=$row['Remark'];

            $temp['RefNo']=$row['RefNo'];
            $temp['CusCode']=$row['CusCode'];
            $temp['TotAmt']=$row['TotAmt'];
            $temp['TxnDate']=$row['TxnDate'];
            $temp['Repcode']=$row['Repcode'];
            $temp['RouteCode']=$row['RouteCode'];
            $temp['Remark']=$row['Remark'];
             $cuscode =$row['CusCode'];
             $routecode = $row['RouteCode'];
            $sql2 = "SELECT cusname FROM customer WHERE cuscode = '$cuscode'";

            $result2= mysqli_query($connection,$sql2);
        while ($row2 = mysqli_fetch_array($result2)){

            $temp['CusName'] = $row2['cusname'];

            }
            $sql3 = "SELECT routename FROM route WHERE routecode = '$routecode'";

            $result3= mysqli_query($connection,$sql3);
        while ($row3 = mysqli_fetch_array($result3)){

            $temp['RouteName'] = $row3['routename'];

            }

//            $taskId =$row['IndexNo'];
//            $sql2 = "SELECT SUM(hours) as ActualH FROM fDailyActivity WHERE TaskId = '$taskId'";
//
//            $result2=sqlsrv_query($this->conn,$sql2);
//            while ($row2=sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)){
//
//            $temp['ActualHrs'] = $row2['ActualH'];
//
//            }

        $response[]= $temp;
        }

         $results = array(
"draw" => 1,
"recordsTotal" => count($response),
"recordsFiltered" => count($response),
"data"=>$response);


        return $results;

    }
    public static function getUserDetails($connection) {
        $date = date('Y-m-d');
        $response = array();

        $sql = "SELECT * FROM User WHERE Prefix <> '' and Status = '1'";

       $result= mysqli_query($connection,$sql);
        while ($row = mysqli_fetch_array($result)){

            $temp['Name']=$row['Name'];
            $temp['UserName']=$row['UserName'];
            $temp['MacId']=$row['MacId'];
            $temp['Mobile']=$row['Mobile'];
            $temp['Address']=$row['Address'];
            $temp['Code']=$row['Code'];
            $temp['Prefix']=$row['Prefix'];

        $response[]= $temp;
        }

         $results = array(
"draw" => 1,
"recordsTotal" => count($response),
"recordsFiltered" => count($response),
"data"=>$response);


        return $results;

    }
    public static function getCustomerDetails($connection) {
        $date = date('Y-m-d');
        $response = array();

        $sql = "SELECT * FROM Customer where status = '1'";

       $result= mysqli_query($connection,$sql);
        while ($row = mysqli_fetch_array($result)){

            $temp['Name']=$row['cusname'];
            $temp['route']=$row['routecode'];
            $temp['Email']=$row['email'];
            $temp['Mobile']=$row['mobile'];
            $temp['Address']=$row['address'];
            $temp['Code']=$row['cuscode'];

        $response[]= $temp;
        }

         $results = array(
"draw" => 1,
"recordsTotal" => count($response),
"recordsFiltered" => count($response),
"data"=>$response);


        return $results;

    }

    public static function getItemDetails($connection) {
        $date = date('Y-m-d');
        $response = array();

        $sql = "SELECT itm.*, pri.Price  from item itm , itempri pri where itm.ItemCode = pri.ItemCode and pri.ActiveStatus = '1'";

       $result= mysqli_query($connection,$sql);
        while ($row = mysqli_fetch_array($result)){

            $temp['Name']=$row['ItemName'];
            $temp['Code']=$row['ItemCode'];
            $temp['UnitOfM']=$row['UOM'];
            $temp['Price']=$row['Price'];

        //     $itemcode = $row['ItemCode'];

        //     $sql3 = "SELECT price FROM itempri WHERE itemcode = '$itemcode'";

        //     $result3= mysqli_query($connection,$sql3);
        //     if($result3 == TRUE){
        // while ($row3 = mysqli_fetch_array($result3)){

        //     $temp['Price'] = $row3['Price'];

        //     }
        // }else{
        //     $temp['Price'] = '0';

        // }

        $response[]= $temp;
        }

         $results = array(
"draw" => 1,
"recordsTotal" => count($response),
"recordsFiltered" => count($response),
"data"=>$response);


        return $results;

    }

      public static function getCustomerOrders($connection,$code) {
        $date = date('Y-m-d');
        $response = array();

        $sql = "SELECT * FROM orderheader WHERE CusCode = '$code'";

       $result= mysqli_query($connection,$sql);
        while ($row = mysqli_fetch_array($result)){

//            $temp['RefNo']=$row['RefNo'];
//            $temp['CusCode']=$row['CusCode'];
//            $temp['TotAmt']=$row['TotAmt'];
//            $temp['Date']=$row['TxnDate'];
//            $temp['RepCode']=$row['Repcode'];
//            $temp['RouteCode']=$row['RouteCode'];
//            $temp['Remark']=$row['Remark'];

            $temp['RefNo']=$row['RefNo'];
            $temp['CusCode']=$row['CusCode'];
            $temp['TotAmt']=$row['TotAmt'];
            $temp['TxnDate']=$row['TxnDate'];
            $temp['Repcode']=$row['Repcode'];
            $temp['RouteCode']=$row['RouteCode'];
            $temp['Remark']=$row['Remark'];
             $cuscode =$row['CusCode'];
             $routecode = $row['RouteCode'];
            $sql2 = "SELECT cusname FROM customer WHERE cuscode = '$cuscode'";

            $result2= mysqli_query($connection,$sql2);
        while ($row2 = mysqli_fetch_array($result2)){

            $temp['CusName'] = $row2['cusname'];

            }
            $sql3 = "SELECT routename FROM route WHERE routecode = '$routecode'";

            $result3= mysqli_query($connection,$sql3);
        while ($row3 = mysqli_fetch_array($result3)){

            $temp['RouteName'] = $row3['routename'];

            }

//            $taskId =$row['IndexNo'];
//            $sql2 = "SELECT SUM(hours) as ActualH FROM fDailyActivity WHERE TaskId = '$taskId'";
//
//            $result2=sqlsrv_query($this->conn,$sql2);
//            while ($row2=sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)){
//
//            $temp['ActualHrs'] = $row2['ActualH'];
//
//            }

        $response[]= $temp;
        }

         $results = array(
"draw" => 1,
"recordsTotal" => count($response),
"recordsFiltered" => count($response),
"data"=>$response);


        return $results;

    }
    public static function getItems($connection) {
           // $sql ="SELECT Route,fa.Debcode FROM fDebtor as fd INNER JOIN fAJobHed as fa ON fd.DebCode=fa.Debcode";
     $sql ="SELECT ItemCode , ItemName FROM item where Status <> '0'";

     $result = mysqli_query($connection,$sql);
     $users["users"] = array();
       if (mysqli_num_rows($result) != 0) {
        while($row= mysqli_fetch_array($result)){
                        $makeRrArr['code']=$row['ItemCode'];
			$makeRrArr['name']=$row['ItemName'];

			array_push($users["users"],$makeRrArr);
        }
        return $users["users"];
    } else {
      return $users["users"];
    }


    }
     public static function getMonthOrders($connection){
        $date = date('Y-m-d');
        $response = array();

        $sql = "SELECT * FROM orderheader WHERE MONTH(TxnDate) = MONTH(CURRENT_DATE())
AND YEAR(TxnDate) = YEAR(CURRENT_DATE())";

       $result= mysqli_query($connection,$sql);
        while ($row = mysqli_fetch_array($result)){

//            $temp['RefNo']=$row['RefNo'];
//            $temp['CusCode']=$row['CusCode'];
//            $temp['TotAmt']=$row['TotAmt'];
//            $temp['Date']=$row['TxnDate'];
//            $temp['RepCode']=$row['Repcode'];
//            $temp['RouteCode']=$row['RouteCode'];
//            $temp['Remark']=$row['Remark'];

            $temp['RefNo']=$row['RefNo'];
            $temp['CusCode']=$row['CusCode'];
            $temp['TotAmt']=$row['TotAmt'];
            $temp['TxnDate']=$row['TxnDate'];
            $temp['Repcode']=$row['Repcode'];
            $temp['RouteCode']=$row['RouteCode'];
            $temp['Remark']=$row['Remark'];
             $cuscode =$row['CusCode'];
             $routecode = $row['RouteCode'];
            $sql2 = "SELECT cusname FROM customer WHERE cuscode = '$cuscode'";

            $result2= mysqli_query($connection,$sql2);
        while ($row2 = mysqli_fetch_array($result2)){

            $temp['CusName'] = $row2['cusname'];

            }
            $sql3 = "SELECT routename FROM route WHERE routecode = '$routecode'";

            $result3= mysqli_query($connection,$sql3);
        while ($row3 = mysqli_fetch_array($result3)){

            $temp['RouteName'] = $row3['routename'];

            }

//            $taskId =$row['IndexNo'];
//            $sql2 = "SELECT SUM(hours) as ActualH FROM fDailyActivity WHERE TaskId = '$taskId'";
//
//            $result2=sqlsrv_query($this->conn,$sql2);
//            while ($row2=sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)){
//
//            $temp['ActualHrs'] = $row2['ActualH'];
//
//            }

        $response[]= $temp;
        }

         $results = array(
"draw" => 1,
"recordsTotal" => count($response),
"recordsFiltered" => count($response),
"data"=>$response);


        return $results;

    }
    public static function getDateWiseOrders($connection,$from,$to){
        $date = date('Y-m-d');
        $response = array();
      //fDailyActivity.TxnDate >= '$from' AND fDailyActivity.TxnDate <= '$to'
        $sql = "SELECT * FROM orderheader WHERE TxnDate >= '$from' AND TxnDate <= '$to'";

       $result= mysqli_query($connection,$sql);
        while ($row = mysqli_fetch_array($result)){

//            $temp['RefNo']=$row['RefNo'];
//            $temp['CusCode']=$row['CusCode'];
//            $temp['TotAmt']=$row['TotAmt'];
//            $temp['Date']=$row['TxnDate'];
//            $temp['RepCode']=$row['Repcode'];
//            $temp['RouteCode']=$row['RouteCode'];
//            $temp['Remark']=$row['Remark'];

            $temp['RefNo']=$row['RefNo'];
            $temp['CusCode']=$row['CusCode'];
            $temp['TotAmt']=$row['TotAmt'];
            $temp['TxnDate']=$row['TxnDate'];
            $temp['Repcode']=$row['Repcode'];
            $temp['RouteCode']=$row['RouteCode'];
            $temp['Remark']=$row['Remark'];
             $cuscode =$row['CusCode'];
             $routecode = $row['RouteCode'];
            $sql2 = "SELECT cusname FROM customer WHERE cuscode = '$cuscode'";

            $result2= mysqli_query($connection,$sql2);
        while ($row2 = mysqli_fetch_array($result2)){

            $temp['CusName'] = $row2['cusname'];

            }
            $sql3 = "SELECT routename FROM route WHERE routecode = '$routecode'";

            $result3= mysqli_query($connection,$sql3);
        while ($row3 = mysqli_fetch_array($result3)){

            $temp['RouteName'] = $row3['routename'];

            }

//            $taskId =$row['IndexNo'];
//            $sql2 = "SELECT SUM(hours) as ActualH FROM fDailyActivity WHERE TaskId = '$taskId'";
//
//            $result2=sqlsrv_query($this->conn,$sql2);
//            while ($row2=sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)){
//
//            $temp['ActualHrs'] = $row2['ActualH'];
//
//            }

        $response[]= $temp;
        }

         $results = array(
"draw" => 1,
"recordsTotal" => count($response),
"recordsFiltered" => count($response),
"data"=>$response);


        return $results;

    }
	public static function insertDataToTable($table_name,$column_names,$values,$connection){
		$insert=mysqli_query($connection,"INSERT INTO $table_name($column_names) VALUES($values)") or die(mysqli_error());
		if(!$insert)
			return 0;
		else
			return 1;
	}

	public static function MysqlQuery($query,$connection){
		return mysqli_query($connection,$query);
	}




	public static function TrimRealEscape($ck_string){
		return mysqli_real_escape_string(trim($ck_string));
	}

	public static function GetNumberFormat($number){
		return number_format($number,2,'.',',');
	}


    public static function GetRouteNo(){
		$result_dis=mysql_query("SELECT (COUNT(`r_id`)+1) FROM `tbl_route`");
		$row_po=mysql_fetch_row($result_dis);
		return $row_po[0];
	}


	public static function GetProductId() {
		$result_product = mysql_query("SELECT (COUNT(`p_id`)+1) FROM `tbl_product`");
		$row_pID = mysql_fetch_row($result_product);
		return $row_pID[0];
	}



	public function GetRep($userId) {
		$result_salesRep = "select u_id,u_name from tbl_user order by u_name";
		while ($row_userName = mysql_fetch_row($result_salesRep)) {
		?>
		<option value="<?php echo $row_userName[0]; ?>" <?php
		if ($userId == $row_userName[0]) {
		echo "selected";
		}
		?>><?php echo $row_userName[1]; ?></option>
		<?php
		}
	}



	public static function getMonth($month){
		$month=$month;
		?>
		<option value="01" <?php if($month != "" && $month=="01"){echo "selected";}?>>January</option>
		<option value="02" <?php if($month != "" && $month=="02"){echo "selected";}?>>February</option>
		<option value="03" <?php if($month != "" && $month=="03"){echo "selected";}?>>March</option>
		<option value="04" <?php if($month != "" && $month=="04"){echo "selected";}?>>April</option>
		<option value="05" <?php if($month != "" && $month=="05"){echo "selected";}?>>May</option>
		<option value="06" <?php if($month != "" && $month=="06"){echo "selected";}?>>June</option>
		<option value="07" <?php if($month != "" && $month=="07"){echo "selected";}?>>July</option>
		<option value="08" <?php if($month != "" && $month=="08"){echo "selected";}?>>August</option>
		<option value="09" <?php if($month != "" && $month=="09"){echo "selected";}?>>September</option>
		<option value="10" <?php if($month != "" && $month=="10"){echo "selected";}?>>October</option>
		<option value="11" <?php if($month != "" && $month=="11"){echo "selected";}?>>November</option>
		<option value="12" <?php if($month != "" && $month=="12"){echo "selected";}?>>December</option>
		<?php
	}

	public static function getMonthName($month_no){
		if($month_no == 1 || $month_no == "01"){
			return "January";
		}else if($month_no == 2 || $month_no == "02"){
			return "February";
		}else if($month_no == 3 || $month_no == "03"){
			return "March";
		}else if($month_no == 4 || $month_no == "04"){
			return "April";
		}else if($month_no == 5 || $month_no == "05"){
			return "May";
		}else if($month_no == 6 || $month_no == "06"){
			return "June";
		}else if($month_no == 7 || $month_no == "07"){
			return "July";
		}else if($month_no == 8 || $month_no == "08"){
			return "August";
		}else if($month_no == 9 || $month_no == "09"){
			return "September";
		}else if($month_no == 10){
			return "October";
		}else if($month_no == 11){
			return "November";
		}else if($month_no == 12){
			return "December";
		}
	}














}
?>
