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
        <title>Item transactions</title>
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
                var table = $('#items').DataTable();
                    table.destroy();
                      $('#items').DataTable({
                        "ajax": "getItemDetails.php",
                        "columns": [
                        {
                        "className":      'details-control',
                         "orderable":      false,
                         "data":           null,
                         "defaultContent": ''
                        },
                        { "data": "Code" },
                        { "data": "Name" },
                        { "data": "UnitOfM" },
                        { "data": "Price" },
                        // { "data": "Price" },
                        {"mRender": function (data, type, row) {
                             return "<button class='btn btn-primary btn-xs' href='#updateModal'  data-toggle='modal' data-target='#updateModal' ><span class='glyphicon  glyphicon-pencil' aria-hidden='true'> </span></button>    <a href='#' id='remove' role='button' class='btn btn-danger btn-xs'><span class='glyphicon  glyphicon-remove' aria-hidden='true'> </span></a> <label class='btn btn-primary btn-xs' href='#modifyPrice'  data-toggle='modal' data-target='#modifyPrice' ><span class='glyphicon  glyphicon-cog' aria-hidden='true'> AllocatePrice</span></label> ";      
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

$("#saveItem").click(function () {
                    var ItemCode = document.getElementById("item_code").value;
                    var ItemName = document.getElementById("item_name").value;
                    var Uom = document.getElementById("uom").value;
                    var price = document.getElementById("itmPrice").value;
                   //alert(RepName+"-"+RepAddress+"-"+RepPwd+"-"+RepMobile+"-"+RepPrefix);

                    if (ItemCode == "" || ItemName == "" || price == "" || Uom == "") {
                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation
                    }else{
              
                              $.post("saveItem.php", {

                                code: ItemCode,
                                name: ItemName,
                                uom: Uom,
                                regprice : price

                            }, function (data) {
                                //alert(data);
                                if (data == 200) {
                                   
                                    swal("Item Saved");
                                    window.location.href = 'item_transactions.php';
                                    

                                } else {
                                  
                                    swal("Item not Saved or already exist");

                                }

                            });
                        }
                     });
     //end save item
          
        //assign mac address start table row click

           
        
        $('#items').on('click', 'label', function () {

            var data = $('#items').DataTable().row($(this).closest('tr')).data();

            var code = data.Code;
            var savedPrice = data.Price;
            var lblPrice = 'Old Price - '+savedPrice;
            $("#edtPri").text('Code - '+code +' | '+lblPrice);
            //alert("mac"+code);

            $("#savePrice").click(function () {
                    var price = document.getElementById("price").value;
                    
                    if (price == "") {
                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation
                    }else{
              
                              $.post("savePrice.php", {

                                code: code,
                                price: price

                            }, function (data) {
                                //alert(data);
                                if (data == 200) {
                                   
                                    swal("Price Allocated");
                                    window.location.href = 'item_transactions.php';
                                    

                                } else {
                                  
                                    swal("Price not allocated");

                                }

                            });   
                        }
                    });
                    
           
                    //end assign mac address button click

            });

            
  //update item
  $('#items').on('click', 'button', function () {
        var data = $('#items').DataTable().row($(this).closest('tr')).data();
        var code = data.Code;

        var savedName = data.Name;
        var savedUOM = data.UnitOfM;

        //alert(savedName+'  - '+savedUOM)

        var lblItemname = 'Name - '+savedName;
        var lblUOM = 'UOM - '+savedUOM;

        $("#lblItem").text(lblItemname);
        $("#lblUOM").text(lblUOM);
        $("#update_item").click(function () {
                var edtname = document.getElementById("editName").value;
                var edtUOM = document.getElementById("editUOM").value;
                var txntype = 'item';
                var edtmob = '2345678904';
                //alert(edtname+'-'+edtAdrs+' mm '+edtMob);

                    if (edtname == "" || edtUOM == "") {
                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation
                    }else{
                              $.post("update.php", {
                                code: code,
                                addrs: edtUOM,
                                mobil: edtmob,
                                name: edtname,
                                txn: txntype
                            }, function (data) {
                                if (data == 200) {
                                    swal("Item Updated");
                                    window.location.href = 'item_transactions.php';
                                } else if(data == 400){
                                    swal("Item not Updated");
                                }else{
                                    swal("Invalid item");
                                }
                            });
                           
                        }
                    });
                    
    });//close update click function
           
        
     //remove item
     $('#items').on('click', 'a', function () {
        var data = $('#items').DataTable().row($(this).closest('tr')).data();
        var code = data.Code;
        var type = 'itemtxn';
        var r = confirm("Are you sure to remove this item?");
        if (r == true) {
            $.post("remove.php", {
                KeyCode: code,
                txn: type
            }, function (data) {
                if (data == 200) {
                    alert("Item removed");
                    window.location.href = 'item_transactions.php';
                } else {
                    alert("Deleting Item Failed!");
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
                            <a href="#newItm" role="button" id="btnFilter" data-target="#newItm"  data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Item</a>
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

       <!-- update price-->

                        <div class="modal fade" id="modifyPrice" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Price allocate</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">

                                        <label id="edtPri" for="inputPassword3" ></label>
                                        <input  placeholder="Enter Price" type="number" class="form-control" id="price"  />

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="savePrice" class="btn btn-default" data-dismiss="modal">Allocate</button>
                                </div>
                            </div>
                        </div>
                    </div>
 <!-- end price update------------------------------------------------------------------------------------------------------------------>

 
<!-- update  modal start-->
<div class="modal fade" id="updateModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Update Item</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">
                                                    <!-- <label for="inputName" >Name</label>
                                                    <input type="text" class="form-control" id="rep_name" /> -->
                                                    <label id="lblItem" for="inputPassword3" >Name</label>
                                                    <input  placeholder="" type="text" class="form-control" id="editName"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">
                                                    <label id="lblUOM" for="inputPassword3" >UOM</label>
                                                    <input  placeholder="" type="text" class="form-control" id="editUOM"  />
                                            </div>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">
                                                    <label id="lblPrice" for="inputPassword3" >Price</label>
                                                    <input  placeholder="" type="text" class="form-control" id="editPrice"  />
                                                </div>
                                            </div>
                                        </div> -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="update_item" class="btn btn-default" data-dismiss="modal">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- update  modal end-->
 <!--------------------------------Add item------------------------------------------------>
 <div class="modal fade" id="newItm" tabindex="-1" role="dialog" aria-labelledby="newItm" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Item</h5>


                                    </div>
                                    <div class="modal-body">

                                         <div class="row">
                                            <div class="col col-md-4">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Item Code</label>

                                                   <input type="text" class="form-control"  name="comment" id="item_code"  />

                                                </div>
                                            </div>
                                             <div class="col col-md-4">
                                               <div class="form-group">

                                                    <label for="inputPassword3" >UOM</label>
                                                    <input type="text" class="form-control" id="uom" />
                           

                                                </div>
                                            </div>
                                            <div class="col col-md-4">
                                               <div class="form-group">

                                                    <label for="inputPassword3" >Price</label>
                                                    <input type="text" class="form-control" id="itmPrice" />
                           

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
    <div class="container">
    <div class="table-responsive">
       <table id="items" class="table table-striped table-bordered table-hover" style="width:100%">
          <thead>
            <tr>
                <th></th>
                <th>ItemCode</th>
                <th>ItemName</th>
                <th>Unit of Measure</th>
                 <th>Price</th> 
                <th>Actions (edit | delete | allocate price)</th>
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
