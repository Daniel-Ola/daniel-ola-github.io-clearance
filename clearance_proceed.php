<?php

include_once('admin/config.php');
include_once('admin/inc_dbfunctions.php');

$dataRead = New DataRead();

$currentuserid = getCookie("userid");

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
                            <div class="col-md-12">
                                <h4 class="m-t-0 header-title text-center">Proceed with School Clearance</h4>
                                <div class="col-sm-12">
                                <div class="timeline">
                                    <article class="timeline-item alt">
                                        <div class="text-right">
                                            <div class="time-show first">
                                                <a href="#" class="btn btn-primary">PROCEED</a>
                                            </div>
                                        </div>
                                    </article>
                                    <?php 
                                        $count = 0;
                                        foreach($priority_get as $row)
                                        {
                                            ++$count;

                                    ?>
                                    <article class="timeline-item <?php if(($count % 2) == 1) echo "alt"; ?>">
                                        <div class="timeline-desk">
                                            <div class="panel">
                                                <div class="timeline-box">
                                                    <span class="arrow-alt"></span>
                                                    <span class="timeline-icon"><i class="mdi mdi-checkbox-blank-circle-outline"></i></span>
                                                    <h4 class=""><?php echo $row['name'] ?> Clearance</h4>
                                                    <p class="timeline-date text-muted"><small>Submitted before: <?php echo formatDate($row['deadline'], "yes"); ?></small></p>
                                                    <p>Information: <?php echo $row['instruction'] ?></p>
                                                    <?php

                                                    //check the clearance status if students can proceed with the clearance
                                                    $clearance_status = $dataRead->clearance_status_getone($mycon, $currentuserid, $row['priority_id']);

                                                    if ($clearance_status['status'] == '5') //5 signifies new clearance just started
                                                    {


                                                    ?>
                                                    <form class="form-horizontal" method="post" role="form" action="admin/actionmanager.php" id="clearance_add<?php echo $count ?>" target="clearanceframe<?php echo $count ?>" enctype="multipart/form-data">
                                                        <iframe name="clearanceframe<?php echo $count ?>" id="clearanceframe<?php echo $count ?>" width="200px" height="70px" frameborder="0"></iframe> <hr style="border: 1px solid grey ;opacity: 0.5 ; display: none;" class="divhr"><span class="badge divspan" style="display: none;">1</span>
                                                        <div id="doc_timeline">
                                                            <div class="form-group img_doc">
                                                                <label class="col-md-3 control-label" for="document<?php echo $count ?>">Upload documents</label>
                                                                <div class="col-md-9">
                                                                    <input type="file" name="document[]" id="document<?php echo $count ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group  info_doc">
                                                                <label class="col-md-3 control-label" for="addinfo<?php echo $count ?>">Additional Info</label>
                                                                <div class="col-md-9">
                                                                    <textarea name="addinfo[]" id="addinfo<?php echo $count ?>" class="form-control"><?php echo $clearance_status['addinfo'] ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <br>
                                                            <br>
                                                            <button class="btn btn-xs btn-primary appendbtn" type="button" id="clearance_addmorebutton<?php echo $count ?>">Attach More</button>
                                                            <input type="text" id="count" value="<?php echo $count ?>" name="" style="display: none;">
                                                            <input type="text" id="clearance_status" value="<?php echo $clearance_status['addinfo'] ?>" name="" style="display: none;">
                                                            <br>
                                                            <br>
                                                        <input type="hidden" name="command" id="command" value="clearance_add" />
                                                        <input type="hidden" name="priority_id" id="priority_id" value="<?php echo $row['priority_id'] ?>" />
                                                        <div class="form-group text-center m-t-10">
                                                            <div class="col-xs-12">
                                                                <button class="btn btn-lg btn-success" type="submit" id="clearance_addbutton">Proceed</button>
                                                                <button class="btn btn-lg btn-danger" type="reset">Clear</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <?php 

                                                        }
                                                        else if ($clearance_status['status'] == '3')
                                                        {

                                                        ?>
                                                        <br>
                                                        <div class="m-b-10">
                                                            <div class="alert alert-icon alert-warning fade in" role="alert">
                                                                <i class="fa fa-warning"></i>
                                                                <strong>Pending Approval!</strong> Please wait patiently for approval.
                                                                message.
                                                            </div>
                                                        </div>
                                                        <?php
                                                            }
                                                            else if ($clearance_status['status'] == '0')
                                                               
                                                        {
                                                             $approved_by = $dataRead->member_getbyid($mycon, $clearance_status['approved_by']);
                                                        ?>
                                                        <br>
                                                        <div class="m-b-10">
                                                            <div class="alert alert-icon alert-warning fade in" role="alert">
                                                                <i class="fa fa-success"></i>
                                                                <strong>Clearance Approved!</strong><br />
                                                                <p> Approved By: <?php echo $approved_by['lastname']. " ". $approved_by['firstname']; ?></p>
                                                                <p style="align: left"> Reason for Approval: <?php echo $clearance_status['reason'] ?></p>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            }

                                                            else if ($clearance_status['status'] == '4')
                                                        {
                                                             $approved_by = $dataRead->member_getbyid($mycon, $clearance_status['approved_by']);
                                                        ?>
                                                        <br>
                                                        <div class="m-b-10">
                                                            <div class="alert alert-icon alert-warning fade in" role="alert">
                                                                <i class="fa fa-success"></i>
                                                                <strong>Clearance Disapproved!</strong><br />
                                                                <p> Approved By: <?php echo $approved_by['lastname']. " ". $approved_by['firstname']; ?></p>
                                                                <p style="align: left"> Reason for Approval: <?php echo $clearance_status['reason'] ?></p>
                                                            </div>
                                                            <form class="form-horizontal" method="post" role="form" action="admin/actionmanager.php" id="clearance_add<?php echo $count ?>" target="clearanceframe<?php echo $count ?>" enctype="multipart/form-data">
                                                        <iframe name="clearanceframe<?php echo $count ?>" id="clearanceframe<?php echo $count ?>" width="200px" height="70px" frameborder="0"></iframe> 
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label" for="document<?php echo $count ?>">Upload documents</label>
                                                            <div class="col-md-9">
                                                                <input type="file" name="document" id="document<?php echo $count ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                        <br>
                                                            <br>
                                                            <button class="btn btn-xs btn-primary" type="button" id="clearance_addmorebutton<?php echo $count ?>">Attach More</button>
                                                            <br>
                                                            <br>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label" for="addinfo<?php echo $count ?>">Additional Info</label>
                                                            <div class="col-md-9">
                                                                <textarea name="addinfo" id="addinfo<?php echo $count ?>" class="form-control"><?php echo $clearance_status['addinfo'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="command" id="command" value="clearance_add" />
                                                        <input type="hidden" name="priority_id" id="priority_id" value="<?php echo $row['priority_id'] ?>" />
                                                        <div class="form-group text-center m-t-10">
                                                            <div class="col-xs-12">
                                                                <button class="btn btn-lg btn-success" type="submit" id="clearance_addbutton">Proceed</button>
                                                                <button class="btn btn-lg btn-danger" type="reset">Clear</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                        </div>
                                                        <?php
                                                            }
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <?php
                                        }
                                    ?>
                                    <article class="timeline-item alt">
                                        <div class="text-right">
                                            <div class="time-show">
                                                <a href="#" class="btn btn-primary">END</a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>

                                
                            </div>
                        </div>

<script src="assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="ajax/append.js"></script>

                        <div class="row">
                            <div class="col-md-12 text-center">
                            <h4 class="m-t-0 header-title">Overall Clearance Status</h4>
                                <div class="col-sm-12">
                                    <?php

                                        //find clearance status with the status 
                                        $clearance_status_all = $dataRead->clearance_status_getstate($mycon, $currentuserid, '5');
                                        if ($clearance_status_all)
                                        {
                                            
                                    ?>
                                <div class="alert alert-icon alert-primary fade in" role="alert">
                                    <i class="mdi mdi-check-all"></i>
                                    <strong>Awaiting Clearance..!</strong> You have not started your clearance. Please start appropriately. Thanks
                                </div>
                                <?php
                                return;
                                }
                                 $clearance_status_all = $dataRead->clearance_status_getstate($mycon, $currentuserid, '3');
                                        if ($clearance_status_all)
                                        {
                                    ?>
                                <div class="alert alert-icon alert-warning fade in" role="alert">
                                    <i class="mdi mdi-check-all"></i>
                                    <strong>Awaiting Approval!</strong> Please wait patiently for approval. Thanks!
                                </div>
                                <?php
                                return;
                                }
                                 $clearance_status_all = $dataRead->clearance_status_getstate($mycon, $currentuserid, '4');
                                        if ($clearance_status_all)
                                        {
                                    ?>
                                <div class="alert alert-icon alert-danger fade in" role="alert">
                                    <i class="mdi mdi-check-all"></i>
                                    <strong>Error detected!</strong> There is an error in one or more of your clearance documents uploads. Please check appropraitely. 
                                </div>
                                <?php
                                return;
                                }

                                $clearance_status_all = $dataRead->clearance_status_getstate($mycon, $currentuserid, '0');
                                        if ($clearance_status_all)
                                        {
                                    ?>
                                <div class="alert alert-icon alert-danger fade in" role="alert">
                                    <i class="mdi mdi-check-all"></i>
                                    <strong>Congrats! All Clearance Successful!</strong> please proceed to print your approval document. <a href="#"> Click Here </a>
                                </div>
                                <?php
                                }


                                ?>
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


        <script src='ajax/ajax.js'></script>
    </body>
</html>