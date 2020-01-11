<?php
session_start();
require_once '../db/DBConnection.php';
require_once '../functions.php';
$connection=(new DBConnection())->getDBConnection();
$getRoutes = dataFunctions::getRoutes($connection);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Reasons</title>
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
        <link href="../lib/sweetalert.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/sweetalert.js" type="text/javascript"></script>
        <script src="../lib/sweetalert.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
        <link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">

        <script type="text/javascript">

            $(document).ready(function () {

///////////////////////////////show tada via data table//////////////////////////////////////////////
                var table = $('#reasons').DataTable();
                    table.destroy();
                      $('#reasons').DataTable({
                        "ajax": "getReasonDetails.php",
                        "columns": [
                        {
                        "className":      'details-control',
                         "orderable":      false,
                         "data":           null,
                         "defaultContent": ''
                        },
                        { "data": "code" },
                        { "data": "type" },
                        { "data": "name" },
                        {"mRender": function (data, type, row) {
                             return "<button class='btn btn-primary btn-xs' href='#updateModal'  data-toggle='modal' data-target='#updateModal' ><span class='glyphicon  glyphicon-pencil' aria-hidden='true'> </span></button>    <a href='#' id='remove' role='button' class='btn btn-danger btn-xs'><span class='glyphicon  glyphicon-remove' aria-hidden='true'> </span></a> ";      
                        }
                        }
                        ],
                        "order": [[1, 'asc']],
                            dom: 'Bfrtip',
                            buttons: [
                                'copy', 'excel', 'pdf', 'print'
                            ]
                    });
                
//////////////////////////////show data function end ///////////////////////////////////////////////
//save reason......
                $("#saveReason").click(function () {
                    var Code = document.getElementById("reason_code").value;
                    var Name = document.getElementById("reason_name").value;
                    var Type = document.getElementById("reason_type").value;
                   
                   //alert(RepName+"-"+RepAddress+"-"+RepPwd+"-"+RepMobile+"-"+RepPrefix);

                    if (Code == "" || Name == "" || Type == "0") {
                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation
                    }else{
              
                              $.post("saveReason.php", {

                                name: Name,
                                type: Type,
                                code: Code

                            }, function (data) {
                                //alert(data);
                                
                                if (data == 200) {
                                    //    alert("Task Saved");
                                    //$('#newRt').modal('hide');
                                    swal("Reason Saved");
                                    window.location.href = 'reason_transactions.php';
                                    
                                } else {
                                    // alert("Task not Saved");
                                    swal("Reason not Saved");

                                }
                            });
                        }
                    });
      //close save route       

          

            
  //update reasons
  $('#reasons').on('click', 'button', function () {
        var data = $('#reasons').DataTable().row($(this).closest('tr')).data();
        var code = data.code;

        var savedName = data.name;

        //alert(savedName+' - '+savedAddress+' - '+savedMobile)

        var lblname = 'Name - '+savedName;

        $("#lblName").text(lblname);
        $("#update_reason").click(function () {
                var edtname = document.getElementById("editName").value;
                var edtAdrs = '';
                var edtMob = '1234567895';
                var txntype = 'reason';
               // alert(edtname+'-'+edtAdrs+' mm '+edtMob);

                    if (edtname == "") {
                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation
                    }else{
                              $.post("update.php", {
                                code: code,
                                addrs: edtAdrs,
                                mobil: edtMob,
                                name: edtname,
                                txn: txntype
                            }, function (data) {
                                if (data == 200) {
                                    swal("Reason Updated");
                                    window.location.href = 'reason_transactions.php';
                                } else if(data == 400){
                                    swal("Reason not Updated");
                                }else{
                                    swal("Invalid reason");
                                }
                            });
                           
                        }
                    });
                    
    });//close update click function
           
        
     //remove reasons
     $('#reasons').on('click', 'a', function () {
        var data = $('#reasons').DataTable().row($(this).closest('tr')).data();
        var code = data.code;
        var type = 'reasontxn';
        var r = confirm("Are you sure to remove this reason?");
        if (r == true) {
            $.post("remove.php", {
                KeyCode: code,
                txn: type
            }, function (data) {
                if (data == 200) {
                    alert("Reason removed");
                    window.location.href = 'reason_transactions.php';
                } else {
                    alert("Deleting Reason Failed!");
                }
            });
        }
    });//close remove click function

    
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
                            <a href="#newReason" role="button" id="btnFilter" data-target="#newReason"  data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Reason</a>
                        </li>
                    </ul>
            </div><!-- nav-collapse -->
        </div>

      
        <!--title -->
<!-- update  modal start-->
<div class="modal fade" id="updateModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Update Route</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">
                                                    <label id="lblName" for="inputPassword3" >Name</label>
                                                    <input  placeholder="" type="text" class="form-control" id="editName"  />
                                                </div>
                                            </div>
                                        </div>
                                       
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="update_reason" class="btn btn-default" data-dismiss="modal">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- update  modal end-->
<!--------------------------------Create Reason------------------------------------------------>
<div class="modal fade" id="newReason" tabindex="-1" role="dialog" aria-labelledby="newReason" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Reason</h5>
                                    </div>
                                    <div class="modal-body">
                                 <div class="row">
                                          
                                             <div class="col col-md-6">
                                               <div class="form-group">

                                                    <label 
                                                        for="inputPassword3" >Select Type</label>
                                                    <select id="reason_type" class="form-control" > 
                                                        <option value="0"> --SELECT-- </option>
                                                        <option value="Exp"> Expense</option>
                                                        <option value="Np"> Nonproductive</option>
                                                         

                                                    </select>
                                                </div>
                                            </div>
                                             
                                             <div class="col col-md-6">
                                               <div class="form-group">

                                                    <label for="inputPassword3" >Reason Code</label>
                                                    <input type="text" class="form-control" id="reason_code" />
                                                </div>
                                            </div>
                                         </div>
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Reason Name</label>
                                                    <input type="text" class="form-control" id="reason_name" />
                           

                                                </div>
                                            </div>
                                        </div>
                                       

                                    </div>

                                    <div class="modal-footer">
                                        <div class="span pull-left">
                                            <div class="alert alert-danger fade">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <strong id="error">Error!</strong> Please fill all fields.
                                            </div>
                                        </div>
                                        <button class="btn btn-info"  data-dismiss="modal" aria-hidden="true">Cancel</button>
                                        <button id="saveReason" type="button" value="Savereason" class="btn btn-primary">Save</button>
                                    </div>
                                </div>   
                            </div>
                        </div>
 <!-- end create Reason------------------------------------------------------------------------------------------------------------------>
         
    <div class="container">
    <div class="table-responsive">
       <table id="reasons" class="table table-striped table-bordered table-hover" style="width:100%">
          <thead>
            <tr>
                <th></th>
                <th>Code</th>
                <th>Type</th>
                <th>Name</th>
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
