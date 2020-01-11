<?php

session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
//$dataFunctions = new functions();
    
//den meka balanna thiyenne..me tika witha
$Repname = $_REQUEST['name'];
$RepAddress = $_REQUEST['address'];
//$RepTarget = $_REQUEST['target'];
$RepPwd = md5($_REQUEST['pwd']);
$RepMobile = $_REQUEST['mobile'];
$RepPrefix = $_REQUEST['prefix'];
$code = $_REQUEST['code'];
$status = '1';
$uname = $_REQUEST['uname'];
$target = $_REQUEST['target'];

if(preg_match('/^[0-9]{10}+$/', trim($RepMobile))) {
  // $phone is valid
    $result  = dataFunctions::saveUsers($connection,$code,$Repname, $RepAddress, $RepPwd, $RepMobile, $RepPrefix, $status, $uname, $target);
    //echo $result;
}else{
    echo 'Invalid number';
}


