<?php
include_once('admin/config.php');

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

        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-6">

                        <div class="wrapper-page">

                            <div class="m-t-40 card-box">
                                <div class="text-center">
                                    <h2 class="text-uppercase m-t-0 m-b-30">
                                        <a href="login.php" class="text-primary">
                                            <img src="assets/images/school.jpg" alt="school_logo" class="img-round" height="100px"><br>
                                            <span><i class='fa fa-lock'></i>smart Login</span>
                                        </a>
                                    </h2>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content">
                                    <div id='result'></div>
                                    <form class="form-horizontal" action="admin/actionmanager.php" role="form" id="loginform">

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12" id="usernamediv">
                                                <label for="username">username</label>
                                                <input class="form-control" type="text" name="username" id="usernmame">
                                            </div>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12" id="passworddiv">
                                                <label for="password">Password</label>
                                                <input class="form-control" type="password" id="password" name="password">
                                            </div>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12" id="typediv">
                                                <label for="password">Login as:</label>
                                                <select name="type" class="form-control" id="type">
                                                  <option value="">Login as.... </option>
                                                  <option value="0">Student</option>
                                                  <option value="3">Staff</option>
                                                </select>
                                            </div>
                                        </div>

                                    
                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn btn-lg btn-success btn-block" type="submit" id="loginbutton">Login</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->

                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>

        <!-- App Js -->
        <script src="assets/js/jquery.app.js"></script>


        <script src="ajax/ajax.js"></script>

    </body>
</html>