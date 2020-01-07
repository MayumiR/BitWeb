<?php

session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();

$code = $_REQUEST['code'];
$mac = $_REQUEST['mac'];

$result  = dataFunctions::assignMac($connection,$mac,$code);
echo $result;
