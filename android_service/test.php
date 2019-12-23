<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../db/DBConnection.php';
 
$connection=(new DBConnection())->getDBConnection();
echo 'test'.$_REQUEST['mac_id']; 


