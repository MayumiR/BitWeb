<?php

session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
//$dataFunctions = new functions();
    
//den meka balanna thiyenne..me tika witha
$price = $_REQUEST['price'];
$code = 'I'.$_REQUEST['code'];
//$Instatus = '1';
//$Upstatus = '0';

$result  = dataFunctions::priceAllocate($connection,$code,$price);
//echo $name.'-'.$code.'-'.$status;
echo $result;
