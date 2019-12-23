<?php

session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
//$dataFunctions = new functions();
    
//den meka balanna thiyenne..me tika witha
$name = $_REQUEST['name'];
$Address = $_REQUEST['address'];
$email = $_REQUEST['email'];
$Mobile = $_REQUEST['mobile'];
$route = $_REQUEST['route'];
$status = '1';
$code = 'C'.$Mobile;
if(preg_match('/^[0-9]{10}+$/', trim($Mobile))) {
  // $phone is valid
    if(!email_validation($email)){
        echo '300';
    }else{
        $result  = dataFunctions::saveCustomers($connection,$code,$name, $Address, $email, $Mobile, $route, $status);
    }

}else{
    echo 'Invalid number';
}
//echo $code.'-'.$name.'-'. $Address.'-'. $email.'-'. $Mobile.'-'. $route.'-'. $status;


function email_validation($str) { 
    return (!preg_match( 
"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str)) 
        ? FALSE : TRUE; 
} 