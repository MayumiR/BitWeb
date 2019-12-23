<?php
session_start();
require_once './db/DBConnection.php';
require_once './functions.php';
$connection=(new DBConnection())->getDBConnection();
$user_info=array();
$user_info=dataFunctions::CheckUser($_POST['uname'],$_POST['pwd'],$connection);
$_SESSION['user_name']=$user_info['u_name'];
$_SESSION['user_route']=$user_info['u_route'];
$_SESSION['user_code']=$user_info['u_rep'];
echo $user_info["u_name"];
if($user_info["u_name"] == "admin"){
    header('Location:admin/index.php');
}else{
    header('Location:index.php');
}

?>
