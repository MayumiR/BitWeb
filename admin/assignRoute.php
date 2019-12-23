<?php

session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
//$dataFunctions = new functions();
    
//den meka balanna thiyenne..me tika witha
$repcode = $_REQUEST['repcode'];
$routecode = $_REQUEST['routecode'];


$result  = dataFunctions::assignRoutes($connection,$repcode,$routecode);
//echo $repcode.'-'.$routecode;
//echo $result;
