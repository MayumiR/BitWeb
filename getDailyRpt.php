<?php

require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();

$getOrders = dataFunctions::getAllOrders($connection);
echo json_encode($getOrders);
