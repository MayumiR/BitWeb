<?php
session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
$code = $_REQUEST['code'];
$txn = $_REQUEST['txn'];

if($txn == 'routetxn'){
    $getRouteWiseOrders = dataFunctions::getRouteWiseOrders($connection,$code);
    echo json_encode($getRouteWiseOrders);
}else if($txn == 'reptxn'){
    $getRepWiseOrders = dataFunctions::getRepWiseOrders($connection,$code);
    echo json_encode($getRepWiseOrders);
}else if($txn == 'custxn'){
    $getCustomerOrders = dataFunctions::getCustomerOrders($connection,$code);
    echo json_encode($getCustomerOrders);
}

