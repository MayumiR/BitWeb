<?php
session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
$status = $_REQUEST['status'];
$txn = $_REQUEST['txn'];

    $getUserList = dataFunctions::getUserMasterData($connection,$status,$txn);
    echo json_encode($getUserList);


