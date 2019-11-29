<?php

include_once('admin/config.php');
include_once('admin/inc_dbfunctions.php');

$dataRead = New DataRead();


//get the depatments by the head of departments with a type of 3
$staffs_get = $dataRead->staff_getall($mycon, '3');

if (isset($_GET['code']) && $_GET['code'] != '') deleteStaff($_GET['code']);


function deleteStaff($staff_id)
{
    $mycon = databaseConnect();
    $dataRead = New DataRead();
    $dataWrite = New DataWrite();

    //check if the department exists
    $staff_getbyid = $dataRead->member_getbyid($mycon, $staff_id);
    if (!$staff_getbyid)
    {
        showAlert('The staff do not exists. Please refresh your page and try again.');
        openPage('departments_view.php');
        return;
    }

    //if the department exists then delete
    $staff_delete = $dataWrite->members_delete($mycon, $staff_id);
    if (!$staff_delete)
    {
        showAlert('Unable to delete the staff, please try again later.');
        return;
    }

    showAlert('Staff successfully deleted. Thank You!');
    openPage('staff_view.php');
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
                                <h4 class="m-t-0 header-title">List of Staffs</h4>

                                <div class="table-responsive m-b-20">
                                    <p class="text-muted font-13 m-b-30">
                                        List of all the staffs and their respective departments
                                    </p>

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Fullname</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $count = 0;
                                            foreach ($staffs_get as $row) {
                                                # code...
                                            
                                            ?>
                                        <tr>
                                            <td><?php echo ++$count ?></td>
                                            <td><?php echo $row['firstname']." ".$row['lastname'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><a href="departments_edit.php?code=<?php echo $row['department_id'] ?>"><?php echo $row['name'] ?></a></td>
                                            <td><?php echo formatDate($row['createdon'], "yes"); ?></td>
                                            <td><a href='staff_edit.php?code=<?php echo $row["member_id"]; ?>&type=<?php echo $row["type"]; ?>'><button class='btn btn-primary' > <i class='fa fa-edit'></i> </button></a> <a href='javascript:void(0);'><button class='btn btn-danger' onclick="if(confirm('Are you sure you want to delete this staff?')) location.href='staff_view.php?code=<?php echo $row["member_id"] ?>'"><i class='fa fa-trash-o'></i>   </button></a></td>
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

    </body>
</html>