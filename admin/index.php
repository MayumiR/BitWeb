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

        <!-- Bootstrap Core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
        <link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">

        <script type="text/javascript">
            
             $(document).ready(function () {
                 
                 //main order table
                var table = $('#orders').DataTable( {
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

                        return "<button class='btn btn-primary btn-xs' href='#usertxn'  data-toggle='modal' data-target='#usertxn' ><span class='glyphicon  glyphicon-eye-open' aria-hidden='true'></span></button>";
                                  
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

        var table = $('#detailtable').DataTable( {
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
            { "data": "TotAmt" }
        
        ],
        "order": [[1, 'asc']]
    } );
    
// FOR ADMIN -------------------------------------------------------------------
// if (userCode == '002') {
//     var r = confirm("Are you sure to remove this Task?");
//     if (r == true) {

//         $.post("removeTask.php", {
//             jobno: job_no,
//             taskId: task_no
//         }, function (data) {

//             if (data == 200) {
//                 alert("Task removed");
//                 window.location.href = 'home.php';
//             } else {
//                 alert("Deleting Task Failed!");
//             }

//         });
//     }
// } else if (ACT_HRS == null && type == '1' && userName == all_to) { // for normal user--------------
//     var r = confirm("Are you sure to remove this Task?");
//     if (r == true) {

//         $.post("removeTask.php", {
//             jobno: job_no,
//             taskId: task_no
//         }, function (data) {



//             if (data == 200) {
//                 alert("Task removed");
//                 window.location.href = 'home.php';
//             } else {
//                 alert("Deleting Task Failed!");
//             }

//         });

//     }
// } else if (type == '3' && ACT_HRS == null) {//-----for PM
//     var r = confirm("Are you sure to remove this Task?");
//     if (r == true) {

//         $.post("removeTask.php", {
//             jobno: job_no,
//             taskId: task_no
//         }, function (data) {



//             if (data == 200) {
//                 alert("Task removed");
//                 window.location.href = 'home.php';
//             } else {
//                 alert("Deleting Task Failed!");
//             }

//         });
//     }
// } else if (All_By == userName && ACT_HRS == null) {
//     var r = confirm("Are you sure to remove this Task?");
//     if (r == true) {

//         $.post("removeTask.php", {
//             jobno: job_no,
//             taskId: task_no
//         }, function (data) {



//             if (data == 200) {
//                 alert("Task removed");
//                 window.location.href = 'home.php';
//             } else {
//                 alert("Deleting Task Failed!");
//             }

//         });
//     }
// } else {
//     alert("You are not Athorized to Remove this Task!");
// }
});


               $(".userSave").click(function () {

                   
                     $('#newUser').modal('show');
                 
                });
              $(".routes").click(function () {

                   
                        $('#newRt').modal('show');
                 
                });
                  $(".reason").click(function () {

                   
                        $('#newReason').modal('show');
                 
                });
                $(".userid").click(function () {

                   
                $('#usertxn').modal('show');

                });
                
                 $(".repRoute").click(function () {

                   
                        $('#repRoute').modal('show');
                 
                });
                $(".item").click(function () {

                   
                        $('#newItm').modal('show');
                 
                });
                $(".price").click(function () {

                   
                        $('#modifyPrice').modal('show');
                 
                });
                //save User------------------------------------------------------------------
                $("#btnSaveUser").click(function () {
                    var RepName = document.getElementById("rep_name").value;
                    var RepAddress = document.getElementById("rep_address").value;
                    var RepPwd = document.getElementById("rep_pwd").value;
                    var RepCpwd = document.getElementById("rep_cpwd").value;
                    var RepMobile = document.getElementById("rep_mobile").value;
                    var RepPrefix = document.getElementById("prefix").value;
                     var RepUName = document.getElementById("rep_uname").value;
                    
                    var code = RepPrefix+RepMobile;
                
                   //alert(RepName+"-"+RepAddress+"-"+RepPwd+"-"+RepMobile+"-"+RepPrefix);

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
                               // alert(data);
                                if (data == 200) {
                                    //    alert("Task Saved");
                                    swal("User Saved");
                                   // window.location.href = 'admin/index.php';
                                    $('#newUser').modal('hide');
                                     window.location.href = 'index.php';
                                } else if(data == 400){
                                    // alert("Task not Saved");
                                    swal("User not Saved");

                                }else{
                                   // alert(data);
                                    
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
// save item
                $("#saveItem").click(function () {
                    var ItemCode = document.getElementById("item_code").value;
                    var ItemName = document.getElementById("item_name").value;
                    var Uom = document.getElementById("uom").value;
                   //alert(RepName+"-"+RepAddress+"-"+RepPwd+"-"+RepMobile+"-"+RepPrefix);

                    if (ItemCode == "" || ItemName == "") {
                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation
                    }else{
              
                              $.post("saveItem.php", {

                                code: ItemCode,
                                name: ItemName,
                                uom: Uom

                            }, function (data) {
                                //alert(data);
                                if (data == 200) {
                                   
                                    swal("Item Saved");
                                    window.location.href = 'index.php';
                                    

                                } else {
                                  
                                    swal("Item not Saved or already exist");

                                }

                            });
                        }
                     });
     //end save item
     //// price allocate
                    $("#savePrice").click(function () {
                    var ItemCode = document.getElementById("itm_code").value;
                    var price = document.getElementById("al_price").value;
                   
                   //alert(RepName+"-"+RepAddress+"-"+RepPwd+"-"+RepMobile+"-"+RepPrefix);

                    if (ItemCode == "" || price == "") {
                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation
                    }else{
              
                              $.post("savePrice.php", {

                                code: ItemCode,
                                price: price

                            }, function (data) {
                                //alert(data);
                                if (data == 200) {
                                   
                                    swal("Price Allocated");
                                    window.location.href = 'index.php';
                                    

                                } else {
                                  
                                    swal("Price not allocated");

                                }

                            });   
                        }
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
               
//save route......

                   $("#saveRoute").click(function () {
                    var RouteCode = document.getElementById("route_code").value;
                    var RouteName = document.getElementById("route_name").value;
                   
                   //alert(RepName+"-"+RepAddress+"-"+RepPwd+"-"+RepMobile+"-"+RepPrefix);

                    if (RouteCode == "" || RouteName == "") {
                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation
                    }else{
              
                              $.post("saveRoute.php", {

                                name: RouteName,
                                code: RouteCode

                            }, function (data) {
                                //alert(data);
                                if (data == 200) {
                                    //    alert("Task Saved");
                                    //$('#newRt').modal('hide');
                                    swal("Route Saved");
                                    window.location.href = 'index.php';
                                    

                                } else {
                                    // alert("Task not Saved");
                                    swal("Route not Saved");

                                }

                            });
                        }
                    });
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
                                    window.location.href = 'index.php';
                                    
                                } else {
                                    // alert("Task not Saved");
                                    swal("Reason not Saved");

                                }
                            });
                        }
                    });
      //close save route       
