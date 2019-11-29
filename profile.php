<?php

include_once('admin/config.php');
include_once('admin/inc_dbfunctions.php');

$dataRead = New DataRead();
$currentuserid = getCookie('userid');
//


//get the details of the departments
$members_get = $dataRead->member_getbyid($mycon, $currentuserid);




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
                                    <h4 class="m-b-20 text-center">Edit Your details</h4>
                                    <div id='result'></div>
                                    <iframe name="actionframe" id="actionframe" height="1px" width="1px"></iframe>
                                        <form class="form-horizontal" role="form" action="admin/actionmanager.php" id="your_update" target="actionframe">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="username">Username</label>
                                                <div class="col-md-10" id="usernamediv">
                                                    <input type="text" name="username" id="username" class="form-control error" value="<?php echo $members_get['username'] ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="firstname">First name</label>
                                                <div class="col-md-10" id="firstnamediv">
                                                    <input type="text" name="firstname" id="firstname" class="form-control error" value="<?php echo $members_get['firstname'] ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="lastname">Last name</label>
                                                <div class="col-md-10"  id="lastnamediv">
                                                    <input type="text" name="lastname" id="lastname" class="form-control error" value="<?php echo $members_get['lastname'] ?>" >
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="bio">Bio</label>
                                                <div class="col-md-10"  id="biodiv">
                                                    <textarea class="form-control error" name="bio" id="bio" rows="5"><?php echo $members_get['bio'] ?></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img src="assets/images/user.png" class="img-circle" height="100px" />
                                                </div>
                                                <br><br>
                                                <label class="col-md-2 control-label" for="password">Change Picture</label>
                                                <div class="col-md-10"  id="picturediv">
                                                    <input type="file" name="picture" id="picture" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="password">Change Password</label>
                                                <div class="col-md-10"  id="passworddiv">
                                                    <input type="password" name="password" id="password" class="form-control error" placeholder="leave empty if no changes">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="confirmpassword">Confirm Password</label>
                                                <div class="col-md-10"  id="confirmpassworddiv">
                                                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control error" placeholder="repeat password again">
                                                </div>
                                            </div>
                                            <input type='hidden' name="command" value="your_update" id="command" />
                                            <div class="form-group text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn btn-lg btn-success" type="submit" id="">Update</button>
                                                <button class="btn btn-lg btn-danger" type="reset">Clear</button>
                                            </div>
                                        </div>
                                        </form>
                                </div>
                            </div> <!-- end col -->

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