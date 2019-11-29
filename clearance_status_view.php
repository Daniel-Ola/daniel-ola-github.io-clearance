<?php

include_once('admin/config.php');
include_once('admin/inc_dbfunctions.php');

$dataRead = New DataRead();


//get the lists of the students in the database
$students_getall = $dataRead->members_getbystudenttype($mycon, '0'); //0 signifies students

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
                                <h4 class="m-t-0 header-title">Clearance status</h4>

                                <div class="table-responsive m-b-20">
                                    <p class="text-muted font-13 m-b-30">
                                        Status of your clearance for each departments
                                    </p>

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Username</th>
                                            <th>Full Name</th>
                                            <th>Date Registered</th>
                                            <th>Department Clearance Done</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $count = 0;
                                            foreach ($students_getall as $row) {
                                                # code...
                                                //get the lists of the department clearance done by each students
                                                $clearance_done = $dataRead->clearance_done_by_students($mycon, $row['member_id'], '3');
                                            ?>
                                        <tr>
                                            <td><?php echo ++$count ?></td>
                                            <td><?php echo $row['username'] ?></td>
                                            <td><a href="members_edit.php?user=<?php echo $row['username']; ?>"><?php echo $row['lastname']." ".$row['firstname'] ?></a></td>
                                            <td><?php echo formatDate($row['createdon'], "yes"); ?></td>
                                            <td>
                                                <?php
                                                    if ($clearance_done == null)
                                                    {
                                                        echo "Not Yet Started!";
                                                    }

                                                ?>
                                                <ul>
                                                <?php 

                                                    //get the list of the department done by the students
                                                    foreach($clearance_done as $clear)
                                                    {
                                                ?>
                                                    <li><?php echo $clear['name']; ?></li>
                                                <?php
                                                    }
                                                ?>

                                                </ul>
                                            </td>
                                            <td><a href='clearance_status_view.php?user=<?php echo $row["username"]; ?>'><button class='btn btn-primary' > <i class='fa fa-edit'></i> View More</button></a></td>
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