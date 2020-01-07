<?php

session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();

$name = $_REQUEST['name'];
$code = 'I'.$_REQUEST['code'];
$uom = $_REQUEST['uom'];
$status = '1';
$price = $_REQUEST['regprice'];

$result  = dataFunctions::saveItemsNew($connection,$code,$name,$status,$uom,$price);
//echo $name.'-'.$code.'-'.$status;
echo $result;