//save customer......

                   $("#saveCus").click(function () {
                    var address = document.getElementById("cus_address").value;
                    var Name = document.getElementById("cus_name").value;
                    var route = document.getElementById("cus_route").value;
                    var mobile = document.getElementById("cus_mobile").value;
                    var email = document.getElementById("cus_email").value;
                   
                
                   //alert(RepName+"-"+RepAddress+"-"+RepPwd+"-"+RepMobile+"-"+RepPrefix);

                    if (mobile == "" || Name == "" || route == " --SELECT-- ") {
                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation
                    }else{
              
                              $.post("saveCustomer.php", {

                                name: Name,
                                address: address,
                                route: route,
                                mobile: mobile,
                                email: email

                            }, function (data) {
                               // alert(data);
                                if (data == 200) {
                                    //    alert("Task Saved");
                                    //$('#newRt').modal('hide');
                                    swal("Customer Saved");
                                    window.location.href = 'index.php';
                                    

                                } else if(data == 400){
                                    // alert("Task not Saved");
                                    swal("Customer not Saved");

                                }else if(data == 300){
                                    swal("Invalid email");
                                
                                }else{
                                   // alert(data);
                                    
                                    swal("Invalid mobile number");
                                
                                }
                            });    
                        }
                    });

        //edit button click event

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
                                    <!-- <li class="dropdown">
                                        <a href="#" id="filterUserRcd" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> User <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="" role="button" id="userSave" data-target=""  data-toggle="modal" onclick="hideContent(this)"><span class="glyphicon glyphicon-plus"></span> Add User</a>
                                            </li>
                                            <li>
                                                <a href="#updateUser" role="button" id="updateUser" ><span class="glyphicon glyphicon-edit"></span> Edit User</a>
                                            </li>
                                            <li>
                                             <a href="#assignMac" role="button" id="assignMac" ><span class="glyphicon glyphicon-ok"></span> Assign Mac Address</a>
                                            </li>
                                           <li>
                                            <a href="#deleteUser"  role="button" id="deleteUser" ><span class="glyphicon glyphicon-remove"></span> Delete User</a>
                                           </li>   
                                        </ul>
                                    </li> -->
                                    <li>
                                        <a href="user_transactions.php" role="button" id="usernew" <span class="glyphicon glyphicon-plus"></span> User Transactions</a>
                                    </li>
                                   
                                    <li class="dropdown">
                                        <a href="#" id="filterCusRcd" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Customer <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#newCus" role="button" id="cus" data-target="#newCus"  data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Customer</a>
                                            </li>
                                            <li>
                                                <a href="#updateCus" role="button" id="updateCus" ><span class="glyphicon glyphicon-edit"></span> Edit Customer</a>
                                            </li>
                                            <li>
                                                <a href="#deleteCus"  role="button" id="deleteCus" ><span class="glyphicon glyphicon-remove"></span> Delete Customer</a>
                                            </li>    
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" id="filterRtRcd" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Route <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#newRt" role="button" id="routes" data-target="#newRt"  data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Route</a>  
                                            </li>
                                            <li>
                                                <a href="#repRoute" role="button" id="rep_route" data-target="#assignRt"  data-toggle="modal"><span class="glyphicon glyphicon-ok"></span> Assign Route</a>
                                            </li>
                                            <li>
                                                <a href="#deleteRt"  role="button" id="deleteRt" ><span class="glyphicon glyphicon-remove"></span> Delete Route</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" id="filterItemRcd" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Item <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                           <li>
                                                <a href="#newItem" role="button" id="item" data-target="#newItm"  data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Item</a>
                                           </li>
                                            <li>
                                                <a href="#updatePrice" role="button" id="price" data-target="#modifyPrice"  data-toggle="modal"><span class="glyphicon glyphicon-ok"></span>  Price Allocate</a>
                                            </li>
                                            <li>
                                                <a href="#deletePrice"  role="button" id="deletePrice" ><span class="glyphicon glyphicon-remove"></span> Delete Price</a>
                                            </li>   
                                        </ul>
                                    </li>
                                    
                                    <li>
                                        <a href="#reason" role="button" id="reason" data-target="#newReason"  data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Reason</a>
                                    </li>
                                     <li>
                                        <a href="#usertxn" role="button" id="userid" data-target="#usertxn"  data-toggle="modal"><span class="glyphicon glyphicon-user"></span>USER</a>
                                    </li>    
                                    <li>
                                        <a href="user_transactions.php" role="button" id="usernew" data-target="#usertxn"  data-toggle="modal"><span class="glyphicon glyphicon-user"></span>USER</a>
                                    </li>                           
                                    <!-- <li>
                                        <a href="user_transactions.php" role="button" id="userid" data-target="#usertxn"  data-toggle="modal"><span class="glyphicon glyphicon-user"></span>USER</a>
                                    </li>     -->
                                
                                    <li class="dropdown">
                                        <a href="#" id="filterRcd" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Reports <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="dailyReport.php" role="button" id="daily" ><span class="glyphicon glyphicon-leaf"></span> Today</a>
                                            </li>
                                            <li>
                                                <a href="dateWiseReport.php" role="button" id="dateWise" ><span class="glyphicon glyphicon-calendar"></span> Date Wise</a>
                                            </li>
                                           <li>
                                                <a href="customerReport.php" role="button" id="customers" ><span class="glyphicon glyphicon-calendar"></span> Customer Wise</a>
                                            </li>
                                            <li>
                                                <a href="routewise.php"  role="button" id="route" ><span class="glyphicon glyphicon-calendar"></span> Route Wise</a>
                                            </li>   
                                        </ul>
                                    </li>

                                </ul>



                                <ul class="nav navbar-nav navbar-right">

                                    <li><a href="../logout.php" onclick="return confirm('Are you sure to logout?');"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["user_name"] ?>   <span class="glyphicon glyphicon-log-out"></span>    Logout</a></li>
                                </ul>

                            </div><!--/.nav-collapse -->
                        </div>

