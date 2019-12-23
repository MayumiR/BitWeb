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
          <!-- Bootstrap Core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!--        <link href="../vendor/bootstrap/css/bootstrap.min.css.map" rel="stylesheet" type="text/css"/>-->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
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
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        

        <script type="text/javascript">
            
               function format ( d ) {
    // `d` is the original data object for the row
  // window.location.href = 'dailyReport.php';

     return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Customer:</td>'+
            '<td>'+d.CusName+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Route:</td>'+
            
            '<td>'+d.RouteName+'</td>'+
        '</tr>'+
        '<tr>'+
            ' <td><button id="'+d.RefNo+'" name="testbtn" onclick = "test(this.id)">view details</button></td>'+
        '</tr>'+
    '</table>';
    
}


function alert_open(link){
   
artWindow=window.open(link,"ara14",'toolbar=0,location=0,directories=0,status=0,menubar=1,scrollbars=yes,resize=yes,width=700,height=350,left=40,top=40');
 }
function test(obj){
    //alert(123);
 
    alert_open('/SFA/admin/order_detail.php?refno='+obj);
     //alert_open('/SFA/admin/viewOrder.php?refno='+obj);

    
//return "<table cellpadding=\"5\" cellspacing=\"0\" border=\"0\" style=\"padding-left:50px;\">"+
//          <?php
            /*$getRoutes = dataFunctions::getRoutes($connection);
            if(count($getRoutes) > 0)
                 foreach($getRoutes as $returnrow):*/ ?>// 
//            
//            
//               "<tr><td>"+<?php //echo "123" ;//; ?>+"</td><td>"+<?php //echo "456";//$returnrow->name; ?>+"</td></tr>"+
//                   <?php //endforeach; ?>"</table>";
   //$('#newUser').modal('show');
    //$('#newUser').modal('show');
}

             $(document).ready(function () {
                 
//                   $(function(){
//    $('button[name=testbtn]').click(function(){
//        console.log(llll);
//        var id= $(this).attr("id");
//        //some action here
//        //
//        alert(id);
//        //ex:
//        window.location.href="index.php";
//        //or an ajax fungtion
//    });
//});

  
//   $("#btnAddUsr").click(function () {
//      // alert(123);
//     document.getElementById("usr_contnt").style.visibility = "visible";
//    // $('#newUser').modal('show');

// });

               $(".userSave").click(function () {

                   
                        // $('#newUser').modal('show');
                 
                });
              $(".routes").click(function () {

                   
                        $('#newRt').modal('show');
                 
                });
                  $(".reason").click(function () {

                   
                        $('#newReason').modal('show');
                 
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
            { "data": "CusCode" },
            { "data": "RouteCode" },
            { "data": "TxnDate" },
            { "data": "TotAmt" },
//            {"mRender": function (data, type, row) {
//
//                                    return "<button class='btn btn-primary btn-xs' href='#'  data-toggle='modal' data-target='#' ><span class='glyphicon  glyphicon-pencil' aria-hidden='true'></button>  <a href='#' id='remove' role='button' class='btn btn-danger btn-xs'><span class='glyphicon  glyphicon-remove' aria-hidden='true'></span></a>"
//
//                                }
//                            }
        ],
        "order": [[1, 'asc']]
    } );
     
    // Add event listener for opening and closing details
    $('#orders tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );


//edit button click event

// $("#edit").click(function ()
// {
//     alert(1234);
// });

//alert(1234);

$(document).on('click', '.edit', function()
{
    alert(1234);
});

                });// doc.ready function close

                function hideContent()
                {
                    document.getElementById('usr_contnt').style.visibility = 'hidden';
                    $('#newUser').modal('show');
                   // $("#user_table").destroy();
                  
                    var users = <?php echo json_encode($getUsers) ?>;
                    var table = document.getElementById('user_table');
                   table.innerHTML = "";
                    var row1 = document.createElement("TR");
                    var col1 = document.createElement("TH");
                    col1.innerHTML = "CODE";
                    var col2 = document.createElement("TH");
                    col2.innerHTML = "NAME";
                    var col3 = document.createElement("TH");
                    col3.innerHTML = "EDIT";
                    row1.appendChild(col1);
                    row1.appendChild(col2);
                    row1.appendChild(col3);
                    table.appendChild(row1);
                   
                    for(var i= 0; i< users.length; i++)
                    {
                        var row2 = document.createElement("TR");
                        var col21 = document.createElement("TD");
                        col21.innerHTML = users[i].code;
                        var col22 = document.createElement("TD");
                        col22.innerHTML = users[i].name;
                        
                        //var button = '<button type="button" name="update" id="update" class="btn pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn btn-primary btn-sm update"><i class="material-icons md-dark pmd-sm">edit</i></button>';
                       var button = document.createElement('input');
                       button.setAttribute('type','button');
                       button.setAttribute("id","edit");
                       button.setAttribute("name","edit");
                    //    button.setAttribute('class','material-icons md-dark pmd-sm');
                    //    button.setAttribute("style","background-image: {images/icon_minus.png};");
                    //    button.setAttribute('style.backgound','images/icon_minus.png');
                    //    button.innerHTML('images/icon_minus.png');
                        row2.appendChild(col21);
                        row2.appendChild(col22); 
                        row2.appendChild(button); 
                        table.appendChild(row2);

                                       
                        
                    }


                }

                function showContent(){
                  document.getElementById('usr_contnt').style.visibility = "visible";
                }

                function close_dialog(){
                    alert(123);
                 $('#newUser').modal('hide');
                }
                
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
                width: 100%;
                padding: 5px;

            }

            #edit
           {
               background-image: url('../images/icon_minus.png');
               width:10px;
               height:10px;
           }
            
   td.details-control {
    background: url('../images/text-plus-icon.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('../images/Math-minus-icon.png') no-repeat center center;
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
            /*tr,th{
                            padding: 1px;
                            color: #000;
                            width: 10px;
                            background: #afd9ee;
                            border: 1px solid #000000;
                            border-bottom-width: 1px;
                            font-size: 12px;
            
                        }*/
            dataTables-tr{

                height: 15px;
            }
            .dataTables_wrapper {
                position: relative;
                clear: both;
                *zoom: 1;
                zoom: 1; }
            .dataTables_wrapper .dataTables_length {
                float: left; }
            .dataTables_wrapper .dataTables_filter {
                float: right;
                text-align: right; }
            .dataTables_wrapper .dataTables_filter input {
                margin-left: 0.5em; }
            .dataTables_wrapper .dataTables_info {
                clear: both;
                float: left;
                padding-top: 0.755em; }

            .dataTables_wrapper .dataTables_paginate {
                float: right;
                text-align: right;
                padding-top: 0.25em; }
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                box-sizing: border-box;
                display: inline-block;
                min-width: 1.5em;
                padding: 0.5em 1em;
                margin-left: 2px;
                text-align: center;
                text-decoration: none !important;
                cursor: pointer;
                *cursor: hand;
                color: #333333 !important;
                border: 1px solid transparent;
                border-radius: 2px; }
            .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
                color: #333333 !important;
                border: 1px solid #979797;
                background-color: white;

                .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
                    cursor: default;
                    color: #666 !important;
                    border: 1px solid transparent;
                    background: transparent;
                    box-shadow: none; }
                .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                    color: white !important;
                    border: 1px solid #111111;
                    background-color: #585858;

                    .dataTables_wrapper .dataTables_paginate .paginate_button:active {
                        outline: none;
                        background-color: #2b2b2b;

                        box-shadow: inset 0 0 3px #111; }
                    .dataTables_wrapper .dataTables_paginate .ellipsis {
                        padding: 0 1em; }

                    .dataTables_wrapper .dataTables_processing {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 100%;
                        height: 40px;
                        margin-left: -50%;
                        margin-top: -25px;
                        padding-top: 20px;
                        text-align: center;
                        font-size: 1.2em;
                        background-color: white;
                        background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(123, 210, 232, 0)), color-stop(25%, rgba(123, 210, 232, 0.9)), color-stop(75%, rgba(123, 210, 232, 0.9)), color-stop(100%, rgba(255, 255, 255, 0)));
                        background: -webkit-linear-gradient(left, rgba(123, 210, 232, 0) 0%, rgba(123, 210, 232, 0.9) 25%, rgba(123, 210, 232, 0.9) 75%, rgba(123, 210, 232, 0) 100%);
                        background: -moz-linear-gradient(left, rgba(123, 210, 232, 0) 0%, rgba(123, 210, 232, 0.9) 25%, rgba(123, 210, 232, 0.9) 75%, rgba(123, 210, 232, 0) 100%);
                        background: -ms-linear-gradient(left, rgba(123, 210, 232, 0) 0%, rgba(123, 210, 232, 0.9) 25%, rgba(123, 210, 232, 0.9) 75%, rgba(123, 210, 232, 0) 100%);
                        background: -o-linear-gradient(left, rgba(123, 210, 232, 0) 0%, rgba(123, 210, 232, 0.9) 25%, rgba(123, 210, 232, 0.9) 75%, rgba(123, 210, 232, 0) 100%);
                        background: linear-gradient(to right, rgba(123, 210, 232, 0) 0%, rgba(123, 210, 232, 0.9) 25%, rgba(123, 210, 232, 0.9) 75%, rgba(123, 210, 232, 0) 100%); }
                    .dataTables_wrapper .dataTables_length,
                    .dataTables_wrapper .dataTables_filter,
                    .dataTables_wrapper .dataTables_info,
                    .dataTables_wrapper .dataTables_processing,
                    .dataTables_wrapper .dataTables_paginate {
                        color: #333333; }
                    .dataTables_wrapper .dataTables_scroll {
                        clear: both; }

                    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody {
                        *margin-top: -1px;
                        -webkit-overflow-scrolling: touch; }
                    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > thead > tr > th, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > thead > tr > td, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > tbody > tr > th, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > tbody > tr > td {
                        vertical-align: middle; }

                    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > thead > tr > th > div.dataTables_sizing,
                    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > thead > tr > td > div.dataTables_sizing, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > tbody > tr > th > div.dataTables_sizing,
                    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody > table > tbody > tr > td > div.dataTables_sizing {
                        height: 0;
                        overflow: hidden;
                        margin: 0 !important;

                        .dataTables_wrapper.no-footer .dataTables_scrollBody {
                            border-bottom: 1px solid #111111; }
                        .dataTables_wrapper.no-footer div.dataTables_scrollHead table.dataTable,
                        .dataTables_wrapper.no-footer div.dataTables_scrollBody > table {
                            border-bottom: none; }

                        .dataTables_wrapper:after {
                            visibility: hidden;
                            display: block;
                            content: "";
                            clear: both;
                            height: 0; 
                        }


                        .select-boxes {
                            height: 100px !important;
                            width:280px;
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
                                    <li class="dropdown">
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
                                                     <a href="#newRt" role="button" id="routes" data-target="#newRt"  data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Route</a>  </li>
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

             
            </body>
        </html>
