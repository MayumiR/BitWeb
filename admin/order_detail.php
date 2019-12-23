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

//    $fpdf -> Ln();
//
//    $fpdf->setFont("Arial","B",8);
//    $fpdf->Cell(10,8,"Id",1,0,"L");
//    $fpdf->Cell(20,8,"Cus.Code",1,0,"L");
//    $fpdf->Cell(68,8,"Customer Name",1,0,"L");
//    $fpdf->Cell(22,8,"Reference No",1,0,"L");
//    $fpdf->Cell(22,8,"Total Value(Rs)",1,0,"R");
//    $fpdf->Cell(18,8,"Dis.(m)",1,0,"C");
//    $fpdf->Cell(15,8,"Start Time",1,0,"C");
//    $fpdf->Cell(15,8,"End Time",1,1,"C");
//    $fpdf->setFont("Arial","",8);
//           if(count($GetRepReceiptSummery['GetRepReceiptSummary']) > 0){
//              $P_count = '0';
//               foreach($GetRepReceiptSummery['GetRepReceiptSummary'] as $returnrow):
//
//
//    $fpdf->Cell(10,8,"R - ".++$P_count,1,0,"L");
//    $fpdf->Cell(20,8, $returnrow["DebCode"],1,0,"L");
//    $fpdf->setFont("Arial","",7);
//    $fpdf->Cell(68,8, $returnrow["DebName"],1,0,"L");
//    $fpdf->setFont("Arial","",8);
//    $fpdf->Cell(22,8, $returnrow["RefNo"],1,0,"L");
//    $fpdf->Cell(22,8,number_format($returnrow["TotalAmt"], 2),1,0,"R");
//    $fpdf->Cell(18,8,$returnrow["Distance"],1,0,"R");
//    $fpdf->Cell(15,8,substr($returnrow["StartTime"],strlen($returnrow["StartTime"])-8,strlen($returnrow["StartTime"])-6),1,0,"C");
//    $fpdf->Cell(15,8,substr($returnrow["EndTime"],strlen($returnrow["EndTime"])-8,strlen($returnrow["EndTime"])-6),1,1,"C");
//
//
//          endforeach;}
//          $fpdf->Ln();
//
//
//    $fpdf->setFont("Arial","B",8);
//    $fpdf->Cell(10,8,"Id",1,0,"L");
//    $fpdf->Cell(20,8,"Cus.Code",1,0,"L");
//    $fpdf->Cell(68,8,"Customer Name",1,0,"L");
//    $fpdf->Cell(22,8,"Distance",1,0,"L");
//    $fpdf->Cell(70,8,"Reason",1,1,"C");
//    $fpdf->setFont("Arial","",8);
//
//
//          if(count($GetNonProductiveSummary['GetNonProductiveSummary']) > 0){
//             $Nv_count = '0';
//              foreach($GetNonProductiveSummary['GetNonProductiveSummary'] as $returnrow):
//
//
//    $fpdf->Cell(10,8,"NP - ".++$Nv_count,1,0,"L");
//    $fpdf->Cell(20,8, $returnrow["DebCode"],1,0,"L");
//    $fpdf->setFont("Arial","",7);
//    $fpdf->Cell(68,8, $returnrow["DebName"],1,0,"L");
//    $fpdf->setFont("Arial","",8);
//    $fpdf->Cell(22,8, $returnrow["Distance"],1,0,"L");
//    $fpdf->Cell(70,8, $returnrow["Reason"],1,1,"L");
//
//
//              endforeach;}
//
//    $fpdf->Ln();
//    $fpdf->setFont("Arial","B",8);
//    $fpdf->Cell(10,8,"Id",1,0,"L");
//    $fpdf->Cell(20,8,"Cus.Code",1,0,"L");
//    $fpdf->Cell(70,8,"Customer Name",1,0,"L");
//    $fpdf->Cell(30,8,"Outstanding Amt.",1,1,"L");
//    $fpdf->setFont("Arial","",8);
//
//              if(count($GetNotVisitSummary['notVisitOutlets']) > 0){
//                $Nv_count = '0';
//                 foreach($GetNotVisitSummary['notVisitOutlets'] as $returnrow):
//    $fpdf->setFont("Arial","",6);
//    $fpdf->Cell(10,8,"NV - ".++$Nv_count,1,0,"L");
//    $fpdf->setFont("Arial","",8);
//    $fpdf->Cell(20,8, $returnrow["DebCode"],1,0,"L");
//    $fpdf->setFont("Arial","",6);
//    $fpdf->Cell(70,8, $returnrow["DebName"],1,0,"L");
//    $fpdf->setFont("Arial","",8);
//    $fpdf->Cell(30,8, $returnrow["OutstandingAmt"],1,1,"R");
//
//                endforeach;}

    $fpdf->output();

//}
?>