<!--------------------------------Create new User------------------------------------------------>
                        <div class="modal fade" data-backdrop="static" id="newUser" tabindex="-1" role="dialog" aria-labelledby="newUser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">User</h5>
                                        <button style= ""aria-hidden="true" onclick="close_dialog(this);" class="close" type="button">×</button>
                                        <button id="btnAddUsr" type="button" value="btnAddUsr" class="btn btn-primary" onclick="showContent(this)">Add User</button>
         
                                    </div>
                                    <div class="modal-body" id="body_content">

                                        <div class = "row" id = "usr_contnt">

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

                                    <div class="modal-footer">
                                       <div class = "row" id = "base_table">
                                       <table id = "user_table" boder="1px">

                                       </table>
                                       </div>
                                    </div>
                                </div>   
                            </div>
                        </div>
<!-- end create user------------------------------------------------------------------------------------------------------------------>
 
<!--------------------------------Create customer------------------------------------------------>
<div class="modal fade" id="newCus" tabindex="-1" role="dialog" aria-labelledby="newCus" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>


                                    </div>
                                    <div class="modal-body">

                               
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Name</label>
                                                    <input type="text" class="form-control" id="cus_name" />
                           

                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Address</label>

                                                   <input type="text" class="form-control"  name="comment" id="cus_address"  />

                                                </div>
                                            </div>
                                             
                                        </div>

                                        <div class="row">

                                            <div class="col col-md-6">
                                                <div class="form-group">
                                                    <label 
                                                        for="inputPassword3" >Route</label>
                                                <select id="cus_route" class="form-control"  > 
                                                        <option value=""> --SELECT-- </option>    
                                                        <?php foreach ($getRoutes as $returnrow): ?>            

                                                            <option value="<?= $returnrow['code'] ?>" > <?php echo $returnrow["name"]; ?> </option>

                                                        <?php endforeach; ?>

                                                    </select>   
                                           
                                                </div>
                                            </div>
                                            <div class="col col-md-6">

                                                <div class="form-group">

                                                    <label for="inputPassword3" >Mobile</label>

                                                  <input type="number"  class="form-control"  name="comment" id="cus_mobile"  />

                                                </div>

                                            </div>
                                            
                                        </div>
                                       <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Email</label>

                                                    <input type="email" class="form-control"  name="comment" id="cus_email"  />

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
                                        <button id="saveCus" type="button" value="SaveCus" class="btn btn-primary">Save</button>
                                    </div>
                                </div>   
                            </div>
                        </div>
 <!-- end create user------------------------------------------------------------------------------------------------------------------>
         <!--------------------------------Create Route------------------------------------------------>
