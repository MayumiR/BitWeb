<?php

session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();

$code = $_REQUEST['code'];
$name = $_REQUEST['name'];
$mobile = $_REQUEST['mobil'];
$address = $_REQUEST['addrs'];
$txntype = $_REQUEST['txn'];

//alert(edtname+'-'+edtAdrs+' mm '+edtMob);


if(preg_match('/^[0-9]{10}+$/', trim($mobile))) {
    // $phone is valid
      $result  = dataFunctions::updateData($connection,$name,$code,$address,$mobile,$txntype);
      echo $result;
  }else{
      echo 'Invalid number';
  }