<?php

session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
//$dataFunctions = new functions();
    
//den meka balanna thiyenne..me tika witha
$name = 'R'.$_REQUEST['name'];
$code = $_REQUEST['code'];
$status = '1';

$result  = dataFunctions::saveRoutes($connection,$code,$name,$status);
//echo $name.'-'.$code.'-'.$status;
echo $result;
