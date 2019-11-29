<?php

include_once('admin/config.php');
include_once('admin/inc_dbfunctions.php');

$dataRead = New DataRead();



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
                                    <h4 class="m-b-20 text-center">Add New Students</h4>
                                    <div id='result'></div>
                                        <form class="form-horizontal" role="form" action="admin/actionmanager.php" id="students_add">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="username">Matric Number</label>
                                                <div class="col-md-10" id="usernamediv">
                                                    <input type="text" name="username" id="username" onkeyup="generatePassword()" class="form-control error" value="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="firstname">First name</label>
                                                <div class="col-md-10" id="firstnamediv">
                                                    <input type="text" name="firstname" id="firstname" onkeyup="generatePassword();" class="form-control error" value="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="lastname">Last name</label>
                                                <div class="col-md-10"  id="lastnamediv">
                                                    <input type="text" name="lastname" id="lastname" class="form-control error" value="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="lastname">Change Password (automatically generated)</label>
                                                <div class="col-md-10"  id="passworddiv">
                                                    <input type="text" name="password" id="password" class="form-control error" value="">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="bio">Bio</label>
                                                <div class="col-md-10"  id="biodiv">
                                                    <textarea class="form-control error" name="bio" id="bio" rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2 control-label" for="status">Enable/ Disable</label>
                                                <div class="col-md-10" id="statusdiv">
                                                    <select name="status" class="form-control error" id="status">
                                                        <option value=""> Select one..</option>
                                                        <option value="0"> Disable</option>
                                                        <option value="5"> Enable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn btn-lg btn-success" type="submit" id="students_addbutton">Add</button>
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

        <script type="text/javascript">
            function generatePassword()
            {
                firstname = $('#firstname').val();
                username = $('#username').val();

                setpassword = firstname.charAt(0) + username.substring(0, 6) + firstname.substring(1);
                $('#password').val(setpassword);

                return;
            }
        </script>

    </body>
</html>