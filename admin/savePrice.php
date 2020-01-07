<?php

session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();

$price = $_REQUEST['price'];
$code =  $_REQUEST['code'];
date_default_timezone_set('Asia/Colombo');
//$date = date('Y-m-d');
//$Instatus = '1';
//$Upstatus = '0';

$result  = dataFunctions::priceAllocate($connection,$code,$price);
//echo $name.'-'.$code.'-'.$status;
echo $result;
