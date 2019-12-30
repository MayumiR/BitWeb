<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>USER</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
              
        });
        $(".userAdd").click(function () {   
            alert(123);    
            $('#newUser').modal('show');
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix" style="width: 570px">
                        <h3 class="pull-left">User Details</h3>
                        <a href="" id = "userAdd"  role="button" data-target=""  data-toggle="modal" class="btn btn-success pull-right">Add New User</a>
                    </div>
                    <?php
                    // Include config file
                    require_once("../db/DBConnection.php");
                    require_once("../functions.php");
                $connection=(new DBConnection())->getDBConnection();
                    
                    // Attempt select query execution
                    $sql = 'SELECT * FROM User';
                    if($result = mysqli_query($connection, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class= "table table-bordered table-striped" style="width: 570px">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th>Name</th>';
                                        echo '<th>Address</th>';
                                        echo '<th>Mobile</th>';
                                        echo '<th>User Name</th>';
                                        echo '<th>Action</th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while($row = mysqli_fetch_array($result)){
                                    echo '<tr>';
                                        echo '<td>'. $row['Name']. '</td>';
                                        echo '<td>'.  $row['Address']. '</td>';
                                        echo '<td>'. $row['Mobile']. '</td>';
                                        echo '<td>'. $row['UserName']. '</td>';
                                        echo '<td>';
                        
                                            echo '<a href="update.php"><span class="glyphicon glyphicon-pencil"></span></a>';
                                            echo '<a href="delete.php"><span class="glyphicon glyphicon-trash"></span></a>';
                                        echo '</td>';
                                    echo '</tr>';
                                }
                                echo '</tbody>';                            
                            echo '</table>';
                            
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<p class="lead"><em>No records were found.</em></p>';
                        }
                    } else{
                        echo 'ERROR: Could not able to execute';
                    }
 
                    // Close connection
                    mysqli_close($connection);
                    ?>
                    
                </div>
            </div>        
        </div>
    </div>
<!-- create user modal------------------------------------------------------------------------------------------------------------------>

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
 

 </body>
</html>