<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: index.php");
}

require_once("../db/DBConnection.php");
require_once("../functions.php");
$connection=(new DBConnection())->getDBConnection();
$getRoutes = dataFunctions::getRoutes($connection);
$getUsers = dataFunctions::getUsers($connection);
$getItems = dataFunctions::getItems($connection);
//print_r($getRoutes);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>HOME</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <link href="../lib/sweetalert.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/sweetalert.js" type="text/javascript"></script>
        <script src="../lib/sweetalert.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
        <link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">

        <script type="text/javascript">
            
             $(document).ready(function () {
                var table = $('#orders').DataTable();
                    table.destroy();
                 //main order table
                $('#orders').DataTable( {
        "ajax": "getOrders.php",
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
            { "data": "TotAmt" },
           {"mRender": function (data, type, row) {

                        return "<button class='btn btn-primary btn-xs' href='#ordertxn'  data-toggle='modal' data-target='#ordertxn' ><span class='glyphicon  glyphicon-eye-open' aria-hidden='true'></span></button>";
                                  
                               }
                           }
        ],
        "order": [[1, 'asc']],
        dom: 'Bfrtip',
                            buttons: [
                                'copy', 'excel', 'pdf', 'print'
                            ]
    } );
    //when main order table , view button click event

    $('#orders').on('click', 'button', function () {

        var data = $('#orders').DataTable().row($(this).closest('tr')).data();

        var refno = data.RefNo;

        $("#refnofortitle").text("Details Of Order RefNo - "+refno);

     //detail table show
     var table = $('#detailtable').DataTable();
                    table.destroy();
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
                
                 $(".repRoute").click(function () {

                   
                        $('#repRoute').modal('show');
                 
                });

                  
// assign route 
                $("#saveRR").click(function () {
                    var RepCode = document.getElementById("rep_code").value;
                    var RouteCode = document.getElementById("route_code_ar").value;
                
                   //alert(RepName+"-"+RepAddress+"-"+RepPwd+"-"+RepMobile+"-"+RepPrefix);

                    if (RouteCode == "0" || RepCode == "0") {
                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation
                    }else{
              
                              $.post("assignRoute.php", {

                                repcode: RepCode,
                                routecode: RouteCode

                            }, function (data) {
                                //alert(data);
                                if (data == 200) {
                                    //    alert("Task Saved");
                                    //$('#newRt').modal('hide');
                                    swal("Route Assigned");
                                    window.location.href = 'index.php';
                                    

                                } else {
                                    // alert("Task not Saved");
                                    swal("Route not Assigned");

                                }

                            });
                        
                        }
                     });
               

      
        $(document).on('click', '.edit', function()
        {
            alert(1234);
        });


});// doc.ready function close

               
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
            .dataTables_filter {
                display: none;
            }
            .container{
                width: 100%;
                padding: 5px;

            }
            
            html, body {
                max-width: 100%;
                overflow-x: hidden;
                background: #FFFFFF;
                font-family: 'Lato', Arial, sans-serif;
            }


            label{
                color: #000;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 200px;
                padding: 3px;
            }
            .remarks{
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 70px;
                padding: 1px; 
            }
            th{
                font-size: 12px;
                width: max-content;
                white-space: nowrap;
                color: #000;
                font-weight: bold;
                padding: 1px;

            }
            td{
                font-size: 12px;
                color: #000;
                padding: 1px;
            }

            .tool_tip:hover{
                background-color: #007bb6;
            }

            tfoot {
                display: table-header-group;
            }
            #editDIV {
                width: 100%;
                padding: 5px 0;

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
                                <a class="navbar-brand" href="index.php" title=''><span class="glyphicon glyphicon-time"></span> SFA </a>
                            </div>

                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li>
                                        <a href="user_transactions.php" role="button" >Users</a>
                                    </li>
                                    
                                    <li>
                                        <a href="customer_transactions.php" role="button">Customers</a>
                                    </li>
                                    <li>
                                        <a href="item_transactions.php" role="button">Items</a>
                                    </li>
                                    <li>
                                        <a href="route_transactions.php" role="button">Routes</a>
                                    </li>
                                    <li>
                                        <a href="#repRoute" role="button" id="rep_route" data-target="#assignRt"  data-toggle="modal"><span class="glyphicon glyphicon-ok"></span> Assign Route</a>
                                    </li>
                                    <li>
                                        <a href="reason_transactions.php" role="button">Reasons</a>
                                    </li>
                                
                                
                                    <li class="dropdown">
                                        <a href="#" id="filterRcd" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Reports <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="userReport.php" role="button" > Users</a>
                                            </li>
                                            <li>
                                                <a href="customerDetailsReport.php" role="button" > Customers</a>
                                            </li>
                                            <li>
                                                <a href="itemReport.php" role="button" >Items</a>
                                            </li>
                                            <li>
                                                <a href="priceReport.php" role="button" >Prices</a>
                                            </li>
                                            <li>
                                                <a href="routeReport.php" role="button" >Routes</a>
                                            </li>
                                            <li>
                                                <a href="reasonReport.php" role="button" >Reasons</a>
                                            </li>
                                            <li>
                                                <a href="attendanceReport.php" role="button" > Attendance</a>
                                            </li>
                                            <li>
                                                <a href="dailyReport.php" role="button" > Today Sale</a>
                                            </li>
                                            <li>
                                                <a href="dateWiseReport.php" role="button" > Date Wise Sale</a>
                                            </li>
                                           <li>
                                                <a href="customerReport.php" role="button" > Customer Wise Sale</a>
                                            </li>
                                            <li>
                                                <a href="routewise.php"  role="button" > Route Wise Sale</a>
                                            </li> 
                                            <li>
                                                <a href="repwisesalesReport.php"  role="button" > Rep Wise Sale</a>
                                            </li> 
                                            <li>
                                                <a href="nonproductiveReport.php"  role="button" > Nonproductive Calls</a>
                                            </li> 
                                            <li>
                                                <a href="expenseReport.php"  role="button" > Expenses</a>
                                            </li> 
                                        </ul>
                                    </li>

                                </ul>



                                <ul class="nav navbar-nav navbar-right">

                                    <li><a href="../logout.php" onclick="return confirm('Are you sure to logout?');"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["user_name"] ?>   <span class="glyphicon glyphicon-log-out"></span>    Logout</a></li>
                                </ul>

                            </div><!--/.nav-collapse -->
                        </div>


<!--------------------------------Create customer------------------------------------------------>

 <!-- end create user------------------------------------------------------------------------------------------------------------------>
         <!--------------------------------assign route------------------------------------------------>
<div class="modal fade" id="assignRt" tabindex="-1" role="dialog" aria-labelledby="assignRt" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Assign Route</h5>


                                    </div>
                                    <div class="modal-body">

                                         <div class="row">
                                           <div class="col col-md-6">
                                               <div class="form-group">

                                                    <label 
                                                        for="inputPassword3" >Select Rep</label>
                                                    
                                                    <select id="rep_code" class="form-control" > 
                                                        <option value="0"> --SELECT-- </option>    
                                                        <?php foreach ($getUsers as $returnrow): ?>            

                                                            <option value="<?= $returnrow['code'] ?>" > <?php echo $returnrow['code'].' - '.$returnrow["name"]; ?> </option>

                                                        <?php endforeach; ?>
                                                    
                                                         

                                                    </select>
                                                </div>
                                            </div>
                                             <div class="col col-md-6">
                                               <div class="form-group">

                                                    <label for="inputPassword3" >Route</label>
                                                   <select id="route_code_ar" class="form-control" > 
                                                        <option value="0"> --SELECT-- </option>    
                                                        <?php foreach ($getRoutes as $returnrow): ?>            

                                                            <option value="<?= $returnrow['code'] ?>" > <?php echo $returnrow['code'].' - '.$returnrow["name"]; ?> </option>

                                                        <?php endforeach; ?>
                                                    
                                                         

                                                    </select>

                                                </div>
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
                                        <button id="saveRR" type="button" value="saveRoute" class="btn btn-primary">Save</button>
                                    </div>
                                </div>   
                            </div>
                        </div>
 <!-- end assign Route------------------------------------------------------------------------------------------------------------------>
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
