<?php

$currentuserid = getCookie("userid");
$mycon = databaseConnect();

$dataRead = New dataRead();
$memberdetails = $dataRead->member_getbyid($mycon, $currentuserid);

?>

<!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="">
                       
                    </div>
                </div>

                <!-- Top navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">

                            <!-- Mobile menu button -->
                            <div class="pull-left">
                                <button type="button" class="button-menu-mobile visible-xs visible-sm">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <!-- Top nav left menu -->
                            <ul class="nav navbar-nav hidden-sm hidden-xs top-navbar-items">
                                <li><a href="about.php">About Project</a></li>
                            </ul>

                            <!-- Top nav Right menu -->
                            <ul class="nav navbar-nav navbar-right top-navbar-items-right pull-right">
                                <li class="dropdown top-menu-item-xs">
                                  <li><a href="profile.php"><i class="fa fa-user m-r-10"></i> My Profile</a></li>
                                  <li><a href="login.php?logout=yes"><i class="fa fa-sign-out m-r-10"></i> Logout</a></li>
                                </li>
                            </ul>
                        </div>
                    </div> <!-- end container -->
                </div> <!-- end navbar -->
            </div>
            <!-- Top Bar End -->


            <!-- Page content start -->
            <div class="page-contentbar">

<!--left navigation start-->
                <aside class="sidebar-navigation">
                    <div class="scrollbar-wrapper">
                        <div>
                            <button type="button" class="button-menu-mobile btn-mobile-view visible-xs visible-sm">
                                <i class="mdi mdi-close"></i>
                            </button>
                            <!-- User Detail box -->
                            <div class="user-details">
                                
                                <div class="user-info">
                                    <a href="#"><?php echo getCookie("fullname"); ?></a>
                                    <p class="text-muted m-0"><?php
                                        if ($memberdetails['type'] == '0')
                                        {
                                            echo 'Student';
                                        }
                                        else if ($memberdetails['type'] == '3')
                                        {
                                            $department_get = $dataRead->departments_getbyiddapartments($mycon, $memberdetails['department_id']);
                                            echo $department_get['name'];
                                        }
                                        else echo 'Administrator';

                                     ?></p>
                                </div>
                            </div>
                            <!--- End User Detail box -->

                            <!-- Left Menu Start -->
                            <ul class="metisMenu nav" id="side-menu">
                                <li><a href="index.html"><i class="fa fa-dashboard"></i> Dashboard </a></li>


                                <?php

                                    if ($memberdetails['type'] == '0')
                                    {
                                ?>
                                <li><a href='clearance_proceed.php'><i class='fa fa-paper'></i> Send Clearance Request </a></li>
                                <li><a href='clearance_status.php'><i class='fa fa-paper'></i> View Clearance Status </a></li>
                                <?php

                                }

                                ?>


                                <?php

                                    if ($memberdetails['type'] == '3' && $memberdetails['username'] != 'Admin')
                                    {
                                ?>
                                <li><a href='clearance_all.php'><i class='fa fa-paper'></i> Students Clearance Status</a></li>
                                 <li><a href='clearance_pending.php'><i class='fa fa-paper'></i> View All Pending Clearance</a></li>
                                 <li><a href='clearance_failed.php'><i class='fa fa-paper'></i> View All Disapproved Clearance </a></li>
                                <li><a href='clearance_success.php'><i class='fa fa-paper'></i> View All Approved Clearance </a></li>
                                <?php

                                }

                                ?>

                                <?php

                                    if ($memberdetails['username'] == 'Admin')
                                    {
                                ?>
                                <li>
                                    <a href="javascript: void(0);" aria-expanded="true"><i class="fa fa-school"></i> Clearance Management <span class="fa arrow"></span></a>
                                    <ul class="nav-second-level nav" aria-expanded="true">
                                        <li><a href="clearance_priority.php">Set Clearance Priority</a></li>
                                        <li><a href="clearance_status.php">View Students Clearance Status</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript: void(0);" aria-expanded="true"><i class="fa fa-school"></i> Departments <span class="fa arrow"></span></a>
                                    <ul class="nav-second-level nav" aria-expanded="true">
                                        <li><a href="departments_add.php">Add Department</a></li>
                                        <li><a href="departments_view.php">View All Deparments</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" aria-expanded="true"><i class="fa fa-school"></i> Staff Management <span class="fa arrow"></span></a>
                                    <ul class="nav-second-level nav" aria-expanded="true">
                                        <li><a href="staff_add.php">Add Staffs</a></li>
                                        <li><a href="staff_view.php">View All Staffs</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" aria-expanded="true"><i class="fa fa-school"></i> Students Management <span class="fa arrow"></span></a>
                                    <ul class="nav-second-level nav" aria-expanded="true">
                                        <li><a href="students_add.php">Add Students</a></li>
                                        <li><a href="students_view.php">View All Students</a></li>
                                    </ul>
                                </li>
                                <?php
                                    }
                                    ?>
                            </ul>
                        </div>
                    </div><!--Scrollbar wrapper-->
                </aside>