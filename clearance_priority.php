<?php

include_once('admin/config.php');
include_once('admin/inc_dbfunctions.php');

$dataRead = New DataRead();

//get the depatments by the head of departments with a status of 5
$dapartments_get = $dataRead->departments_getbyhead($mycon,'5');

//fetch all clerance prority
$priority_get = $dataRead->priority_getall($mycon);





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
                            <div class="col-lg-8 col-md-offset-2">
                                <div class="card-box">
                                    <h4 class="m-b-20 text-center">Add Department</h4>
                                    <div id='result'></div>
                                        <form class="form-horizontal" role="form" action="admin/actionmanager.php" id="priority_add">
                                            

                                           <div class="form-group">
                                                <label class="col-md-2 control-label" for="department">Assign Department</label>
                                                <div class="col-md-10" id="departmentdiv">
                                                    <select name="department" class="form-control error" id="department">
                                                        <option value=""> Select department </option>
                                                        <?php

                                                            foreach ($dapartments_get as $row) {
                                                                $priorty = $dataRead->priority_getbyiddepartment($mycon, $row['department_id']);
                                                                if ($row['department_id'] != $priorty['department_id'])
                                                                {
                                                        ?>
                                                        <option value="<?php echo $row['department_id'] ?>"><?php echo $row['name'] ?></option>
                                                        <?php
                                                                }

                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="instruction">Instruction</label>
                                                <div class="col-md-10"  id="instructiondiv">
                                                    <textarea class="form-control error" name="instruction" id="instruction" rows="5"></textarea>
                                                </div>
                                            </div>

                                             <div class="form-group">
                                                <label class="col-md-2 control-label" for="deadlinedate">Deadline date</label>
                                                <div class="col-md-10"  id="deadlinedatediv">
                                                    <input type="date" class="form-control" name="deadlinedate" id="deadlinedate">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="deadlinetime">Deadline time</label>
                                                <div class="col-md-10"  id="deadlinetimediv">
                                                    <input type="time" class="form-control" name="deadlinetime" id="deadlinetime">
                                                </div>
                                            </div>
                                            <div class="form-group text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn btn-lg btn-success" type="submit" id="priority_addbutton">Add</button>
                                                <button class="btn btn-lg btn-danger" type="reset">Clear</button>
                                            </div>
                                        </div>
                                        </form>
                                </div>
                            </div> <!-- end col -->

                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <h4 class="m-t-0 header-title">Clearance Priority</h4>

                                <div class="table-responsive m-b-20">
                                    <p class="text-muted font-13 m-b-30">
                                        Priority of how the clearance should be done is ascending order
                                    </p>

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Department</th>
                                            <th>Instruction</th>
                                            <th>Deadline</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            $count = 0;
                                            foreach ($priority_get as $row) {
                                                # code...
                                            
                                            ?>
                                        <tr>
                                            <td><?php echo ++$count ?></td>
                                            <td><a href="departments_edit.php?code=<?php echo $row['department_id'] ?>"><?php echo $row['name'] ?></a></td>
                                            <td><?php echo $row['instruction'] ?></td>
                                            <td style="min-width: 30%"><?php echo formatDate($row['deadline'], "yes"); ?></td>
                                            <td><a href='clearance_priority_edit.php?code=<?php echo $row["priority_id"]; ?>'><button class='btn btn-primary' > <i class='fa fa-edit'></i> </button></a> <a href='javascript:void(0);'><button class='btn btn-danger' onclick='location.href=clearance_priority_view.php?code<?php echo $row["priority_id"] ?>"'><i class='fa fa-trash-o'></i>  </button></a></td>
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


        <!-- Datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

        <!-- init -->
        <script src="assets/pages/jquery.datatables.init.js"></script>

        <!-- App Js -->
        <script src="assets/js/jquery.app.js"></script>

        <script src='ajax/ajax.js'></script>

    </body>
</html>