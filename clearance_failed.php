<?php

include_once('admin/config.php');
include_once('admin/inc_dbfunctions.php');

$dataRead = New DataRead();

$currentuserid = getCookie('userid');


$staffdetails = $dataRead->member_getbyid($mycon, $currentuserid);

//get the lists of the students in the database
$students_getall = $dataRead->clearance_status_done_by_students($mycon, $staffdetails['department_id'], '4'); //0 signifies students

if (isset($_GET['delete']) && $_GET['delete'] != '') deleteStudents($_GET['delete']);

//delete the department
function deleteStudents($student_id)
{
    $mycon = databaseConnect();
    $dataRead = New DataRead();
    $dataWrite = New DataWrite();

    //check if the department exists
    $student_getbyid = $dataRead->member_getbyid($mycon,$student_id);
    if (!$student_getbyid)
    {
        showAlert('Sorry, this student do not exists. Please try again later.');
        openPage('clearance_all.php');
        return;
    }

    //if the department exists then delete
    $student_delete = $dataWrite->members_delete($mycon, $student_id);
    if (!$student_delete)
    {
        showAlert('Unable to delete the student, please try again later.');
        return;
    }

    showAlert('Student successfully deleted. Thank You!');
    openPage('clearance_all.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo pageTitle(); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">


        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="assets/css/metisMenu.min.css" rel="stylesheet">
        <!-- Icons CSS -->
        <link href="assets/css/icons.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">

    </head>


    <body>

        <div id="page-wrapper">

                <?php include_once('inc_sidebar.php'); ?>
                <!--left navigation end-->

                <!-- START PAGE CONTENT -->
                <div id="page-right-content">

                    <div class="container">
                       <div class="row">
                            <div class="col-md-12">
                                <h4 class="m-t-0 header-title">Clearance status Disapproval</h4>

                                <div class="table-responsive m-b-20">
                                    <p class="text-muted font-13 m-b-30">
                                        Status of your clearance disapproval for each students in your department
                                    </p>

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Username</th>
                                            <th>Full Name</th>
                                            <th>Date Submitted</th>
                                            <th>Date of Approval</th>
                                            <th>Approved By - Approved Info</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $count = 0;
                                            foreach ($students_getall as $row) {
                                                # code...
                                                //get the lists of the department clearance done by each students
                                                $clearance_done = $dataRead->clearance_done_by_students_departments($mycon, $row['member_id'], '3', $staffdetails['department_id']);
                                                $approvedby_get = $dataRead->member_getbyid($mycon, $row['approved_by']);
                                            ?>
                                        <tr>
                                            <td><?php echo ++$count ?></td>
                                            <td><?php echo $row['username'] ?></td>
                                            <td><a href="members_edit.php?user=<?php echo $row['username']; ?>"><?php echo $row['lastname']." ".$row['firstname'] ?></a></td>
                                            <td><?php echo formatDate($row['createdon'], "yes"); ?></td>
                                            <td><?php echo formatDate($row['approved_on'], "yes"); ?></td>
                                            <td><?php echo $approvedby_get['lastname']. " ".$approvedby_get['firstname']. " - ". $row['reason']; ?></td>
                                        </tr>
                                        <?php 
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end container -->

                    <?php include_once('inc_footer.php'); ?>

                </div>
                <!-- End #page-right-content -->

            </div>
            <!-- end .page-contentbar -->
        </div>
        <!-- End #page-wrapper -->



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>

        

        <!-- Dashboard init -->
        <script src="assets/pages/jquery.dashboard.js"></script>

        <!-- App Js -->
        <script src="assets/js/jquery.app.js"></script>

        <!-- Datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

        <!-- init -->
        <script src="assets/pages/jquery.datatables.init.js"></script>

        <script src='ajax/ajax.js'></script>
        <script type="text/javascript">
            function showInfo(id)
            {
                $('#showinfo' + id).show(500);
                $('#hideinfo'+id).hide(500);
                $('#showinfotext' + id).hide(500);
                return;
            }

            function hideInfo(id)
            {
                $('#showinfo' + id).hide(500);
                $('#hideinfo'+id).show(500);
                $('#showinfotext' + id).show(500);
                return;
            }

            //confirm the person approval
            function confirmApproval(id)
            {
                approve = $('#approve'+id).val();
                reason = $('#reason'+id).val();
                var msg = '', count = 0;


                $('#confirmapprovedbutton'+id).html("Confirming!");

                if (approve == '')
                {
                    msg += '<br> Please specify the approval status';
                    count += 1;
                }

                if (reason == '')
                {
                    msg += '<br> Please specify the reason for approval';
                    count += 1;
                }

                if (msg != '')
                {
                    $('#result'+id).html("<div class='alert alert-danger alert-dismissable'>" + 
                                                "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>" +
                                                "<i class='fa fa-warning'></i> ** "+count+" error was found, please correct" + msg +
                                            "</div>");
                    return;
                }

                 /* Send the data using post */
    var posting = $.post('admin/actionmanager.php', {
        approve: approve,
        reason: reason,
        id: id,
        command: "clearance_status_approval" 
    });
    
    /* Put the results in a div */
    posting.done(function(data) {
        $("#result"+id).html(data);
        $('#confirmapprovedbutton'+id).html("Confirm!");


                    
    });
       

                return;
            }
        </script>

    </body>
</html>