<?php
session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
$txn = $_REQUEST['txn'];
$getDateWiseOrders = dataFunctions::getDateWiseOrders($connection,$from,$to,$txn);
echo json_encode($getDateWiseOrders);


