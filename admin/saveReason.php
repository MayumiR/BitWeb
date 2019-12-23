<?php

session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
//$dataFunctions = new functions();
    
//den meka balanna thiyenne..me tika witha
$name = $_REQUEST['name'];
$code = 'ex'.$_REQUEST['code'];
$type = $_REQUEST['type'];
$status = '1';

$result  = dataFunctions::saveReasons($connection,$code,$name,$type,$status);
//echo $name.'-'.$code.'-'.$status;
echo $result;
