<?php
session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
$getUsers = dataFunctions::getUsers($connection);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Rep wise |Rpt</title>
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

        <script type="text/javascript">

            $(document).ready(function () {

            $("#Drpt").click(function () {

                var table = $('#orders').DataTable();
                    table.destroy();
                var code = document.getElementById("code").value;
                var txn = 'reptxn';
                      $('#orders').DataTable({

                        "ajax": "getSalesReports.php?code=" + code+"&txn="+txn,
                        "columns": [
                        {
                        "className":      'details-control',
                         "orderable":      false,
                         "data":           null,
                         "defaultContent": ''
                        },
                        { "data": "RefNo" },
                        { "data": "CusName" },
                        { "data": "RouteName" },
                        { "data": "TxnDate" },
                        { "data": "TotAmt" }
                        ,
                        {"mRender": function (data, type, row) {

                                   // var res = '<button class="btn btn-primary btn-xs"><span class="glyphicon  glyphicon-remove" aria-hidden="true"></span></button>';
                                   return "<button class='btn btn-primary btn-xs' href='#ordertxn'  data-toggle='modal' data-target='#ordertxn' ><span class='glyphicon  glyphicon-eye-open' aria-hidden='true'></span></button>";
                                  // return res;
                               }
                        }
        ],
        "order": [[1, 'asc']],
        dom: 'Bfrtip',
                            buttons: [
                                'copy', 'excel', 'pdf', 'print'
                            ]
                });
            });
        

        //sample for edit user
        $('#orders').on('click', 'button', function () {

            var data = $('#orders').DataTable().row($(this).closest('tr')).data();

            var refno = data.RefNo;


            $("#refnofortitle").text("Details Of Order RefNo - "+refno);

//detail table show
//var table = $('#detailtable').DataTable( {
    var table2 = $('#detailtable').DataTable();
                    table2.destroy();
   $('#detailtable').DataTable( {
   "ajax": "getOrderDets.php?refno="+refno,
   "columns": [
       {
           "className":      'details-control',
           "orderable":      false,
           "data":           null,
           "defaultContent": ''
       },
       { "data": "ItemCode" },
       { "data": "ItemName" },
       { "data": "Price" },
       { "data": "Qty" },
       { "data": "Amount" }
   
   ],
   "order": [[1, 'asc']]
} );
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
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#dailyRpt" role="button" id="btnFilter" data-target="#dailyRpt"  data-toggle="modal"><span class="glyphicon glyphicon-leaf"></span> Filter</a>
                            
                    </li>

                </ul>



            </div><!--/.nav-collapse -->

        </div>
        <!-- Modal -->
        <div class="modal fade" id="dailyRpt" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Rep Wise Sales Report</h4>
                    </div>
                    <div class="modal-body">
                         <div class="form-group">

                                                    <label
                                                        for="inputPassword3" >Select Rep</label>

                                                    <select id="code" class="form-control" >
                                                        <option value="0"> --SELECT-- </option>
                                                        <?php foreach ($getUsers as $returnrow): ?>

                                                            <option value="<?= $returnrow['code'] ?>" > <?php echo $returnrow['code'].' - '.$returnrow["name"]; ?> </option>

                                                        <?php endforeach; ?>



                                                    </select>
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

<!-- detail modal start-->
<!--------------------------------order details------------------------------------------------>
<div class="modal fade" id="ordertxn" tabindex="-1" role="dialog" aria-labelledby="ordertxn" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="refnofortitle">Details of order refno </h5>
                                    </div>
                                    <div class="modal-body">
                                   
<table  class="table table-striped table-bordered table-hover" id="detailtable" style="width:100%">
    <thead>
          <tr >
            <!-- <th  class="text-center">Item</th>
            <th  class="text-center">Quantity</th>
            <th  class="text-center">Price(Rs.)</th>
            <th  class="text-center">Amount</th> -->
            <th></th>
                <th>ItemCode</th>
                <th>ItemName</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Amount</th>
            
          </tr>
    </thead>	         	
     
  </table>


                                    </div><!-- close modal-body-->

                                   
                                </div>   
                            </div>
                        </div>
 <!-- end order------------------------------------------------------------------------------------------------------------------>
                
<!-- detail  modal end-->
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
                <th>Action</th>

            </tr>
        </thead>

    </table>

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
