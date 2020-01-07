<?php
session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
$refno = $_REQUEST['refno'];
$getOrderDetails = dataFunctions::getOrdDetails($connection,$refno);
echo json_encode($getOrderDetails);
//$dataFunctions = new functions();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

