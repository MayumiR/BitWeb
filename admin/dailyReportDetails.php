<?php
session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
if (isset($_POST['ref_no'])) {
    $ref_no = $_POST['ref_no'];
    $response = array();
    $sql = "SELECT
       orderdetail.Price,
       orderdetail.Amount,
       orderdetail.Qty,
       item.ItemName
     FROM orderdetail
     inner join item on item.ItemCode = orderdetail.ItemCode
    where RefNo = '$ref_no'";
    $result= mysqli_query($connection,$sql);
    while ($row = mysqli_fetch_assoc($result)){
        $temp['name']=$row['ItemName'];
        $temp['qty']=$row['Qty'];
        $temp['amount']=$row['Amount'];
        $temp['price']=$row['Price'];
    $response[]= $temp;
    $results = array(
      "draw" => 1,
      "recordsTotal" => count($response),
      "recordsFiltered" => count($response),
      "data"=>$response);
    }
echo json_encode($results);

}
?>
