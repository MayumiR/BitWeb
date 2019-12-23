<?php
session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
$code = $_REQUEST['route'];

$getRouteWiseOrders = dataFunctions::getRouteWiseOrders($connection,$code);
echo json_encode($getRouteWiseOrders);
//$dataFunctions = new functions();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

