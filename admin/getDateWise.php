<?php
session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];
$getDateWiseOrders = dataFunctions::getDateWiseOrders($connection,$from,$to);
echo json_encode($getDateWiseOrders);
//$dataFunctions = new functions();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