<div class="modal fade" id="newRt" tabindex="-1" role="dialog" aria-labelledby="newRt" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Route</h5>


                                    </div>
                                    <div class="modal-body">

                                         <div class="row">
                                            <div class="col col-md-6">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Route Code</label>

                                                   <input type="text" class="form-control"  name="comment" id="route_code"  />

                                                </div>
                                            </div>
                                             <div class="col col-md-6">
                                               <div class="form-group">

                                                    <label for="inputPassword3" >Route Name</label>
                                                    <input type="text" class="form-control" id="route_name" />
                           

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
                                        <button id="saveRoute" type="button" value="saveRoute" class="btn btn-primary">Save</button>
                                    </div>
                                </div>   
                            </div>
                        </div>
 <!-- end create Route------------------------------------------------------------------------------------------------------------------>
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
                                                <button type="button" class="close" data-dismiss="alert">Ã—</button>
                                                <strong id="error">Alert!</strong> Please fill all fields.
                                            </div>
                                        </div>
                                        <button class="btn btn-info"  data-dismiss="modal" aria-hidden="true">Cancel</button>
                                        <button id="saveReason" type="button" value="Savereason" class="btn btn-primary">Save</button>
                                    </div>
                                </div>   
                            </div>
                        </div>
 <!-- end create Reason------------------------------------------------------------------------------------------------------------------>
                             <!--------------------------------user transactions------------------------------------------------>
