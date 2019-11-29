<?php

require_once("inc_dbfunctions.php");
require_once("config.php");

$actionmanager = New ActionManager();

if(isset($_POST['command']) && $_POST['command'] == 'members_add')
{
    $actionmanager->members_add();
}
else if(isset($_POST['command']) && $_POST['command'] == 'token_add')
{
    $actionmanager->members_token_add();
}
elseif(isset($_POST['command']) && $_POST['command'] == "memberlogin")
{
    $actionmanager->member_login();
}
elseif(isset($_POST['command']) && $_POST['command'] == "departments_add")
{
    $actionmanager->departments_add();
}
elseif(isset($_POST['command']) && $_POST['command'] == "departments_update")
{
    $actionmanager->departments_update();
}
elseif(isset($_POST['command']) && $_POST['command'] == "staff_add")
{
    $actionmanager->staff_add();
}
elseif(isset($_POST['command']) && $_POST['command'] == "staff_update")
{
    $actionmanager->staff_update();
}
elseif(isset($_POST['command']) && $_POST['command'] == "priority_add")
{
    $actionmanager->priority_add();
}
elseif(isset($_POST['command']) && $_POST['command'] == "priority_update")
{
    $actionmanager->priority_update();
}
elseif(isset($_POST['command']) && $_POST['command'] == "students_add")
{
    $actionmanager->students_add();
}
elseif(isset($_POST['command']) && $_POST['command'] == "students_update")
{
    $actionmanager->students_update();
}
elseif(isset($_POST['command']) && $_POST['command'] == "clearance_add")
{
    $actionmanager->clearance_add();
}
elseif(isset($_POST['command']) && $_POST['command'] == "clearance_status_approval")
{
    $actionmanager->clearance_status_approval();
}
elseif(isset($_POST['command']) && $_POST['command'] == "bankaccountdetails_update")
{
    $actionmanager->bankaccountdetails_update();
}
elseif(isset($_POST['command']) && $_POST['command'] == "members_update")
{
    $actionmanager->members_update();
}
elseif(isset($_POST['command']) && $_POST['command'] == "transfers_add")
{
    $actionmanager->transfers_add();
}
elseif(isset($_POST['command']) && $_POST['command'] == "receives_add")
{
    $actionmanager->receives_add();
}
elseif(isset($_POST['command']) && $_POST['command'] == "transfer_delete")
{
    $actionmanager->transfer_delete();
}
elseif(isset($_POST['command']) && $_POST['command'] == "transfer_refresh")
{
    $actionmanager->transfer_refresh();
}
elseif(isset($_POST['command']) && $_POST['command'] == "transfer_sort")
{
    $actionmanager->transfer_sort();
}
elseif(isset($_POST['command']) && $_POST['command'] == "available_balance")
{
    $actionmanager->available_balance();
}
elseif(isset($_POST['command']) && $_POST['command'] == "extendmatching")
{
    $actionmanager->extendmatching();
}
elseif(isset($_POST['command']) && $_POST['command'] == "evidence_add")
{
    $actionmanager->evidence_add();
}
elseif(isset($_POST['command']) && $_POST['command'] == "payment_confirm")
{
    $actionmanager->payment_confirm();
}
elseif(isset($_POST['command']) && $_POST['command'] == "matching_sort")
{
    $actionmanager->matching_sort();
}
elseif(isset($_POST['command']) && $_POST['command'] == "accountdetails_update")
{
    $actionmanager->accountdetails_update();
}
elseif(isset($_POST['command']) && $_POST['command'] == "memberrestore")
{
    $actionmanager->memberrestore();
}
elseif(isset($_POST['command']) && $_POST['command'] == "recovertoken_add")
{
    $actionmanager->recovertoken_add();
}
elseif(isset($_POST['command']) && $_POST['command'] == "password_update")
{
    $actionmanager->password_update();
}
elseif(isset($_POST['command']) && $_POST['command'] == "uploadfile")
{
    $actionmanager->uploadfile();
}
elseif(isset($_POST['command']) && $_POST['command'] == "unlock_account")
{
    $actionmanager->unlock_account();
}
elseif(isset($_POST['command']) && $_POST['command'] == "falsepayment")
{
    $actionmanager->falsepayment();
}
elseif(isset($_POST['command']) && $_POST['command'] == "testimony_add")
{
    $actionmanager->testimony_add();
}
elseif(isset($_POST['command']) && $_POST['command'] == "news_add")
{
    $actionmanager->news_add();
}
elseif(isset($_POST['command']) && $_POST['command'] == "news_edit")
{
    $actionmanager->news_edit();
}
elseif(isset($_POST['command']) && $_POST['command'] == "testimony_add_admin")
{
    $actionmanager->testimony_add_admin();
}
elseif(isset($_POST['command']) && $_POST['command'] == "testimony_update_admin")
{
    $actionmanager->testimony_update_admin();
}


