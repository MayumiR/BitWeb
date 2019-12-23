<?php
session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Daily |Rpt</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap Core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
        <link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">

<!-- <script>

 function autoRefresh1()
{
	   window.location.reload();
}

 // setInterval('autoRefresh1()', 18000); // this will reload page after every 5 secounds; Method II
</script> -->

        <script type="text/javascript">

//            function FilterUsersByDivision(sel) {
//
//                var division = sel.value;
//                $.ajax({
//                    url: 'filterUsersbyDivision.php?costCode=' + division,
//                    success: function (data) {
//
//                        $("#user").html(data);
//                    }
//                });
//            }


            $(document).ready(function () {
              var table = $('#orders').DataTable({
                "order": [[1, 'asc']],
            //    dom: 'Bfrtip',
                           buttons: [
                               'copy', 'excel', 'pdf', 'print'
                           ]
              });
            });
        </script>
        <style>
            @import url(https://fonts.googleapis.com/css?family=Lato:300,400,700);
            .navbar{
                background-color: #005983;
                color: #FFFFFF;
                margin: 0px;
                padding: 0px;
                margin-bottom: 0;
            }

            .container{

                padding: 5px;

            }
            body{

                background: #FFFFFF;
                font-family: 'Lato', Arial, sans-serif;
            }
            label{
                color: #000;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: max-content;
                padding: 3px;
            }

            tr,th{
                padding: 1px;
                color: #000;
                width: 10px;
                background: #afd9ee;
                border: 0px solid #fff;
                font-size: 12px;

            }


        </style>
    </head>

    <body>
        <div class="wrapper">
            <div class="navbar navbar-inverse navbar-static-top" role="navigation">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php" title=''><span class="glyphicon glyphicon-chevron-left"></span> Back </a>
                </div>
                <div class="navbar-collapse collapse">
<!--                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#dailyRpt" role="button" id="btnFilter" data-target="#dailyRpt"  data-toggle="modal"><span class="glyphicon glyphicon-leaf"></span> Filter</a>
                            <u
                    </li>

                </ul>-->



            </div><!--/.nav-collapse -->

        </div>
        <!-- Modal -->
        <div class="modal fade" id="dailyRpt" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Daily Report of -  <?php echo $_SESSION["user_name"] ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">

                            <label  for="inputPassword3" >Select Date</label>

                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" id="date1" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>

<script type="text/javascript">
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
$(function () {
      $('#datetimepicker1').datetimepicker({
          format: 'D-M-Y',
          defaultDate: new Date()

      });
function ReplaceNumberWithCommas(yourNumber) {
    //Seperates the components of the number
    var n= yourNumber.toString().split(".");
    //Comma-fies the first part
    n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //Combines the two sections
    return n.join(".");
}

      $("a[data-toggle=modal]").click(function(){
          var ref_no = '';
              ref_no =  $(this).data('ref-no');
                  $.ajax({
                      url:"dailyReportDetails.php",
                      method: "POST",
                      data:{ref_no:ref_no},
                      dataType:"JSON",
                      success:function(data)
                      {
                        var results = data['data'];
                        var html = '';
                        $('#body-daily-report').html('');
                        var total = 0;
                        $.each(results, function( index, value ) {
                              html  += '<tr>';
                              html += '<td></td>';
                              html += '<td>'+value.name+'</td>';
                              html += '<td>'+value.qty+'</td>';
                              html += '<td>'+value.price+'</td>';
                              //html += '<td>'+parseInt(value.amount).toLocaleString()+'</td>';Number($(this).val()
                                 html += '<td>'+ReplaceNumberWithCommas(Number(value.amount))+'</td>';
                              html += '</tr>';
                             total += Number(value.amount);


                        });
                        $('#body-daily-report').append(html);
                        $('#grand_total').html(total);
                      }
                  });
                });
              });

  </script>
</div>
    </div>
    <div class="modal-footer">
        <button type="button" id="Drpt" class="btn btn-default" data-dismiss="modal">View Report</button>

    </div>
                </div>
            </div>
        </div>

        <!--date range search-->
        <!--title -->
        <?php
            $response = array();
            $date = date('Y-m-d');
            $sql = "SELECT * FROM orderheader where TxnDate = '$date' ";
            $result= mysqli_query($connection,$sql);
            while ($row = mysqli_fetch_assoc($result)){
                $temp['RefNo']=$row['RefNo'];
                $temp['CusCode']=$row['CusCode'];
                $temp['TotAmt']=$row['TotAmt'];
                $temp['TxnDate']=$row['TxnDate'];
                $temp['Repcode']=$row['Repcode'];
                $temp['RouteCode']=$row['RouteCode'];
                $temp['Remark']=$row['Remark'];
                $cuscode =$row['CusCode'];
                $routecode = $row['RouteCode'];
                $sql2 = "SELECT cusname FROM customer WHERE cuscode = '$cuscode'";

                $result2= mysqli_query($connection,$sql2);
            while ($row2 = mysqli_fetch_assoc($result2)){

                $temp['CusName'] = $row2['cusname'];

                }
                $sql3 = "SELECT routename FROM route WHERE routecode = '$routecode'";

                $result3= mysqli_query($connection,$sql3);
            while ($row3 = mysqli_fetch_assoc($result3)){

                $temp['RouteName'] = $row3['routename'];

                }
            $response[]= $temp;
            $results = array(
              "draw" => 1,
              "recordsTotal" => count($response),
              "recordsFiltered" => count($response),
              "data"=>$response);
            }
        ?>
    <div class="container">
   <div class="table-responsive">
       <table id="orders" class="table table-striped table-bordered table-hover" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>RefNo</th>
                <th>Customer</th>
                <th>Route</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
          <?php
           foreach($results['data'] as $result){?>
             <tr>
             <td></td>
             <td><?php echo $result['RefNo']; ?></td>
             <td><?php echo $result['CusName']; ?></td>
             <td><?php echo $result['RouteCode']; ?></td>
             <td><?php echo $result['TxnDate']; ?></td>
             <td><?php echo $result['TotAmt']; ?></td>
             <td><a href="#daily-report-detail" role="button" id="daily-report" data-target="#daily-report-detail" data-ref-no="<?php echo $result['RefNo']; ?>"  data-toggle="modal">View Detail</a></td>
             <!-- <td><button class="btn btn-sm btn-primary" style="cursor: pointer" onclick="window.open('dailyReportDetails.php?ref_no=<?php echo $result['RefNo']; ?>')">View Detail</button></td> -->
           </tr>
           <?php }?>
        </tbody>
    </table>
    <!--------------------------------Create Route------------------------------------------------>
<div class="modal fade" id="daily-report-detail" tabindex="-1" role="dialog" aria-labelledby="daily-report-detail" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                           <div class="modal-content">
                             <div class="modal-header">
                                   <h2 class="modal-title" id="exampleModalLabel">Detail of Daily Report</h2>
                               </div>
                               <div class="modal-body">
                                 <div class="row">
                                      <div class="table-responsive">
                                          <table id="orders-detail" class="table table-striped table-bordered table-hover" style="width:100%">
                                           <thead>
                                               <tr>
                                                   <th></th>
                                                   <th>Item Name</th>
                                                   <th>Qty</th>
                                                   <th>Price</th>
                                                   <th>Amount</th>
                                               </tr>
                                           </thead>
                                           <tbody  id="body-daily-report">

                                           </tbody>
                                           <tfoot>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td>Total</td>
                                             <td id="grand_total"></td>
                                           </tfoot>
                                       </table>
                                     </div>
                                    </div>
                               </div>
                               <div class="modal-footer">
                                   <div class="span pull-left">
                                       <div class="alert alert-danger fade">
                                           <button type="button" class="close" data-dismiss="alert">Ã—</button>
                                           <strong id="error">Alert!</strong> Please fill all fields.
                                       </div>
                                   </div>
                                   <button class="btn btn-info"  data-dismiss="modal" aria-hidden="true">Cancel</button>
                               </div>
                           </div>
                       </div>
                   </div>
<!-- end create Route------------------------------------------------------------------------------------------------------------------>

            </div>

                    </div>

        <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>

                    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
                    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
    </div>
</body>
</html>
