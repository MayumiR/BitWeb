<?php

session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();

$code = $_REQUEST['KeyCode'];
$txntype = $_REQUEST['txn'];

// $result = '400';
// if($txntype == 'usertxn'){
    $result  = dataFunctions::removeTxn($connection,$code,$txntype);
// }else if($txntype == 'customertxn'){
//     $result  = dataFunctions::removeCustomer($connection,$code);
// }
echo $result;