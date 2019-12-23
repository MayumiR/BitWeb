<?php

session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
//$dataFunctions = new functions();
    
//den meka balanna thiyenne..me tika witha
$name = $_REQUEST['name'];
$code = 'I'.$_REQUEST['code'];
$uom = $_REQUEST['uom'];
$status = '1';

$result  = dataFunctions::saveItems($connection,$code,$name,$status,$uom);
//echo $name.'-'.$code.'-'.$status;
echo $result;