<div class="modal fade" id="usertxn" tabindex="-1" role="dialog" aria-labelledby="usertxn" aria-hidden="true">
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
                <th>RefNo</th>
                <th>Customer</th>
                <th>Route</th>
                <th>Date</th>
                <th>Total Amount</th>
            
          </tr>
    </thead>	         	
     
  </table>


                                    </div><!-- close modal-body-->

                                   
                                </div>   
                            </div>
                        </div>
 <!-- end user------------------------------------------------------------------------------------------------------------------>
                
                         
                         <!--------------------------------Add item------------------------------------------------>
<div class="modal fade" id="newItm" tabindex="-1" role="dialog" aria-labelledby="newItm" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Item</h5>


                                    </div>
                                    <div class="modal-body">

                                         <div class="row">
                                            <div class="col col-md-6">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Item Code</label>

                                                   <input type="text" class="form-control"  name="comment" id="item_code"  />

                                                </div>
                                            </div>
                                             <div class="col col-md-6">
                                               <div class="form-group">

                                                    <label for="inputPassword3" >Unit of measure</label>
                                                    <input type="text" class="form-control" id="uom" />
                           

                                                </div>
                                            </div>
                                         </div>
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Item Name</label>

                                                   <input type="text" class="form-control"  name="comment" id="item_name"  />

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
                                        <button id="saveItem" type="button" value="saveRoute" class="btn btn-primary">Save</button>
                                    </div>
                                </div>   
                            </div>
                        </div>    
                    </div>

              <!-- end add item-->
               <!-- update price-->
              <div class="modal fade" id="modifyPrice" tabindex="-1" role="dialog" aria-labelledby="modifyPrice" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Price allocate</h5>


                                    </div>
                                    <div class="modal-body">

                                         <div class="row">
                                           <div class="col col-md-6">
                                               <div class="form-group">

                                                    <label 
                                                        for="inputPassword3" >Select Item</label>
                                                    
                                                    <select id="itm_code" class="form-control" > 
                                                        <option value="0"> --SELECT-- </option>    
                                                        <?php foreach ($getItems as $returnrow): ?>            

                                                            <option value="<?= $returnrow['code'] ?>" > <?php echo $returnrow['code'].' - '.$returnrow["name"]; ?> </option>

                                                        <?php endforeach; ?>
                                                    
                                                         

                                                    </select>
                                                </div>
                                            </div>
                                             <div class="col col-md-6">
                                               <div class="form-group">

                                                   <div class="form-group">

                                                    <label for="inputPassword3" >Price</label>
                                                    <input type="number" class="form-control" id="al_price" />
                           

                                                </div>

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
                                        <button id="savePrice" type="button" value="saveRoute" class="btn btn-primary">Save</button>
                                    </div>
                                </div>   
                            </div>
                        </div>
 <!-- end price update------------------------------------------------------------------------------------------------------------------>

 
                   
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
<!--        <tfoot>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Salary</th>
            </tr>
        </tfoot>-->
    </table>
<!--                <table width="100%" class="table table-striped table-bordered table-hover" id="orderTbl">
                    <thead>
                        <tr>
                            <th>RefNo</th>
                            <th>Customer</th>
                             <th>Total Amount</th>
                              <th>Date</th>
                            <th>Sales Representative</th>
                           
                            <th>Route</th>
                           
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="7" style="text-align:right">Total Sale:</th>
                            <th></th>
                        </tr>
                    </tfoot>


                </table>-->
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
