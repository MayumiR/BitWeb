<?php
session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Order</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap Core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!--        <link href="../vendor/bootstrap/css/bootstrap.min.css.map" rel="stylesheet" type="text/css"/>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
        <script src="https://cdn.datatables.net/fixedcolumns/3.2.3/js/dataTables.fixedColumns.min.js"></script>
        <link href="../lib/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

        <script src="../lib/sweetalert.js" type="text/javascript"></script>
        <script src="../lib/sweetalert.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../vendor/datatables/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!--        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
        <link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">-->



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

       var refno = '<?php echo $refno; ?>';
//                alert(refno);
//
                    var table = $('#ordDet').DataTable();
                    table.destroy();
//
//                    $('#ordDet').DataTable({
//                        "ajax": "getOrderDetails.php?refno="+refno,
//        "columns": [
//            {
//                "className":      'details-control',
//                "orderable":      false,
//                "data":           null,
//                "defaultContent": ''
//            },
//            { "data": "ItemCode" },
//            { "data": "ItemName" },
//            { "data": "Amount" },
//            { "data": "Price" },
//            { "data": "Qty" },
////            {"mRender": function (data, type, row) {
////
////                                    return "<button class='btn btn-primary btn-xs' href='#'  data-toggle='modal' data-target='#' ><span class='glyphicon  glyphicon-pencil' aria-hidden='true'></button>  <a href='#' id='remove' role='button' class='btn btn-danger btn-xs'><span class='glyphicon  glyphicon-remove' aria-hidden='true'></span></a>"
////
////                                }
////                            }
//        ],
//        "order": [[1, 'asc']]
//
//                    });

                        $('#ordDet').DataTable({
//                        "processing": true,
//                        "searching": false,
//                        "paging": false,
                        "ajax": {
                            "url": "getOrderDetails.php?refno="+refno,
                            "type": "POST"
                        },
                        "columns": [
                            { "data": "ItemCode" },
                            { "data": "ItemName" },
                            { "data": "Amount" },
                            { "data": "Price" },
                            { "data": "Qty" }
                        ]
//                        ,
//                        
//                        dom: 'Bfrtip',
//                        buttons: [
//                            'copy', 'excel', 'pdf', 'print'
//                        ]

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

<!--                <div class="navbar-header">
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
                            <a href="#dailyRpt" role="button" id="task" data-target="#dailyRpt"  data-toggle="modal"><span class="glyphicon glyphicon-leaf"></span> Filter</a>
                            <u
                    </li>

                </ul>



            </div>/.nav-collapse -->

        </div>
        <!-- Modal -->

        <!--date range search-->
        <!--title -->


        <!--Actual hrs added time -->
        <div id = "userReport" class="container">
            <h3 >View order details of </h3>  
            <!--user report head -->
            <div class="table-responsive">
                <table width="100%" class="table table-striped table-bordered table-hover" id="ordDet">
                    <thead>
                        <tr>

                            <th>ItemCode</th>
                            <th>ItemName</th>
                            <th>Amount</th>
                            <th>Price</th>
                            <th>Qty</th>
                            
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="7" style="text-align:right">Total Amount Rs.</th>
                            <th></th>
                        </tr>
                    </tfoot>


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
