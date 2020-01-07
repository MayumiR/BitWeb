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
        <title>User transactions</title>
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
                var table = $('#users').DataTable();
                    table.destroy();
                      $('#users').DataTable({
                        "ajax": "getUsers.php",
                        "columns": [
                        {
                        "className":      'details-control',
                         "orderable":      false,
                         "data":           null,
                         "defaultContent": ''
                        },
                        { "data": "Code" },
                        { "data": "Name" },
                        { "data": "UserName" },
                        { "data": "Mobile" },
                        { "data": "Address" },
                        {"mRender": function (data, type, row) {
                             return "<button class='btn btn-primary btn-xs' href='#updateModal'  data-toggle='modal' data-target='#updateModal' ><span class='glyphicon  glyphicon-pencil' aria-hidden='true'> </span></button>    <a href='#' id='remove' role='button' class='btn btn-danger btn-xs'><span class='glyphicon  glyphicon-remove' aria-hidden='true'> </span></a> <label class='btn btn-primary btn-xs' href='#macModal'  data-toggle='modal' data-target='#macModal' ><span class='glyphicon  glyphicon-cog' aria-hidden='true'> Assign Mac</span></label> ";      
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

                $("#btnSaveUser").click(function () {
                    var RepName = document.getElementById("rep_name").value;
                    var RepAddress = document.getElementById("rep_address").value;
                    var RepPwd = document.getElementById("rep_pwd").value;
                    var RepCpwd = document.getElementById("rep_cpwd").value;
                    var RepMobile = document.getElementById("rep_mobile").value;
                    var RepPrefix = document.getElementById("prefix").value;
                    var RepUName = document.getElementById("rep_uname").value;
                    var code = RepPrefix+RepMobile;
                    if (RepMobile == "" || RepUName == "" || RepAddress == "" || RepPwd == "" || RepMobile == "" || RepPrefix == "") {
                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation
                    }else{
                        if (RepPwd.trim() === RepCpwd.trim()) {
                            if(RepPrefix.length == 2){
                              $.post("saveUser.php", {
                                name: RepName,
                                address: RepAddress,
                                pwd: RepPwd,
                                mobile: RepMobile,
                                prefix: RepPrefix,
                                uname: RepUName,
                                code: code
                            }, function (data) {
                                if (data == 200) {
                                    swal("User Saved");
                                    window.location.href = 'user_transactions.php';
                                    //$('#newUser').hide();
                                    // setTimeout(function(){// wait for 5 secs(2)
                                    //     window.location.reload(); // then reload the page.(3)
                                    // }, 5000);
                                   // window.location.reload();
                                    //$('#newUser').modal('hide');
                                } else if(data == 400){
                                    swal("User not Saved");
                                }else{
                                    swal("Invalid mobile number");
                                }
                            });
                            }else{
                                swal("Prefix length should be 2");
                            }
                    }else {
                        swal("Password didn't match with confirm password");
                    }
                }
            });
          
        //assign mac address start table row click

           
        
        $('#users').on('click', 'label', function () {

            var data = $('#users').DataTable().row($(this).closest('tr')).data();

            var code = data.Code;
            //alert("mac"+code);

            $("#assign_mac").click(function () {
                    var macaddrs = document.getElementById("mac_address").value;

                    var regexp = /^(([A-Fa-f0-9]{2}[:]){5}[A-Fa-f0-9]{2}[,]?)+$/i;

                    if (macaddrs == "") {
                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation
                    }else{
                   //alert(macaddrs);
                            if(regexp.test(macaddrs)){
                                macaddrs = macaddrs.replace(/:/g,'');
                                //alert(macaddrs +" - "+code);
                              $.post("assignMacAddress.php", {
                                code: code,
                                mac: macaddrs
                            }, function (data) {
                                if (data == 200) {
                                    swal("User Saved");
                                    window.location.href = 'user_transactions.php';
                                    //$('#newUser').hide();
                                    // setTimeout(function(){// wait for 5 secs(2)
                                    //     window.location.reload(); // then reload the page.(3)
                                    // }, 5000);
                                   // window.location.reload();
                                    //$('#newUser').modal('hide');
                                } else if(data == 400){
                                    swal("User not Saved");
                                }else{
                                    swal("Invalid user");
                                }
                            });
                            }else{
                                swal("Invalid Mac Address");
                            }
                        }
                    });
                    
           
                    //end assign mac address button click

            });

            
  //update user
  $('#users').on('click', 'button', function () {
        var data = $('#users').DataTable().row($(this).closest('tr')).data();
        var code = data.Code;

        var savedName = data.Name;
        var savedAddress = data.Address;
        var savedMobile = data.Mobile;

        alert(savedName+' - '+savedAddress+' - '+savedMobile)

        var lblname = 'Name - '+savedName;
        var lbladdess = 'Address - '+savedAddress;
        var lblmobile = 'Mobile - '+savedMobile;

        $("#lblName").text(lblname);
        $("#lblAddress").text(lbladdess);
        $("#lblMob").text(lblmobile);
        $("#update_user").click(function () {
                var edtname = document.getElementById("editName").value;
                var edtAdrs = document.getElementById("editAddress").value;
                var edtMob = document.getElementById("editMobile").value;
                var txntype = 'user';
                //alert(edtname+'-'+edtAdrs+' mm '+edtMob);

                    if (edtname == "" || edtAdrs == "" || edtMob == "") {
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
                                    swal("User Updated");
                                    window.location.href = 'user_transactions.php';
                                } else if(data == 400){
                                    swal("User not Updated");
                                }else{
                                    swal("Invalid mobile number");
                                }
                            });
                           
                        }
                    });
                    
    });//close update click function
           
        
     //remove user
     $('#users').on('click', 'a', function () {
        var data = $('#users').DataTable().row($(this).closest('tr')).data();
        var code = data.Code;
        var type = 'usertxn';
        var r = confirm("Are you sure to remove this user?");
        if (r == true) {
            $.post("remove.php", {
                KeyCode: code,
                txn: type
            }, function (data) {
                if (data == 200) {
                    alert("User removed");
                    window.location.href = 'user_transactions.php';
                } else {
                    alert("Deleting User Failed!");
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
                            <a href="#newUser" role="button" id="btnFilter" data-target="#newUser"  data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add User</a>
                        </li>
                    </ul>
            </div><!-- nav-collapse -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="dailyRpt" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Route wise sales report</h4>
                    </div>
                    <div class="modal-body">
                         <div class="form-group">
                                <label for="inputPassword3" >Select Route</label>
                                <select id="code" class="form-control" >
                                    <option value="0"> --SELECT-- </option>
                                        <?php foreach ($getRoutes as $returnrow): ?>
                                        <option value="<?= $returnrow['code'] ?>"> <?php echo $returnrow['code'].' - '.$returnrow["name"]; ?> </option>
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
<!-- assign mac modal start-->
<div class="modal fade" id="macModal" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Assign Mac Address</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">

                                        <label id="mac" for="inputPassword3" ></label>
                                        <input  placeholder="Enter Mac Address" type="text" class="form-control" id="mac_address"  />

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="assign_mac" class="btn btn-default" data-dismiss="modal">Assign</button>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- assign mac  modal end-->
<!-- update  modal start-->
<div class="modal fade" id="updateModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Update User</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">
                                                    <!-- <label for="inputName" >Name</label>
                                                    <input type="text" class="form-control" id="rep_name" /> -->
                                                    <label id="lblName" for="inputPassword3" >Name</label>
                                                    <input  placeholder="" type="text" class="form-control" id="editName"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">
                                                    <label id="lblMob" for="inputPassword3" >Mobile</label>
                                                    <input  placeholder="" type="text" class="form-control" id="editMobile"  />
                                            </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">
                                                    <label id="lblAddress" for="inputPassword3" >Address</label>
                                                    <input  placeholder="" type="text" class="form-control" id="editAddress"  />
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="update_user" class="btn btn-default" data-dismiss="modal">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- update  modal end-->
<!--------------------------------Create new User------------------------------------------------>
<div class="modal fade" data-backdrop="static" id="newUser" tabindex="-1" role="dialog" aria-labelledby="newUser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                                        <!-- <button style= ""aria-hidden="true" onclick="close_dialog(this);" class="close" type="button">×</button>
                                         -->
                                    </div>
                                    <div class="modal-body" id="body_content">

                                        <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">
                                                    <label for="inputName" >Name</label>
                                                    <input type="text" class="form-control" id="rep_name" />
                                                </div>
                                            </div>
                                        </div>

                                         <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">
                                                    <label for="inputAddress" >Address</label>
                                                   <input type="text" class="form-control"  name="comment" id="rep_address"  />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col col-md-4">
                                                 <div class="form-group">
                                                    <label for="inputUsername" >User name</label>
                                                    <input type="text"  class="form-control"  name="comment" id="rep_uname"  />
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="inputPassword" >Password</label>
                                                    <input type="password"  class="form-control"  name="comment" id="rep_pwd"  />
                                                </div>
                                            </div>
                                            <div class="col-4 col-md-4">
                                               <div class="form-group">
                                                    <label for="inputCPassword" >Confirm Password</label>
                                                  <input type="password"  class="form-control"  name="comment" id="rep_cpwd"  />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="inputMobile" >Mobile</label>
                                                    <input type="number" class="form-control" id="rep_mobile" />
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="inputPrefix" >Prefix</label>
                                                    <input type="text" class="form-control" id="prefix" />
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
                                                <button id="btnSaveUser" type="button" value="btnSaveUser" class="btn btn-primary">Save</button>
                                        </div>

                                    </div>
                                </div>   
                            </div>
                        </div>
<!-- end create user------------------------------------------------------------------------------------------------------------------>

    <div class="container">
    <div class="table-responsive">
       <table id="users" class="table table-striped table-bordered table-hover" style="width:100%">
          <thead>
            <tr>
                <th></th>
                <th>RepCode</th>
                <th>RepName</th>
                <th>Rep Username</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Actions (edit | delete | assign mac id)</th>
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
