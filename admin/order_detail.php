<?php
session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
require("../fpdf181/fpdf.php");

$refno = $_REQUEST['refno'];
$getOrders = dataFunctions::getOrderDetail($connection,$refno);

$fpdf=new FPDF();
$fpdf->AddPage();
$fpdf->setFont("Arial","B",16);
$fpdf->Cell(0,10,"Amashi Distributors (PVT) LTD",0,1,"C");
$fpdf->setFont("Arial","B",14);
$fpdf->Cell(0,10,"Order detail of : ".$refno,0,1,"C");

$fpdf->setFont("Arial","B",8);
$fpdf->Cell(10,8,"Id",1,0,"L");
$fpdf->Cell(30,8,"ItemCode",1,0,"L");
$fpdf->Cell(68,8,"ItemName",1,0,"L");
$fpdf->Cell(25,8,"Price(Rs.)",1,0,"L");
$fpdf->Cell(25,8,"Quantity",1,0,"C");
$fpdf->Cell(32,8,"Amount(Rs.)",1,1,"R");

$fpdf->setFont("Arial","",8);



if(count($getOrders) > 0){

    $P_count = '0';

    foreach($getOrders as $returnrow):

    $fpdf->Cell(10,8,"No - ".++$P_count,1,0,"L");
    $fpdf->Cell(30,8, $returnrow["ItemCode"],1,0,"L");
    $fpdf->setFont("Arial","",8);
    $fpdf->Cell(68,8, $returnrow["ItemName"],1,0,"L");
    $fpdf->setFont("Arial","",8);
    $fpdf->Cell(25,8, $returnrow["Price"],1,0,"L");
    $fpdf->Cell(25,8,$returnrow["Qty"],1,0,"C");
    $fpdf->Cell(32,8,number_format($returnrow["Amount"], 2),1,1,"R");


    endforeach;}

    $fpdf->output();

//}
?>