class ActionManager
{

    function members_add()
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $username = $_POST['username'];
        $phonenumber = $_POST['phonenumber'];
        $email = $_POST['email'];
        $gender = $_POST['sex'];
        $country = $_POST['country'];
        $referral = $_POST['referral'];
        $address = $_POST['address'];
        $captcha = $_POST['captcha'];
        
        $dataRead = New DataRead();
        $dataWrite = New DataWrite();
        $mycon = databaseConnect();

        $count = 0;
        $captchaerror = '';
        $usernameerror = '';
        $emailerror = '';
        $phonenumbererror = '';
        $referralerror = '';
        $referralfinderror = '';
        
         //check if the captcha is eqaual to the session captcha
        if ($captcha != $_SESSION['captcha'])
        {
            $captchaerror = "Incorrect Captcha.";
            echo "<script type='text/javascript'>
                    $('#captchadiv').addClass('has-error');
                    </script>";
             $count = $count + 1;
        }
        //check if username exists
        $username_check = $dataRead->member_getbyusername($mycon, $username);
        if ($username_check != false)
        {
            $usernameerror = "<br>Username already exists.";
            echo "<script type='text/javascript'>
                    $('#usernamediv').addClass('has-error');
                    </script>";
             $count = $count + 1;
        }

        //check if email exists
        $email_check = $dataRead->member_getbyemail($mycon,$email);
        if ($email_check != false)
        {
            $emailerror = "<br> Email already exists.";
            echo "<script type='text/javascript'>
                    $('#emaildiv').addClass('has-error');
                    </script>";           
             $count = $count + 1;
        }

        //check if phonenumber exists
        $phonenumber_check = $dataRead->member_getbyphonenumber($mycon,$phonenumber);
        if ($phonenumber_check != false)
        {
            $phonenumbererror = "<br> Phonenumber already exists.";
            echo "<script type='text/javascript'>
                    $('#phonenumberdiv').addClass('has-error');
                    </script>";           
             $count = $count + 1;
        }
        
        
        if ($referral == $username || $referral == $email)
        {
            $referralerror = "<br> You cannot make yourself a referral.";
            echo "<script type='text/javascript'>
                    $('#referraldiv').addClass('has-error');
                    </script>"; 
             $count = $count + 1;
        }
        //get the member_id of the referral
        if ($referral != null)
        {
          $referral_id = $dataRead->member_referral($mycon, $referral);
            if (!$referral_id)
            {
                $referralfinderror = "Referral could not be found.";
                echo "<script type='text/javascript'>
                    $('#referraldiv').addClass('has-error');
                    </script>"; 
                 $count = $count + 1;
            }  
        }

