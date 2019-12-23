<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

include_once("./DbHandler.php");
$dbh = new DbHandler();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
        <script src="https://cdn.datatables.net/fixedcolumns/3.2.3/js/dataTables.fixedColumns.min.js"></script>
        <link href="lib/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

        <script src="lib/sweetalert.js" type="text/javascript"></script>
        <script src="lib/sweetalert.min.js" type="text/javascript"></script>


        <script type="text/javascript">
            //FILTER BY CLIENT NAME
            var isLoaded = false;
            var row_data = null;

            function FilterProject(sel) {

                var userCode = '<?php echo $_SESSION['division']; ?>';
                var client = sel;

                $.ajax({
                    url: 'getProjects.php?Code=' + userCode + '&debtor=' + client,
                    success: function (data) {
                        $("#project").html(data);
                    }
                });
            }

            function FilterJobs(sel) {

                var userCode = '<?php echo $_SESSION['division']; ?>';
                var client = sel;

                $.ajax({
                    url: 'getJobs.php?Code=' + userCode + '&prjcode=' + client,
                    success: function (data) {
                        $("#job_no").html(data);


                    }
                });
            }

            function FilterJobsNew(sel) {

                var division = sel.value;

                $.ajax({
                    url: 'getJobs.php?Code=' + division + '&prjcode=',
                    success: function (data) {

                        $("#Fjobno").html(data);

                    }
                });
            }



            function FilterTaskNames(val) {
                alert(val);
                var userCode = '<?php echo $_SESSION['user']; ?>';
                var Job = val;


                $.ajax({
                    url: 'getTasknames.php?user=' + userCode + '&job=' + Job,
                    success: function (data) {
                        $("#taskId").html(data);
                    }
                });
            }

            function FilterTaskJobs(val) {

                var allTo = '<?php echo $_SESSION['user']; ?>';
                var taskID = val;

                $.ajax({
                    url: 'getJobCodesByTask.php?user=' + allTo + '&taskID=' + taskID,
                    success: function (data) {

                        $("#jobno").html(data);
                    }
                });
            }

            $(document).ready(function () {

                var division = '<?php echo $_SESSION['division']; ?>';
                var userID = '<?php echo $_SESSION['user']; ?>';
                var userType = '<?php echo $_SESSION['userType']; ?>';

                //don't make changes here without permission--------------------    
                if (userType =='2') {
                    $("#daily_hours").hide();
                } else if (userType == 1) {
                    $("#elm_all_to").hide();
                    $("#elm_division").hide();
                }
                //don't make changes here without permission--------------------    
                
                var obj_div = {value: division};
                FilterJobsNew(obj_div);

                // FILTER TASK--------------------------------------------------
                $("#filterRcd").click(function () {

                    var table = $('#tasks').DataTable();
                    table.destroy();

                    var userCode = '<?php echo $_SESSION['division']; ?>';
                    var debtor = document.getElementById("Fclient").value;

                    var Divisions = '';
                    Divisions = document.getElementById("Divisions").value;


                    var jobno = document.getElementById("Fjobno").value;
                    var status = document.getElementById("Fsts").value;

                    var allocatedTo = '';
                    allocatedTo = document.getElementById("Fall_to").value;


                    var date = document.getElementById("Fdate").value;
                    //        
                    if (debtor == 'all') {
                        debtor = '';
                    }
                    if (jobno == 'all') {
                        jobno = '';
                    }
                    if (status == 'all') {
                        status = '';
                    }

                    if (Divisions == 'all') {
                        Divisions = '';
                    }
                    if (userCode == '002') {
                        userCode = ''
                    }
           
                    if (allocatedTo == 'all') {
                        allocatedTo = '';
                    }

               
                    var url = "filterAMD.php?Code=" + userCode + "&jobno=" + jobno + "&sts=" + status + "&date=" + date + "&all_to=" + allocatedTo + "&debtor=" + debtor.trim() + "&division=" + Divisions.trim() +"&userType="+userType+"&userID="+userID
                    console.log(url);

                    $('#tasks').DataTable({
                        "processing": true,
                        scrollCollapse: true,
                        "lengthMenu": [[20, 40, 100, -1], [20, 40, 100, "All"]],
                        "columnDefs": [
                            {"width": "3%", "targets": 0},
                            {"width": "6%", "targets": 1},
                            {"width": "6%", "targets": 3},
                            {"width": "10%", "targets": 5},
                            {"width": "4%", "targets": 9},
                            {"width": "5%", "targets": 10},
                            {"width": "5%", "targets": 11},
                            {"width": "5%", "targets": 12},
                            {"width": "6%", "targets": 13},
                            {"width": "5%", "targets": 15},
                        ],

                        "ajax": {
                            "url": url,
                            "type": "POST"
                        },

                        "columns": [
                            {"data": "IndexNo"},
                            {"mRender": function (data, type, row) {
                                    return '<label class="remarks" data-toggle="tooltip" title="' + row.DebName + '">' + row.DebName + '</label>'

                                }
                            },
                            {"data": "ProjectName"},
                            {"data": "JobCode"},
                            {"mRender": function (data, type, row) {

                                    return '<label class="remarks" data-toggle="tooltip" title="' + row.Module + '">' + row.Module + '</label>'

                                }
                            },
                            {"mRender": function (data, type, row) {

                                    return '<label data-toggle="tooltip" title="' + row.Task + '">' + row.Task + '</label>'

                                }
                            },
                            {"data": "AllocatedTo"},
                            {"data": "ScheduledHrs"},
                            {"data": "ActualHrs"},
                            {"data": "Status"},
                            {"data": "allBy"},
                            {"data": "RequestDate"},
                            {"data": "Priority"},
                            {"data": "StartDate"},
                            {"data": "ScheduledDate"},
                            {"mRender": function (data, type, row) {

                                    return '<label class="remarks" data-toggle="tooltip" title="' + row.Remarks + '">' + row.Remarks + '</label>'

                                }
                            },
                            {"mRender": function (data, type, row) {

                                    return "<button class='btn btn-primary btn-xs' href='#editModal'  data-toggle='modal' data-target='#editModal' ><span class='glyphicon  glyphicon-pencil' aria-hidden='true'></button>  <a href='#' id='remove' role='button' class='btn btn-danger btn-xs'><span class='glyphicon  glyphicon-remove' aria-hidden='true'></span></a>"

                                }
                            },
                        ]

                    });


                });

                // EDIT HOUST AJAX--------------------------------------------------------------
                $("#last_task").click(function () {

                    //var todayHours = '<?php echo $CurrentHours; ?>';
                    var todayHours = 'set Date and time';
                    if (todayHours > 0) {
                        jQuery.noConflict();
                        $('#lastHr').modal('show');

                        $.post("getLastTask.php", {
                        }, function (data) {

                            $("#last_hour").text('Last Record ' + data + ' (Hrs)');
                        });
                    } else {
                        swal("No hours added today!");
                    }


                });

                $("#updateLH").click(function () {

                    var newHour = document.getElementById("latest_hour").value;

                    var hrs_decml = newHour.split(".");
                    var decimal_hr = null;
                    if (hrs_decml.length > 1) {
                        decimal_hr = '0.' + hrs_decml[1];
                    } else {
                        decimal_hr = 0;
                    }

                    if (decimal_hr != 0 && decimal_hr != 0.25 && decimal_hr != 0.5 && decimal_hr != 0.75) {

                        swal("Invalid Actual Hours - " + decimal_hr, "Decimal hours must be H.25 or H.5 or H.75");

                    } else {

                        if (newHour > 0) { // check for valid number not less than 1

                            $.post("updateLastHour.php", {
                                hour: newHour,
                            }, function (data) {

                                if (data == "200") {

                                    swal("Updated", "You have updated the last hours.");
                                    window.location.href = 'home.php';

                                } else {
                                    swal("Not Updated", "Please contact Admin!");
                                }

                            });
                        } else {
                            swal("Invalid input", "Please enter correct hours!");
                        }

                    }
                });
                // UPDATE HOURS--------------------------------------------------------------

                $("label").prop("title", function () {

                    return $(this).text();
                });

                //LOAD ALL TASKS----------------------------------------------------------------
                $("#datetimepicker_SCHdate").on("dp.change", function (e) {

                    var date = e.date.format('Y-M-D');

                    if (isLoaded == true) {

                        filterbyDate(date);
                    }


                });

                var division = '<?php echo $_SESSION['division']; ?>';
                var userID = '<?php echo $_SESSION['user']; ?>';
                var userType = '<?php echo $_SESSION['userType']; ?>';


                //for PM only
                if (userType == '3') {
                    userID = '';
                }

                //var table = $('#tasks').DataTable();
                //table.destroy();

                //load table on start by deafult---------------------------------------------------------------
                var taskTable= $('#tasks').DataTable({
                    "processing": true,
                    "lengthMenu": [[20, 40, 100, -1], [20, 40, 100, "All"]],
                    "columnDefs": [
                        {"width": "3%", "targets": 0},
                        {"width": "6%", "targets": 1},
                        {"width": "6%", "targets": 3},
                        {"width": "5%", "targets": 3},
                        {"width": "10%", "targets": 5},
                        {"width": "6%", "targets": 9},
                        {"width": "5%", "targets": 10},
                        {"width": "6%", "targets": 11},
                        {"width": "3%", "targets": 12},
                        {"width": "6%", "targets": 13},
                        {"width": "5%", "targets": 15},
                    ],

                    "ajax": {
                        "url": "getTasks.php?divisionCode=" + division + "&userID=" + userID,
                        "type": "POST"
                    },
                    "columns": [
                        {"data": "IndexNo"},
                        {"mRender": function (data, type, row) {

                                return '<label class="remarks" data-toggle="tooltip" title="' + row.DebName + '">' + row.DebName + '</label>'

                            }
                        },

                        {"mRender": function (data, type, row) {

                                return '<label class="remarks" data-toggle="tooltip" title="' + row.ProjectName + '">' + row.ProjectName + '</label>'

                            }
                        },
                        {"data": "JobCode"},
                        {"mRender": function (data, type, row) {

                                return '<label class="remarks" data-toggle="tooltip" title="' + row.Module + '">' + row.Module + '</label>'

                            }
                        },
                        {"mRender": function (data, type, row) {

                                return '<label data-toggle="tooltip" title="' + row.Task + '">' + row.Task + '</label>'

                            }
                        },
                        {"data": "AllocatedTo"},
                        {"data": "ScheduledHrs"},
                        {"data": "ActualHrs"},
                        {"data": "Status"},
                        {"data": "allBy"},
                        {"data": "RequestDate"},
                        {"data": "Priority"},
                        {"data": "StartDate"},
                        {"data": "ScheduledDate"},
                        {"mRender": function (data, type, row) {

                                return '<label class="remarks" data-toggle="tooltip" title="' + row.Remarks + '">' + row.Remarks + '</label>'

                            }
                        },
                        {"mRender": function (data, type, row) {

                        return " <button type='button' class='btn btn-success btn-xs' id='addnewHrs'><span class='glyphicon  glyphicon-plus' aria-hidden='true'></button>  <a href='#' id='remove' role='button' class='btn btn-danger btn-xs'><span class='glyphicon  glyphicon-remove' aria-hidden='true'></span></a> <button class='btn btn-primary btn-xs' href='#editModal'  data-toggle='modal' data-target='#editModal' ><span class='glyphicon  glyphicon-pencil' aria-hidden='true'></button> "

                            }
                        },
                    ],
                    initComplete: function () {
                        isLoaded = true;
                    }
                });
                
                //add hours button in tasks row----------------------------------------------------------------------
                $(document).on('click', '#addnewHrs', function(){ 
                //show add hours modal only for owners tasks
                var data = taskTable.row($(this).closest('tr')).data();

                var loggedUserName = '<?php echo $_SESSION['username']; ?>';
                var allo_user = data['AllocatedTo'];
               // alert(loggedUserName+allo_user);
                
                if(loggedUserName == allo_user){
                 
                jQuery.noConflict(); //exception for modal show
                $('#addHours').modal('show');       
                 
                }else{
                    
                swal("Oops! Access denied!", "Only allocated users can add hours!", "warning");
                
                }
 
                });

                //add hours button in tasks row END----------------------------------------------------------------------
                $('#tasks tbody').on('click', 'button', function () {
                    // Get row data 
                    var data = $('#tasks').DataTable().row($(this).closest('tr')).data();
                    var TASK_ID = data.IndexNo;
                    var JOB_CODE = data.JobCode;
                    var TASK = data.Task;

                    document.getElementById("taskid").value = TASK_ID;
                    document.getElementById("jobno").value = JOB_CODE;
                    document.getElementById("task_description").value = TASK;


                });


              

                $('#tasks tbody').on('click', 'a', function () {

                    var data = $('#tasks').DataTable().row($(this).closest('tr')).data();

                    var ACT_HRS = data.ActualHrs;
                    var job_no = data.JobCode;
                    var task_no = data.IndexNo;
                    var all_to = data.AllocatedTo;
                    var All_By = data.allBy;



                    var userCode = '<?php echo $_SESSION['division']; ?>';
                    var type = '<?php echo $_SESSION['userType']; ?>';
                    var userName = '<?php echo $_SESSION['username']; ?>';
                    var user = '<?php echo $_SESSION['user']; ?>';


                    if (userCode == '002') {  // FOR ADMIN ONLY-------------------------------------------------------------------

                        var r = confirm("Are you sure to remove this Task?");
                        if (r == true) {

                            $.post("removeTask.php", {
                                jobno: job_no,
                                taskId: task_no
                            }, function (data) {

                                if (data == 200) {
                                    //   alert("Task removed");
                                    swal("Task removed");
                                    window.location.href = 'home.php';
                                } else {
                                    //    alert("Deleting Task Failed!");
                                    swal("Deleting Task Failed!");
                                }

                            });
                        }
                    } else if (ACT_HRS == null && type != '1') { // for normal user--------------
                        var r = confirm("Are you sure to remove this Task?");
                        if (r == true) {

                            $.post("removeTask.php", {
                                jobno: job_no,
                                taskId: task_no
                            }, function (data) {



                                if (data == 200) {
                                    //    alert("Task removed");
                                    swal("Task removed");
                                    window.location.href = 'home.php';
                                } else {
                                    //alert("Deleting Task Failed!");
                                    swal("Deleting Task Failed!");
                                }

                            });

                        }
                    } else if (type == '3' && ACT_HRS == null) {//-----for PM
                        var r = confirm("Are you sure to remove this Task?");
                        if (r == true) {

                            $.post("removeTask.php", {
                                jobno: job_no,
                                taskId: task_no
                            }, function (data) {

                                if (data == 200) {
                                    alert("Task removed");
                                    //swal("Task removed");
                                    window.location.href = 'home.php';
                                } else {
                                    // alert("Deleting Task Failed!");
                                    swal("Deleting Task Failed!");
                                }

                            });
                        }
                    } else if (All_By == userName && ACT_HRS == null) {
                        var r = confirm("Are you sure to remove this Task?");
                        if (r == true) {

                            $.post("removeTask.php", {
                                jobno: job_no,
                                taskId: task_no
                            }, function (data) {
                                if (data == 200) {
                                    //   alert("Task removed");
                                    swal("Task removed");
                                    window.location.href = 'home.php';
                                } else {
                                    // alert("Deleting Task Failed!");
                                    swal("Deleting Task Failed!");
                                }

                            });
                        }
                    } else {
                        //  alert("You are not Athorized to Remove this Task!");
                        swal("You are not Athorized to Remove this Task!");
                    }

                });



                //Add Hours---------------------------------------------------------------------
                $("#saveHrs").click(function () {

                    var job = document.getElementById("jobno").value;
                    var actHours = document.getElementById("actualHrs").value;
                    var remarks = document.getElementById("remarkHrs").value;
                    var task = document.getElementById("taskid").value;
                    var Fsts = document.getElementById("Fsts").value;
                    

                    var hrs_decml = actHours.split(".");
                    var decimal_hr = null;
                    if (hrs_decml.length > 1) {
                        decimal_hr = '0.' + hrs_decml[1];
                    } else {
                        decimal_hr = 0;
                    }

                    if (job == "" || actHours == "") {

                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000);

                    } else if (decimal_hr != 0 && decimal_hr != 0.25 && decimal_hr != 0.5 && decimal_hr != 0.75) {
                        swal("Invalid Actual Hours - " + decimal_hr, "Decimal hours must be H.25 or H.5 or H.75");
                    } else {
                        $.post("saveHours.php", {
                            jobno: job,
                            actHours: actHours,
                            remarks: remarks,
                            taskId: task,
                            Fsts:Fsts
                        }, function (data) {

                        
                            if (data == 200) {
                                // alert("Hours Added");
                                swal("Hours Added");
                                window.location.href = 'home.php';
                                $('#addHours').modal('hide');
                            } else {
                                //alert("Hours Save Failed!");
                                swal("Hours Save Failed!");
                            }

                        });
                    }


                });

                //save Tasks------------------------------------------------------------------
                $("#saveTask").click(function () {

                    var DebCode = document.getElementById("DebCode").value;
                    var project = document.getElementById("project").value;
                    var job = document.getElementById("job_no").value;
                    var modulename = document.getElementById("module").value;
                    var all_to = document.getElementById("all_to").value;
                    var task_des = document.getElementById("task_des").value;
                    //var actHrs      = document.getElementById("actHrs").value;
                    var alcHrs = document.getElementById("alcHrs").value;
                    var status = document.getElementById("status").value;
                    var Sdate = document.getElementById("Sdate").value;
                    var reqBy = document.getElementById("Rby").value;
                    var reqDate = document.getElementById("Rdate").value;
                    var startDate = document.getElementById("STdate").value;
                    var priority = document.getElementById("priority").value;
                    var remrk = document.getElementById("remark").value;
                    var actHrs = '0';

                    var hrs_decml = alcHrs.split(".");
                    if (hrs_decml.length > 1) {
                        var decimal_hr = '0.' + hrs_decml[1];
                    } else {
                        var decimal_hr = 0;
                    }

                    //      alert(all_to);

                    if (status == 1 || job == "" || modulename == "" || all_to == "" || task_des == "" || alcHrs == "" || Sdate == "" ||
                            reqBy == "" || reqDate == "") {

                        $(".alert").removeClass("in").show();
                        $(".alert").delay(100).addClass("in").fadeOut(3000); // input validation

                    } else if (hrs_decml.length > 1) {

                        if (decimal_hr != 0.25 && decimal_hr != 0.5 && decimal_hr != 0.75) {

                            swal("Invalid Shedule Hours - " + decimal_hr, "Decimal hours must be H.25 or H.5 or H.75");
                        } else {

                            $.post("saveTask.php", {

                                client: DebCode,
                                project: project,
                                job: job,
                                module: modulename,
                                alTo: all_to,
                                task: task_des,
                                actHour: actHrs,
                                allHrs: alcHrs,
                                status: status,
                                shdate: Sdate,
                                reqBy: reqBy,
                                reqdate: reqDate,
                                stDate: startDate,
                                priority: priority,
                                remarkValue: remrk

                            }, function (data) {
                                //alert(data);
                                if (data == 200) {
                                    //    alert("Task Saved");
                                    swal("Task Saved");
                                    window.location.href = 'home.php';
                                    $('#newUser').modal('hide');

                                } else {
                                    // alert("Task not Saved");
                                    swal("Task not Saved");

                                }

                            });
                        }

                    } else {

                        $.post("saveTask.php", {

                            client: DebCode,
                            project: project,
                            job: job,
                            module: modulename,
                            alTo: all_to,
                            task: task_des,
                            actHour: actHrs,
                            allHrs: alcHrs,
                            status: status,
                            shdate: Sdate,
                            reqBy: reqBy,
                            reqdate: reqDate,
                            stDate: startDate,
                            priority: priority,
                            remarkValue: remrk

                        }, function (data) {
                            //alert(data);
                            if (data == 200) {
                                //   alert("Task Saved");
                                swal("Task Saved");
                                window.location.href = 'home.php';
                                $('#newUser').modal('hide');

                            } else {
                                // alert("Task not Saved");
                                swal("Task not Saved");

                            }

                        });
                    }

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
                                <a class="navbar-brand" href="home.php" title=''><span class="glyphicon glyphicon-time"></span> SFA </a>
                            </div>

                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li>
                                        <a href="#newUser" role="button" id="task" data-target="#newUser"  data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add User</a>
                                    </li>
                                    <li>
                                        <a href="#newCus" role="button" id="task" data-target="#newCus"  data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Customer</a>
                                    </li>
                                    <li>
                                        <a href="#newRt" role="button" id="routes" data-target="#newRt"  data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Route</a>
                                    </li>
<li>
                                        <a href="#reason" role="button" id="reason" data-target="#newReason"  data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Reason</a>
                                    </li>

                                    <li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Reports <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#" role="button" id="daily" ><span class="glyphicon glyphicon-leaf"></span> Daily</a>
                                            </li>
                                            <li>
                                                <a href="#" role="button" id="dateWise" ><span class="glyphicon glyphicon-calendar"></span> Date Wise</a>
                                            </li>
                                           <li>
                                             <a href="#" role="button" id="schHours" ><span class="glyphicon glyphicon-calendar"></span> Sch. Hrs Vs Act. Hrs</a>
                                        </li>
                                        <li>
                                          <a href="#"  role="button" id="work_report" ><span class="glyphicon glyphicon-calendar"></span> Total Work Report</a>
                                        </li>
                                                 
                                        </ul>
                                    </li>

                                </ul>



                                <ul class="nav navbar-nav navbar-right">

                                    <li><a href="logout.php" onclick="return confirm('Are you sure to logout?');"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["username"] ?>   <span class="glyphicon glyphicon-log-out"></span>    Logout</a></li>
                                </ul>

                            </div><!--/.nav-collapse -->
                        </div>

<!--------------------------------Create new User------------------------------------------------>
                        <div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="newUser" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create User</h5>


                                    </div>
                                    <div class="modal-body">

                               
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Name</label>
                                                    <input type="text" class="form-control" id="rep_name" />
                           

                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col col-md-6">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Address Line1</label>

                                                   <input type="text" class="form-control"  name="comment" id="rep_address1"  />

                                                </div>
                                            </div>
                                             <div class="col col-md-6">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Address Line2</label>

                                                  <input type="text"  class="form-control"  name="comment" id="rep_address2"  />

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">




                                            <div class="col col-md-4">

                                                 <div class="form-group">

                                                    <label for="inputPassword3" >User name</label>

                                                  <input type="text"  class="form-control"  name="comment" id="rep_uname"  />

                                                </div>

                                            </div>
                                            <div class="col-4 col-md-4">

                                                <div class="form-group">

                                                    <label for="inputPassword3" >Password</label>

                                                  <input type="password"  class="form-control"  name="comment" id="rep_pwd"  />

                                                </div>

                                            </div>
                                            <div class="col-4 col-md-4">

                                               <div class="form-group">

                                                    <label for="inputPassword3" >Confirm Password</label>

                                                  <input type="password"  class="form-control"  name="comment" id="rep_cpwd"  />

                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 col-md-4">

                                                <div class="form-group">

                                                    <label for="inputPassword3" >Request By</label>
                                                    <input type="text" class="form-control" id="Rby" />

                                                </div>

                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">

                                                    <label 
                                                        for="inputPassword3" >Priority</label>
                                                    <select id="priority" class="form-control" > 
                                                        <option value="0"> --SELECT-- </option>
                                                        <option value="1"> 1-High </option>
                                                        <option value="2"> 2-Medium </option>
                                                        <option value="3"> 3-Low </option> 

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col col-md-4">
                                                <div class="form-group">

                                                    <label 
                                                        for="inputPassword3" >Status</label>
                                                    <select id="status" class="form-control" > 
                                                        <option value="Not Selected" > --SELECT-- </option>  
                                                        <option value="Ongoing" > Ongoing </option>
                                                        <option value="Pending" > Pending </option>
                                                        <option value="Hold" > Hold </option>
                                                        <option value="Trans" > Trans </option>

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
                                        <button class="btn btn-default"  data-dismiss="modal" aria-hidden="true">Cancel</button>
                                        <button id="saveTask" type="button" value="Saveadmin" class="btn btn-primary">Save</button>
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
                                                    <input type="text" class="form-control" id="rep_name" />
                           

                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col col-md-6">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Address Line1</label>

                                                   <input type="text" class="form-control"  name="comment" id="rep_address1"  />

                                                </div>
                                            </div>
                                             <div class="col col-md-6">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Address Line2</label>

                                                  <input type="text"  class="form-control"  name="comment" id="rep_address2"  />

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">




                                            <div class="col col-md-4">

                                                 <div class="form-group">

                                                    <label for="inputPassword3" >User name</label>

                                                  <input type="text"  class="form-control"  name="comment" id="rep_uname"  />

                                                </div>

                                            </div>
                                            <div class="col-4 col-md-4">

                                                <div class="form-group">

                                                    <label for="inputPassword3" >Password</label>

                                                  <input type="password"  class="form-control"  name="comment" id="rep_pwd"  />

                                                </div>

                                            </div>
                                            <div class="col-4 col-md-4">

                                               <div class="form-group">

                                                    <label for="inputPassword3" >Confirm Password</label>

                                                  <input type="password"  class="form-control"  name="comment" id="rep_cpwd"  />

                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 col-md-4">

                                                <div class="form-group">

                                                    <label for="inputPassword3" >Request By</label>
                                                    <input type="text" class="form-control" id="Rby" />

                                                </div>

                                            </div>
                                            <div class="col-4 col-md-4">
                                                <div class="form-group">

                                                    <label 
                                                        for="inputPassword3" >Priority</label>
                                                    <select id="priority" class="form-control" > 
                                                        <option value="0"> --SELECT-- </option>
                                                        <option value="1"> 1-High </option>
                                                        <option value="2"> 2-Medium </option>
                                                        <option value="3"> 3-Low </option> 

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col col-md-4">
                                                <div class="form-group">

                                                    <label 
                                                        for="inputPassword3" >Status</label>
                                                    <select id="status" class="form-control" > 
                                                        <option value="Not Selected" > --SELECT-- </option>  
                                                        <option value="Ongoing" > Ongoing </option>
                                                        <option value="Pending" > Pending </option>
                                                        <option value="Hold" > Hold </option>
                                                        <option value="Trans" > Trans </option>

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
                                        <button class="btn btn-default"  data-dismiss="modal" aria-hidden="true">Cancel</button>
                                        <button id="saveTask" type="button" value="Saveadmin" class="btn btn-primary">Save</button>
                                    </div>
                                </div>   
                            </div>
                        </div>
 <!-- end create user------------------------------------------------------------------------------------------------------------------>
         <!--------------------------------Create Route------------------------------------------------>
<div class="modal fade" id="newRt" tabindex="-1" role="dialog" aria-labelledby="newCus" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Route</h5>


                                    </div>
                                    <div class="modal-body">

                               
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Route Name</label>
                                                    <input type="text" class="form-control" id="rep_name" />
                           

                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col col-md-6">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Route Code</label>

                                                   <input type="text" class="form-control"  name="comment" id="rep_address1"  />

                                                </div>
                                            </div>
                                             <div class="col col-md-6">
                                               <div class="form-group">

                                                    <label 
                                                        for="inputPassword3" >Assign Rep</label>
                                                    <select id="priority" class="form-control" > 
                                                        <option value="0"> --SELECT REP-- </option>
                                                        <option value="1"> 1-abc </option>
                                                        <option value="2"> 2-xyz</option>
                                                        <option value="3"> 3-test </option> 

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
                                        <button class="btn btn-default"  data-dismiss="modal" aria-hidden="true">Cancel</button>
                                        <button id="saveTask" type="button" value="Saveadmin" class="btn btn-primary">Save</button>
                                    </div>
                                </div>   
                            </div>
                        </div>
 <!-- end create Route------------------------------------------------------------------------------------------------------------------>
                 <!--------------------------------Create Reason------------------------------------------------>
<div class="modal fade" id="newReason" tabindex="-1" role="dialog" aria-labelledby="newReason" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Reason</h5>


                                    </div>
                                    <div class="modal-body">

                               
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <div class="form-group">

                                                    <label for="inputPassword3" >Reason Name</label>
                                                    <input type="text" class="form-control" id="rep_name" />
                           

                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                          
                                             <div class="col col-md-6">
                                               <div class="form-group">

                                                    <label 
                                                        for="inputPassword3" >Select Type</label>
                                                    <select id="priority" class="form-control" > 
                                                        <option value="0"> --SELECT-- </option>
                                                        <option value="1"> Expense</option>
                                                        <option value="2"> Nonproductive</option>
                                                        <option value="3"></option> 

                                                    </select>
                                                </div>
                                            </div>
                                             
                                             <div class="col col-md-6">
                                               <div class="form-group">

                                                    <label for="inputPassword3" >Reason Code</label>
                                                    <input type="text" class="form-control" id="rep_name" />
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
                                        <button class="btn btn-default"  data-dismiss="modal" aria-hidden="true">Cancel</button>
                                        <button id="saveTask" type="button" value="Saveadmin" class="btn btn-primary">Save</button>
                                    </div>
                                </div>   
                            </div>
                        </div>
 <!-- end create Route------------------------------------------------------------------------------------------------------------------>
                             
                    </div>

              

                
                   
                    <div class="container">    

                        <table id="tasks" class="table-bordered"  cellspacing="0" width="100%">
                            <thead>

                                <tr>
                                    <th>#Id</th>
                                    <th>Client</th>
                                    <th>Project</th>
                                    <th>Job No</th>
                                    <th>Module</th>
                                    <th>Task</th>
                                    <th>Allc.To</th>
                                    <th>Sch.Hrs</th>
                                    <th>Act.Hrs</th>
                                    <th>Status</th>
                                    <th>Allc.By</th>
                    <!--                <th>Req, From</th>-->
                                    <th>Req.Date</th>
                                    <th>Prty</th>
                                    <th>Start Date</th>
                                    <th>Sch.Date</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>

                            </thead>

                            <tbody>
                        </table>

                    </div> 


                    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
                    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
                    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
                    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

             
            </body>
        </html>