         if ($count != 0)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **".$count." error was found.<br>".$captchaerror." ".$usernameerror." ".$emailerror." ".$phonenumbererror
                    ." ".$referralerror." ".$referralfinderror.
                "</div>";
            return;
        }
        
        //if all was successful, send a message to the email of the person so as to continue its registrations
        $token = substr(str_shuffle(time()),0,8);
        createCookie("logintoken", $token);
         $sentmessage = "<div class='container'>
                                <p>Hello ".$username.",</p>
                                <p>Enter this token to continue your registration at World Fund Global (WFG): ". $token."  </p>
                                <p><small><em>This message is auto-generated, please do not reply via your email.</em></small></p>
                            </div>";

            $sentmessage = wordwrap($sentmessage,70);
            createCookie("email", $email);
            createCookie("username", $username);
            createCookie("firstname", $firstname);
            createCookie("lastname", $lastname);
            createCookie("phonenumber", $phonenumber);
            createCookie("password", $password);
            createCookie("gender", $gender);
            createCookie("country", $country);
            createCookie("referral", $referral);
            createCookie("captcha", $captcha);
            createCookie("address", $address);

            $message = "A code has been sent to your email ".$email.". Please check to verify your account set up.".$token. ".";
            echo "<div id='successalert'>
                    <div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Almost done!</strong> ".$message."
                    </div>
                    </div>
                    <script type='text/javascript'>
                    $('#registerform').hide(500);
                    </script>
                    <form class='form-horizontal m-t-20' action='admin/actionmanager.php' id='emailverifyform'>
                            <div class='form-group'>
                                <div class='col-xs-12 col-md-12 error' id='tokendiv'>
                                    <input class='form-control' name='token' type='text' id='token' placeholder='Input token*''>
                                </div>
                            </div>
                            <div class='form-group text-center m-t-40'>
                            <div class='col-xs-12'>
                                <div class='col-md-8 col-xs-8'>
                                    <button class='btn btn-success btn-block text-uppercase waves-effect waves-light'  id='emailverifybutton' type='button' onclick='submitVerifyForm(this);'>
                                    Verify Account
                                    </button>
                                </div>
                                <div class='col-md-4 col-xs-4'>
                                    <button class='btn btn-danger btn-block text-uppercase waves-effect waves-light' id='emailclearbutton' onclick='resetToken();' type='button'>
                                    Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class='form-group text-center m-t-40'>
                        <div class='col-xs-12'>
                                <div class='col-md-12 col-xs-12'>
                                    <button class='btn btn-primary btn-block text-uppercase waves-effect waves-light' type='button'  id='backtoregisterbutton' onclick='backtoRegistration();'>
                                    << Back to register form
                                    </button>
                                </div>
                            </div>
                            </div>
                        </form>;
                    </script>";
            return;
            

           /**if (sendEmail($email,"Registration Token - Wealth Fund Global", $sentmessage))
           {
                createCookie("email", $email);
                createCookie("username", $username);
                createCookie("firstname", $firstname);
                createCookie("lastname", $lastname);
                createCookie("password", $password);
                createCookie("gender", $gender);
                createCookie("country", $country);
                createCookie("referral", $referral);
                createCookie("phonenumber", $phonenumber);
                createCookie("captcha", $captcha);
                createCookie("address", $address);

                $message = "A code has been sent to your email ".$email.". Please check to activate your account.";
           
                echo "<div id='successalert'>
                    <div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Almost done!</strong> ".$message."
                    </div>
                    </div>
                    <script type='text/javascript'>
                    $('#registerform').hide(500);
                    </script>
                    <form class='form-horizontal m-t-20' action='admin/actionmanager.php' id='emailverifyform'>
                            <div class='form-group'>
                                <div class='col-xs-12 col-md-12 error' id='emailverifydiv'>
                                    <input class='form-control' name='emailverify' type='text' id='emailverify' value='".getCookie("email")."' disabled>
                                </div>
                            </div>
                            <div class='form-group'>
                                <div class='col-xs-12 col-md-12 error' id='tokendiv'>
                                    <input class='form-control' name='token' type='text' id='token' placeholder='Input token*''>
                                </div>
                            </div>
                            <div class='form-group text-center m-t-40'>
                            <div class='col-xs-12'>
                                <div class='col-md-8 col-xs-8'>
                                    <button class='btn btn-success btn-block text-uppercase waves-effect waves-light'  id='emailverifybutton' type='button' onclick='submitVerifyForm(this);'>
                                    Verify Account
                                    </button>
                                </div>
                                <div class='col-md-4 col-xs-4'>
                                    <button class='btn btn-danger btn-block text-uppercase waves-effect waves-light' id='emailclearbutton' onclick='resetToken();' type='button'>
                                    Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class='form-group text-center m-t-40'>
                        <div class='col-xs-12'>
                                <div class='col-md-12 col-xs-12'>
                                    <button class='btn btn-primary btn-block text-uppercase waves-effect waves-light' type='button'  id='backtoregisterbutton' onclick='backtoRegistration();'>
                                    << Back to register form
                                    </button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </script>";
                    return;
                }
            else
            {
                echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                            <i class='fa fa-warning'></i> ** There was an error sending mail to your email, please check your network properly.
                        </div>";
                return;
            } **/
    
            
                      
    }

    function members_token_add()
    {
        $email = getCookie("email");
        $token = $_POST['token'];

        //check if the token is correct
        if ($token != getCookie('logintoken'))
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> ** Invalid token.
                </div>";
            return;
        }

        //get all the cookies saved
        $firstname = getCookie("firstname");
        $lastname = getCookie("lastname");
        $email = getCookie("email");
        $username = getCookie("username");
        $password = getCookie("password");
        $phonenumber = getCookie("phonenumber");
        $gender = getCookie("gender");
        $country = getCookie("country");
        $referral = getCookie("referral");
        $address = getCookie("address");
        $captcha = getCookie("captcha");

        $expiry = date("Y-m-d H:i:s", strtotime("+ 3 days"));

        $password = generatePassword($password);
        
        $dataRead = New DataRead();
        $dataWrite = New DataWrite();
        $mycon = databaseConnect();
        $count = 0;
        $captchaerror = '';
        $usernameerror = '';
        $phonenumbererror = '';
        $emailerror = '';
        $referralerror = '';
        $referralfinderror = '';
         //check if the captcha is eqaual to the session captcha
        if ($captcha != $_SESSION['captcha'])
        {
            $captchaerror = "Incorrect Captcha.";
            echo "<script type='text/javascript'>
                    $('#captchadiv').addClass('has-error');
                    </script>";
             $count = $count + 1;
        }
        //check if username exists
        $username_check = $dataRead->member_getbyusername($mycon, $username);
        if ($username_check != false)
        {
            $usernameerror = "<br>Username already exists.";
            echo "<script type='text/javascript'>
                    $('#usernamediv').addClass('has-error');
                    </script>";
             $count = $count + 1;
        }

        //check if email exists
        $email_check = $dataRead->member_getbyemail($mycon,$email);
        if ($email_check != false)
        {
            $emailerror = "<br> Email already exists.";
            echo "<script type='text/javascript'>
                    $('#emaildiv').addClass('has-error');
                    </script>";           
             $count = $count + 1;
        }

        //check if phonenumber exists
        $phonenumber_check = $dataRead->member_getbyphonenumber($mycon,$phonenumber);
        if ($phonenumber_check != false)
        {
            $phonenumbererror = "<br> Phonenumber already exists.";
            echo "<script type='text/javascript'>
                    $('#phonenumberdiv').addClass('has-error');
                    </script>";           
             $count = $count + 1;
        }
        
        if ($referral == $username || $referral == $email)
        {
            $referralerror = "<br> You cannot make yourself a referral.";
            echo "<script type='text/javascript'>
                    $('#referraldiv').addClass('has-error');
                    </script>"; 
             $count = $count + 1;
        }
        //get the member_id of the referral
        if ($referral != null)
        {
          $referral_id = $dataRead->member_referral($mycon, $referral);
            if (!$referral_id)
            {
                $referralfinderror = "Referral could not be found.";
                echo "<script type='text/javascript'>
                    $('#referraldiv').addClass('has-error');
                    </script>"; 
                 $count = $count + 1;
            }  
        }

         if ($count != 0)
        {
            echo "<script type='text/javascript'>
                    $('#emailverifyform').hide();
                    $('#registerform').show(500);
                    </script>
            <div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **".$count." error was found.<br>".$captchaerror." ".$usernameerror." ".$emailerror." ".$phonenumbererror." ".$referralerror." ".$referralfinderror.
                "</div>";
            return;
        }


        //start creating the user accounts
        //create the useracccount
        $member_id = '';
        if ($referral == null)
        {
            $member_id = $dataWrite->members_add($mycon,$username,$firstname,$lastname,$password,$email,$phonenumber, $gender,'1',$country,$expiry,$address, $captcha);
        }
        else $member_id = $dataWrite->members_add($mycon,$username,$firstname,$lastname,$password,$email,$phonenumber, $gender,$referral_id['member_id'],$country,$expiry,$address, $captcha);

        if (!$member_id)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Due to security reasons, an error was suspected when saving your information, you will be redirected to the register page to start again.
                </div>
                <script type='text/javascript'>
                    window.setTimeout(function(){
                document.location.href='register.php';
            },2000);
                </script>";
            return;
        }

        //first clear off all the cookies before
        setcookie(str_rot13("firstname"),"",time()-3600);
        setcookie(str_rot13("lastname"),"",time()-3600);
        setcookie(str_rot13("email"),"",time()-3600);
        setcookie(str_rot13("username"),"",time()-3600);
        setcookie(str_rot13("password"),"",time()-3600);
        setcookie(str_rot13("gender"),"",time()-3600);
        setcookie(str_rot13("referral"),"",time()-3600);
        setcookie(str_rot13("country"),"",time()-3600);
        setcookie(str_rot13("address"),"",time()-3600);
        setcookie(str_rot13("captcha"),"",time()-3600);

        //generate my sessions cookies
        createCookie("userid",$member_id);
        createCookie("userlogin","YES");
        createCookie("adminlogin", "NO");
        createCookie("username",$username);
        createCookie("email", $email);
        createCookie("fullname",$lastname." ".$firstname);

        //send message to use that account has been verified
          $sentmessage = "<div class='container'>
                                <p>Hello ".$username.",</p>
                                <p>Account verification completed. Ensure you add your bank account details after you are redirected to your 
                                personalized dashboard. Bank account details can be found in the 'Account Section' of the menu items. 
                                Thank you! </p>
                                <p><small><em>This message is auto-generated, please do not reply via your email</em>M/small></p>
                            </div>";
        $sentmessage = wordwrap($sentmessage,70);
        /**if (sendEmail($email, 'Account verified - Wealth Fund Global', $sentmessage))
        {
             echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Success!</strong> We are preparing your dashboard, please wait...
                    </div>
                    <script type-'text/javascript'>
                    window.setTimeout(function(){
                document.location.href='dashboard.php';
            },2000);
                </script>";
        }
        else {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **An error occurred while sending message, please check your internet connection properly
                </div>";
        }
        **/
        
        echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Success!</strong> We are preparing your dashboard, please wait...
                    </div>
                    <script type-'text/javascript'>
                    window.setTimeout(function(){
                document.location.href='dashboard.php';
            },2000);
                </script>";
        
        return;
        
    }

    function member_login()
    {
        $mycon = databaseConnect();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $type = $_POST['type'];
        $thedate = date("Y-m-d H:i:s");
        
        $dataread = New DataRead();
        $dataWrite = New DataWrite();
        
        //generate the encoded password
        $password = generatePassword($password);
        $count = 0;
        
        
        //find the member details through th 
        //check whether the email and password exists
        $member_get = $dataread->member_getbyusernamepassword($mycon, $username, $password, $type);
        

        if(!$member_get)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Username or password combination is wrong!
                </div>";
            return;
        }
        if ($member_get['status'] == '0')
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Your account is blocked, please contact support!
                </div>";
            return;
        }
        
        if ($member_get['type'] != 0)
        {
            createCookie("userlogin","NO");
            createCookie("adminlogin", "YES");
        }
        else
        {
            createCookie("userlogin","YES");
            createCookie("adminlogin", "NO");
        }
        
        createCookie("userid",$member_get['member_id']);
        createCookie("username",$member_get['username']);
        createCookie("email", $member_get['email']);
        createCookie("fullname",$member_get['firstname']." ".$member_get['lastname']);
        
         echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Login Success!</strong> Preparing the dashboard..
                    </div>
                    <script type-'text/javascript'>
                    window.setTimeout(function(){
                document.location.href='dashboard.php';
            },2000);
                </script>";
        return;
        
    }

    function departments_add()
    {
        $member_id = $_POST['head']; //getCookie("userid");
        $department = $_POST['department'];
        $description = $_POST['description'];

        $dataRead = New DataRead();
        $dataWrite = New DataWrite();
        $mycon = databaseConnect();

        //check if user is signed in by getting the user by member id
        $staffdetails = $dataRead->member_getbyid($mycon, $member_id);
        if (!$staffdetails)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> ** Staff not found, please refresh your page
                </div>";
            return;
        }


        //check if the departments exists
        $department_unique = $dataRead->departments_getbyname($mycon, $department);
        if ($department_unique != false)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **sorry, the department already exists!
                </div>";
            return;
        }

        //add the departments
        $departments_add = $dataWrite->departments_add($mycon, $department, $member_id, $description, '5'); //status 5 shows the head of the department
        if (!$departments_add)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Unable to perform this operation, please try again!
                </div>";
            return;
        }

        echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Success!</strong> Departments has been added.
                    </div>
                    <script type='text/javascript'>
                        $('#department').val('');
                        $('#description').val('');
                        $('#head').val('');
                    </script>";
        return;

        
    }


    function staff_add()
    {
        $department = $_POST['department']; //getCookie("userid");
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $bio = $_POST['bio'];

        $currentuserid = getCookie("userid");

        $dataRead = New DataRead();
        $dataWrite = New DataWrite();
        $mycon = databaseConnect();

        //check if user is signed in by getting the user by member id
        $memberdetails = $dataRead->member_getbyid($mycon, $currentuserid);
        if (!$memberdetails)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> ** Token expired, please login again...
                </div>
                 <script type='text/javascript'>
                    window.setTimeout(function(){
                document.location.href='login.php?logout=yes';
            },2000);
                </script>";
            return;
        }


        //check if the email exists
        $member_email = $dataRead->member_getbyemail($mycon, $email);
        if ($member_email != false)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **sorry, the staff already exists!
                </div>";
            return;
        }

        $password = generatePassword("000000"); //00000 is the default password
        //add the departments
        $members_add = $dataWrite->members_add($mycon, $firstname, $lastname, $password, $email, $department, $bio,'5', '3'); // 5 signifies active staff and 3 signifies staff level
        if (!$members_add)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Unable to perform this operation, please try again!
                </div>";
            return;
        }

        echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Success!</strong> Staff has been added. Default password is '000000'.
                    </div>
                    <script type='text/javascript'>
                        $('#firstname').val('');
                        $('#lastname').val('');
                        $('#email').val('');
                        $('#bio').val('');
                        $('#department').val('');
                    </script>";
        return;

        
    }

    function priority_add()
    {
        $department = $_POST['department']; //getCookie("userid");
        $instruction = $_POST['instruction'];
        $deadline = $_POST['deadline'];


        $currentuserid = getCookie("userid");

        $dataRead = New DataRead();
        $dataWrite = New DataWrite();
        $mycon = databaseConnect();

        //check if user is signed in by getting the user by member id
        $memberdetails = $dataRead->member_getbyid($mycon, $currentuserid);
        if (!$memberdetails)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> ** Token expired, please login again...
                </div>
                 <script type='text/javascript'>
                    window.setTimeout(function(){
                document.location.href='login.php?logout=yes';
            },2000);
                </script>";
            return;
        }


        //check if the department still exists
        $department_check = $dataRead->departments_getbyiddapartments($mycon, $department);
        if (!$department_check)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Sorry, the departments no longer exist. Refreshing...!
                </div>
                <script type='text/javascript'>
                    window.setTimeout(function(){
                document.location.href='clearance_priority.php';
            },2000);
                </script>";
            return;
        }

        //check if the department priority is saved
        $priority_check = $dataRead->priority_getbyiddepartment($mycon, $department);
        if (!$priority_check)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Sorry, the clearance department already exists!
                </div>";
            return;
        }

        
        //add the departments to the priority
        $priority_add = $dataWrite->priority_add($mycon, $department, $instruction, $deadline); 
        if (!$priority_add)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Unable to perform this operation, please try again!
                </div>";
            return;
        }

        echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Success!</strong> clearance department added. Refreshing...
                    </div>
                    <script type='text/javascript'>
                        $('#department').val('');
                        $('#instruction').val('');
                        window.setTimeout(function(){
                document.location.href='clearance_priority.php';
            },2000);
                    </script>";
        return;

        
    }

    function priority_update()
    {
        $department = $_POST['department']; //getCookie("userid");
        $instruction = $_POST['instruction'];
        $priority_id = $_POST['priority_id'];
        $deadline = $_POST['deadline'];


        $currentuserid = getCookie("userid");

        $dataRead = New DataRead();
        $dataWrite = New DataWrite();
        $mycon = databaseConnect();

        //check if user is signed in by getting the user by member id
        $memberdetails = $dataRead->member_getbyid($mycon, $currentuserid);
        if (!$memberdetails)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> ** Token expired, please login again...
                </div>
                 <script type='text/javascript'>
                    window.setTimeout(function(){
                document.location.href='login.php?logout=yes';
            },2000);
                </script>";
            return;
        }


        //check if the department still exists
        $department_check = $dataRead->departments_getbyiddapartments($mycon, $department);
        if (!$department_check)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Sorry, the departments no longer exist. Refreshing...!
                </div>
                <script type='text/javascript'>
                    window.setTimeout(function(){
                document.location.href='clearance_priority.php';
            },2000);
                </script>";
            return;
        }

        //check if the department priority is saved
        $priority_check = $dataRead->priority_getbyidothers($mycon, $department, $priority_id);
        if ($priority_check)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Sorry, the clearance department already exists!
                </div>";
            return;
        }

        if ($deadline == '')
        {
            $deadline = $priority_check['deadline'];
        }

        
        //add the departments to the priority
        $priority_update = $dataWrite->priority_update($mycon, $priority_id, $department, $instruction, $deadline); 
        if (!$priority_update)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Unable to perform this operation, please try again!
                </div>";
            return;
        }

        echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Success!</strong> clearance department updated. Refreshing...
                    </div>
                    <script type='text/javascript'>
                        $('#department').val('');
                        $('#instruction').val('');
                        window.setTimeout(function(){
                document.location.href='clearance_priority.php';
            },2000);
                    </script>";
        return;

        
    }


    function departments_update()
    {
        $member_id = $_POST['head']; //getCookie("userid");
        $department = $_POST['department'];
        $description = $_POST['description'];
        $department_id = $_POST['department_id'];

        $dataRead = New DataRead();
        $dataWrite = New DataWrite();
        $mycon = databaseConnect();

        //check if user is signed in by getting the user by member id
        $staffdetails = $dataRead->member_getbyid($mycon, $member_id);
        if (!$staffdetails)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> ** Staff not found, please refresh your page
                </div>";
            return;
        }


        //check if the departments exists
        $department_unique = $dataRead->departments_getbyothers($mycon, $department, $department_id);
        if ($department_unique != false)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Department already exists, please try again!
                </div>";
            return;
        }

        //add the departments
        $departments_update = $dataWrite->departments_update($mycon, $department, $member_id, $description, '5', $department_id); //status 5 shows the head of the department
        if (!$departments_update)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Unable to perform this operation, please try again!
                </div>";
            return;
        }

        echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Success!</strong> Departments has been updated.
                    </div>
                    <script type='text/javascript'>
                        $('#department').val('');
                        $('#description').val('');
                        $('#head').val('');
                    </script>";
        return;

        
    }

    function staff_update()
    {
        $department = $_POST['department']; //getCookie("userid");
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $member_id = $_POST['member_id'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $bio = $_POST['bio'];

        $dataRead = New DataRead();
        $dataWrite = New DataWrite();
        $mycon = databaseConnect();

        //check if user is signed in by getting the user by member id
        $staffdetails = $dataRead->member_getbyid($mycon, $member_id);
        if (!$staffdetails)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> ** Staff not found, please refresh your page
                </div>";
            return;
        }


        //cehck if the email address exists
        $email_check = $dataRead->member_getbyemail($mycon, $email);
        if (!$email_check)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Staff no longer exists!
                </div>";
            return;
        }
        

        //check if the password is empty or not
        if ($password == '')
        {
            $password = $email_check['password'];
        }
        else 
        {
            $password = generatePassword($password);
        }
        //add the departments
        $staff_update = $dataWrite->members_update($mycon, $member_id, $firstname, $lastname,$password, $bio, $department); //status 5 shows the head of the department
        if (!$staff_update)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Unable to perform this operation, please try again!
                </div>";
            return;
        }

        echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Success!</strong> Staff updated! Refreshing...
                    </div>
                    <script type='text/javascript'>
                        window.setTimeout(function(){
                            document.location.href='staff_view.php';
                        },3000);
                    </script>";
        return;

        
    }

    //add new students
    function students_add()
    {
        $username = $_POST['username']; //getCookie("userid");
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $bio = $_POST['bio'];
        $status = $_POST['status'];

        $currentuserid = getCookie("userid");

        $dataRead = New DataRead();
        $dataWrite = New DataWrite();
        $mycon = databaseConnect();

        //check if user is signed in by getting the user by member id
        $memberdetails = $dataRead->member_getbyid($mycon, $currentuserid);
        if (!$memberdetails)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> ** Token expired, please login again...
                </div>
                 <script type='text/javascript'>
                    window.setTimeout(function(){
                document.location.href='login.php?logout=yes';
            },2000);
                </script>";
            return;
        }


        //check if the username exists
        $member_email = $dataRead->member_getbyusername($mycon, $username);
        if ($member_email != false)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **sorry, the matric number already exists!
                </div>";
            return;
        }

        


        $newpassword = generatePassword($password);
        $mycon->beginTransaction();
        //add the departments
        $members_add = $dataWrite->members_add($mycon, $firstname, $lastname, $newpassword, $username, '0', $bio,'5', '0'); // 5 signifies active staff and 3 signifies staff level
        if (!$members_add)
        {
            $mycon->rollBack();
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Unable to perform this operation, please try again!
                </div>";
            return;
        }

        //get the priority lists
        $priority_get = $dataRead->priority_getone($mycon);
        if (!$priority_get)
        {
            $mycon->rollBack();
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Unable to perform this operation, please try again!
                </div>";
            return;
        }
        //begin the clearance processing
        $clearance_add = $dataWrite->clearance_add($mycon, $members_add, $priority_get['department_id'], $priority_get['priority_id'], '', '5');
        if (!$clearance_add)
        {
            $mycon->rollBack();
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Unable to perform this operation, please try again!
                </div>";
            return;
        }

        $mycon->commit();

        echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Success!</strong> Student has been added. Username is ".$username." and password is ". $password.".
                    </div>
                    <script type='text/javascript'>
                        $('#firstname').val('');
                        $('#lastname').val('');
                        $('#status').val('');
                        $('#bio').val('');
                        $('#username').val('');
                    </script>";
        return;

        
    }

    function students_update()
    {
        $status = $_POST['status']; //getCookie("userid");
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $member_id = $_POST['member_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $bio = $_POST['bio'];

        $dataRead = New DataRead();
        $dataWrite = New DataWrite();
        $mycon = databaseConnect();

        //check if user is signed in by getting the user by member id
        $studentdetails = $dataRead->member_getbyid($mycon, $member_id);
        if (!$studentdetails)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> ** Student not found, please refresh your page
                </div>";
            return;
        }


        //cehck if the usernames exists
        $email_check = $dataRead->member_getbyusername($mycon, $username);
        if (!$email_check)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Student no longer exists!
                </div>";
            return;
        }
        

        //check if the password is empty or not
        if ($password == '')
        {
            $password = $email_check['password'];
        }
        else 
        {
            $password = generatePassword($password);
        }
        //add the departments
        $student_update = $dataWrite->members_update($mycon, $member_id, $firstname, $lastname,$password, $bio, $status); //status 5 shows the head of the department
        if (!$student_update)
        {
            echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <i class='fa fa-warning'></i> **Unable to perform this operation, please try again!
                </div>";
            return;
        }

        echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <strong><i class='fa fa-smile-o'></i> Success!</strong> Student updated! Refreshing...
                    </div>
                    <script type='text/javascript'>
                        window.setTimeout(function(){
                            document.location.href='students_view.php';
                        },2000);
                    </script>";
        return;

        
    }

    //add new students
    function clearance_add()
    {
        foreach ($_FILES['document']['tmp_name'] as $key => $type) {

        }
        $addinfo = $_POST['addinfo']; //getCookie("userid");
        $document = $_FILES['document'];
        $priority_id = $_POST['priority_id'];

        $currentuserid = getCookie("userid");

        $dataRead = New DataRead();
        $dataWrite = New DataWrite();
        $mycon = databaseConnect();

        //check if user is signed in by getting the user by member id
        $memberdetails = $dataRead->member_getbyid($mycon, $currentuserid);
        if (!$memberdetails)
        {
            showAlert("Token expired... please login again");
            openPage("../login.php?logout=yes");
            return;
        }

        if(($document['size']) < 1) 
        {
                showAlert("No document attached. Please attached at least the document required.");
                return;
        }

        

        //check if the username exists
        $clearance_status_get = $dataRead->clearance_status_get($mycon, $currentuserid, $priority_id, '5');
        if (!$clearance_status_get)
        {
            showAlert("The clearance status for this department is already submitted, waiting to be reviewed. Please refresh your page!");
            openPage("../clearance_proceed.php");
            return;
        }

        $mycon->beginTransaction();

        //update the clearance info supplied
        $clearance_update = $dataWrite->clearance_status_update($mycon, $clearance_status_get['clearance_status_id'], $addinfo, '3');
        if (!$clearance_update)
        {
            $mycon->rollBack();
            showAlert("Unable to perform this request. Please try again!1");
            return;
        }
        $ext = pathinfo($document['name'], PATHINFO_EXTENSION);

        //move the document to one of the folder called uploads
        if(strpos(strtoupper($document['type']),"IMAGE") > -1 || strpos(strtoupper($document['type']),"PDF") > -1) 
        {
                move_uploaded_file($document['tmp_name'],"../uploads/{$clearance_status_get['clearance_status_id']}.{$ext}");
        }
        else
        {
            $mycon->rollBack();
            showAlert("Only image and pdf documents is allowed. Please upload appropraitely2");
            return;
        }
        

        //get the next phase of clearance
        //get the priority lists
        $priority_get = $dataRead->priority_getnext($mycon, $clearance_status_get['priority_id']);
        if (!$priority_get)
        {
            $mycon->commit();
            showAlert("All clearance documents have been submitted. Please wait patiently for approval. Thanks");
            openPage("../clearance_proceed.php");
            return;
        }
        //begin the clearance processing
        if ($clearance_status_get['status'] == '4')
        {
            $clearance_add = $dataWrite->clearance_status_update($mycon, $clearance_status_get['clearance_status_id'], $addinfo, '3');
            if (!$clearance_add)
            {
                $mycon->rollBack();
                showAlert("Unable to perform this operation. Please try again!");
                return;
            }
        }
        else
        
        {
            $clearance_add = $dataWrite->clearance_add($mycon, $clearance_status_get['member_id'], $priority_get['department_id'], $priority_get['priority_id'], '', '5');
        if (!$clearance_add)
            {
                $mycon->rollBack();
                showAlert("Unable to perform this operation. Please try again!");
                return;
            }
        }

        $mycon->commit();

        showAlert("This clearance submitted. Please proceed to the next phase!");
        openPage("../clearance_proceed.php");
    }


    function clearance_status_approval()
    {
        $approve = $_POST['approve'];
        $reason = $_POST['reason'];
        $clearance_status_id = $_POST['id'];
        $currentuserid = getCookie('userid');
        $mycon = databaseConnect();

        $dataRead  = New DataRead();
        $dataWrite = New DataWrite();

        //get the details of the staff
        $staffdetails = $dataRead->member_getbyid($mycon,$currentuserid);
        if (!$staffdetails)
        {
            showAlert('You have been logged out. Please login again to continue.');
            openPage('../login.php');
        }

        //get the details of the clearance status
        $clearance_status_get = $dataRead->clearance_status_getbyid($mycon, $clearance_status_id);
        if (!$clearance_status_get)
        {
            showAlert("An error occurred. Please try again or refresh the page.");
            return;
        }

        //fill the values of the clearance and change the clearance status to '4' if it is dispproved or '0' if it is approved.
        $clearance_status_update_approval = '';
        if ($approve == 'Yes') //clearance approved and status is equal to '0'
        {
            $clearance_status_update_approval = $dataWrite->clearance_status_update_approval($mycon, $currentuserid, $clearance_status_id, $approve, $reason, '0');

        }
        else 
        {
            $clearance_status_update_approval = $dataWrite->clearance_status_update_approval($mycon, $currentuserid, $clearance_status_id, $approve, $reason, '4');
        }

        //check if the variable is empty
        if ($clearance_status_update_approval == '')
        {
            showAlert('Unable to update record. Please try again');
            return;
        }

        //updated approval successful
        if ($approve == 'Yes')
        {

            showAlert('Student Clearance Record has been successsfully approved. Thank You.');
            echo "<script type='text/javascript'> 
                    location.reload();
                    </script>";
            return;
        }
        else 
        {
            showAlert('Student Clearance Record has been successsfully disapproved. Please refresh your Thank You.');
            echo "<script type='text/javascript'> 
                    location.reload();
                    </script>";
            return;
        }

    }

}

?>