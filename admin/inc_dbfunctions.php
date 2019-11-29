<?php
    require_once("config.php");
$mycon = databaseConnect();



class DataWrite
{   
    //create the useracccount
    function members_add($mycon, $firstname, $lastname, $password, $email, $department, $bio, $status, $type) //
    {
      $thedate = date("Y-m-d H:i:s");
      $sql = "INSERT INTO `members` SET `username` = :username
          ,`firstname` = :firstname
          ,`lastname` = :lastname
          ,`password` = :password
          ,`email` = :email
          ,`department_id` = :department_id
          ,`bio` = :bio
          ,`type` = :type
          ,`createdon` = :createdon
          ,`status` = :status";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":username", $email, PDO::PARAM_STR);
      $myrec->bindValue(":firstname", $firstname,PDO::PARAM_STR);
      $myrec->bindValue(":lastname", $lastname,PDO::PARAM_STR);
      $myrec->bindValue(":password", $password,PDO::PARAM_STR);
      $myrec->bindValue(":email", $email,PDO::PARAM_STR);
      $myrec->bindValue(":department_id", $department,PDO::PARAM_STR);
      $myrec->bindValue(":bio", $bio,PDO::PARAM_STR);
      $myrec->bindValue(":createdon", $thedate,PDO::PARAM_STR);
      $myrec->bindValue(":type", $type,PDO::PARAM_STR);
      $myrec->bindValue(":status", $status,PDO::PARAM_STR);// status set to 0 to show Passive member
      $myrec->execute();
      
      if ($myrec->rowCount() < 1) return false;
      
      return $mycon->lastInsertId();
      
    }

    function departments_add($mycon, $department, $member_id, $description, $status)
    {
       $thedate = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `department` SET `name` = :name
          ,`member_id` = :member_id
          ,`description` = :description
          ,`status` = :status
          , `createdon` = :createdon";
          $myrec = $mycon->prepare($sql);
          $myrec->bindValue(":name", $department);
          $myrec->bindValue(":member_id", $member_id);
          $myrec->bindValue(":description", $description);
          $myrec->bindValue(":status", $status);
          $myrec->bindValue(":createdon", $thedate);
          $myrec->execute();
          
          if ($myrec->rowCount() < 1) return false;
          
          return $mycon->lastInsertId();
       
    }


    function departments_update($mycon, $department, $member_id, $description, $status, $department_id)
    {
       $thedate = date("Y-m-d H:i:s");
        $sql = "UPDATE `department` SET `name` = :name
          ,`member_id` = :member_id
          ,`description` = :description
          ,`status` = :status
          , `createdon` = :createdon WHERE `department_id` = :department_id";
          $myrec = $mycon->prepare($sql);
          $myrec->bindValue(":name", $department);
          $myrec->bindValue(":member_id", $member_id);
          $myrec->bindValue(":department_id", $department_id);
          $myrec->bindValue(":description", $description);
          $myrec->bindValue(":status", $status);
          $myrec->bindValue(":createdon", $thedate);
          
          
          if (!$myrec->execute()) return false;
          
          return true;
       
    }

    //delete the new departments
    function departments_delete($mycon, $department_id)
    {
      $sql = "DELETE FROM `department` WHERE `department_id` = :department_id LIMIT 1";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":department_id", $department_id);
      $myrec->execute();

      if ($myrec->rowCount() < 1) return false;

      return true;
    }


    //delete the member by id
    function members_delete($mycon, $member_id)
    {
      $sql = "DELETE FROM `members` WHERE `member_id` = :member_id LIMIT 1";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id);
      $myrec->execute();

      if ($myrec->rowCount() < 1) return false;

      return true;
    }

    //add to the departments
    function priority_add($mycon, $department_id, $instruction, $deadline)
    {
      $thedate = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `priority` SET `department_id` = :department_id
          ,`instruction` = :instruction
          ,`deadline` = :deadline
          , `createdon` = :createdon";
          $myrec = $mycon->prepare($sql);
          $myrec->bindValue(":department_id", $department_id);
          $myrec->bindValue(":instruction", $instruction);
          $myrec->bindValue(":deadline", $deadline);
          $myrec->bindValue(":createdon", $thedate);
          $myrec->execute();
          
          if ($myrec->rowCount() < 1) return false;
          
          return $mycon->lastInsertId();
    }



//update the priority
    function priority_update($mycon, $priority_id, $department_id, $instruction, $deadline)
    {
        $sql = "UPDATE `priority` SET `department_id` = :department_id
          ,`instruction` = :instruction, `deadline` = :deadline WHERE `priority_id` = :priority_id";
          $myrec = $mycon->prepare($sql);
          $myrec->bindValue(":department_id", $department_id);
          $myrec->bindValue(":instruction", $instruction);
          $myrec->bindValue(":deadline", $deadline);
          $myrec->bindValue(":priority_id", $priority_id);
          
          
          if (!$myrec->execute()) return false;
          
          return true;
    }

    //add to the clearance status
    function clearance_add($mycon, $member_id, $department_id, $priority_id, $info, $status)
    {
      $thedate = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `clearance_status` SET `member_id` = :member_id
          ,`department_id` = :department_id
          ,`priority_id` = :priority_id
          ,`addinfo` = :addinfo
          ,`status` = :status
          , `createdon` = :createdon";
          $myrec = $mycon->prepare($sql);
          $myrec->bindValue(":member_id", $member_id);
          $myrec->bindValue(":department_id", $department_id);
          $myrec->bindValue(":priority_id", $priority_id);
          $myrec->bindValue(":addinfo", $info);
          $myrec->bindValue(":status", $status);
          $myrec->bindValue(":createdon", $thedate);
          $myrec->execute();
          
          if ($myrec->rowCount() < 1) return false;
          
          return $mycon->lastInsertId();
    }

    //update the clearance status
    function clearance_status_update($mycon, $clearance_status_id, $addinfo, $status)
    {
      $thedate = date("Y-m-d H:i:s");
        $sql = "UPDATE `clearance_status` SET `addinfo` = :addinfo, 
        `updatedon` = :updatedon 
        ,`status` = :status WHERE `clearance_status_id` = :clearance_status_id";
          $myrec = $mycon->prepare($sql);
          $myrec->bindValue(":addinfo", $addinfo);
          $myrec->bindValue(":clearance_status_id", $clearance_status_id);
          $myrec->bindValue(":status", $status);
          $myrec->bindValue(":updatedon", $thedate);
          
          
          if (!$myrec->execute()) return false;
          
          return true;
    }


    //update the clearance status
    function clearance_status_update_approval($mycon, $approved_by, $clearance_status_id, $approve, $reason, $status)
    {
      $thedate = date("Y-m-d H:i:s");
        $sql = "UPDATE `clearance_status` SET `approved_by` = :approved_by, 
        `approve` = :approve 
        ,`reason` = :reason
        ,`status` = :status
        ,`approved_on` = :approved_on WHERE `clearance_status_id` = :clearance_status_id";
          $myrec = $mycon->prepare($sql);
          $myrec->bindValue(":approved_by", $approved_by);
          $myrec->bindValue(":approve", $approve);
          $myrec->bindValue(":reason", $reason);
          $myrec->bindValue(":clearance_status_id", $clearance_status_id);
          $myrec->bindValue(":status", $status);
          $myrec->bindValue(":approved_on", $thedate);
          
          
          if (!$myrec->execute()) return false;
          
          return true;
    }



    //update the bank accounts details
    function accountdetails_update($mycon, $bankaccountname,$bankaccountnumber, $bankname, $accountdetail_id)
    {
           $thedate = date("Y-m-d H:i:s");
            $sql = "UPDATE `accountdetails` SET
              `bankname` = :bankname
              ,`bankaccountname` = :bankaccountname
              ,`bankaccountnumber` = :bankaccountnumber
              ,`createdon` = :createdon WHERE `accountdetail_id` = :accountdetail_id";
          $myrec = $mycon->prepare($sql);
          $myrec->bindValue(":accountdetail_id", $accountdetail_id);
          $myrec->bindValue(":bankname", $bankname);
          $myrec->bindValue(":bankaccountname", $bankaccountname);
          $myrec->bindValue(":bankaccountnumber", $bankaccountnumber);
          $myrec->bindValue(":createdon", $thedate);
          
          if (!$myrec->execute()) return false;
          
          return true;
       
    }

    //update the members
    function members_update($mycon, $member_id, $firstname, $lastname, $password, $bio, $department)
    {
        $thedate = date("Y-m-d H:i:s");
        $sql = "UPDATE `members` SET `firstname` = :firstname
            ,`lastname` = :lastname
            ,`password` = :password
            ,`bio` = :bio
            ,`updatedon` = :updatedon
            ,`department_id` = :department_id WHERE `member_id` = :member_id";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->bindValue(":firstname", $firstname);
        $myrec->bindValue(":lastname", $lastname);
        $myrec->bindValue(":password", $password);
        $myrec->bindValue(":bio", $bio);
        $myrec->bindValue(":department_id", $department);
        $myrec->bindValue(":updatedon", $thedate);
        
        if (!$myrec->execute()) return false;
        
        return true;
        
    }

    function bankaccounts_deleteall($mycon, $member_id)
    {
      $sql = "DELETE FROM `accountdetails` WHERE `member_id` = :member_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->execute();
      
      if ($myrec->rowCount() < 1) return false;

      return true;
    }

    function bankaccounts_delete($mycon, $member_id, $accountdetail_id)
    {
      $sql = "DELETE FROM `accountdetails` WHERE `member_id` = :member_id AND `accountdetail_id` = :accountdetail_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->bindValue(":accountdetail_id", $accountdetail_id, PDO::PARAM_STR);
      $myrec->execute();
      
      if ($myrec->rowCount() < 1) return false;

      return true;
    }


    //add to onations
    function donation_add($mycon,$amount,$currentuserid,$readydonation_ph,$readydonation_gh,$accountdetail_id,$firsttime, $firststatus)
    {
        $thedate = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `donations` SET `donation_ph` = :donation_ph
            ,`member_id` = :member_id
            ,`readydonation_ph` = :readydonation_ph
            ,`readydonation_gh` = :readydonation_gh
            ,`accountdetail_id` = :accountdetail_id
            ,`firsttime` = :firsttime
            ,`status` = :status
            ,`firstph` = :firstph
            ,`createdon` = :createdon";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $currentuserid);
        $myrec->bindValue(":donation_ph", $amount);
        $myrec->bindValue(":readydonation_ph", $readydonation_ph);
        $myrec->bindValue(":readydonation_gh", $readydonation_gh);
        $myrec->bindValue(":accountdetail_id", $accountdetail_id);
        $myrec->bindValue(":firsttime", $firsttime);
        $myrec->bindValue(":firstph", $firststatus);
        $myrec->bindValue(":createdon", $thedate);
        $myrec->bindValue(":status", '5');// status set to 5 to show New donation
        $myrec->execute();
        
        if($myrec->rowCount() < 1) return false;
        
        return $mycon->lastInsertId();
        
        
    }

     //add to donations made by admin
    function donation_add_admin($mycon,$amount,$currentuserid,$readydonation_ph,$readydonation_gh,$accountdetail_id,$firsttime, $firststatus, $createdon)
    {
        $sql = "INSERT INTO `donations` SET `donation_ph` = :donation_ph
            ,`member_id` = :member_id
            ,`readydonation_ph` = :readydonation_ph
            ,`readydonation_gh` = :readydonation_gh
            ,`accountdetail_id` = :accountdetail_id
            ,`firsttime` = :firsttime
            ,`status` = :status
            ,`matchedstatus` = :matchedstatus
            ,`firstph` = :firstph
            ,`createdon` = :createdon";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $currentuserid);
        $myrec->bindValue(":donation_ph", $amount);
        $myrec->bindValue(":readydonation_ph", $readydonation_ph);
        $myrec->bindValue(":readydonation_gh", $readydonation_gh);
        $myrec->bindValue(":accountdetail_id", $accountdetail_id);
        $myrec->bindValue(":firsttime", $firsttime);
        $myrec->bindValue(":firstph", $firststatus);
        $myrec->bindValue(":matchedstatus", '5'); //macthed status set to 5 to show already matched status
        $myrec->bindValue(":createdon", $createdon);
        $myrec->bindValue(":status", '0');// status set to 0 to show confirmed donation
        $myrec->execute();
        
        if($myrec->rowCount() < 1) return false;
        
        return $mycon->lastInsertId();
        
        
    }

    //delete the provide help request
    function donationrequest_delete($mycon, $donation_id)
    {
        $sql = "DELETE FROM `donations` WHERE `donation_id` = :donation_id AND `status` = :status";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":donation_id", $donation_id);
        $myrec->bindValue(":status", 5); //shows active donations
        $myrec->execute();
        
        if($myrec->rowCount() < 1) return false;
        
        return true;
 
    }

    //update the growth colum of the donations
    function donations_growthupdate($mycon, $donation_id, $growth)
    {
      $sql = "UPDATE `donations` SET `growth` = :growth WHERE `donation_id` = :donation_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":growth", $growth, PDO::PARAM_STR);
      $myrec->bindValue(":donation_id", $donation_id, PDO::PARAM_STR);

      if (!$myrec->execute()) return false;

      return true;

    }

    function donation_add_gh($mycon,$amount,$currentuserid,$readydonation_ph,$readydonation_gh,$accountdetail_id,$firsttime)
    {
        $thedate = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `donations` SET `donation_gh` = :donation_gh
            ,`member_id` = :member_id
            ,`readydonation_ph` = :readydonation_ph
            ,`readydonation_gh` = :readydonation_gh
            ,`accountdetail_id` = :accountdetail_id
            ,`firsttime` = :firsttime
            ,`status` = :status
            ,`createdon` = :createdon";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $currentuserid);
        $myrec->bindValue(":donation_gh", $amount);
        $myrec->bindValue(":readydonation_ph", $readydonation_ph);
        $myrec->bindValue(":readydonation_gh", $readydonation_gh);
        $myrec->bindValue(":accountdetail_id", $accountdetail_id);
        $myrec->bindValue(":firsttime", $firsttime);
        $myrec->bindValue(":createdon", $thedate);
        $myrec->bindValue(":status", '5');// status set to 5 to show Active receive fund requests
        $myrec->execute();
        
        if($myrec->rowCount() < 1) return false;
        
        return $mycon->lastInsertId();
        
        
    }

    //add new to the donations receivable
    function donationsreceivable_add($mycon, $member_id, $amount, $withdrawn, $balance)
    {
      $thedate = date("Y-m-d H:i:s");
      $sql = "INSERT INTO `donationsreceivable` SET
              `member_id` = :member_id
              ,`amount` = :amount
              ,`withdrawn` = :withdrawn
              ,`balance` = :balance
              ,`thedate` = :thedate";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->bindValue(":amount", $amount, PDO::PARAM_STR);
      $myrec->bindValue(":withdrawn", $withdrawn, PDO::PARAM_STR);
      $myrec->bindValue(":balance", $balance, PDO::PARAM_STR);
      $myrec->bindValue(":thedate", $thedate, PDO::PARAM_STR);
      $myrec->execute();

      if ($myrec->rowCount() < 1) return false;

      return $mycon->lastInsertId();
    }

    //add new to the donations receivable
    function donationsreceivable_updatezero($mycon, $member_id, $amount, $balance, $withdrawn)
    {
      $thedate = date("Y-m-d H:i:s");
      $sql = "UPDATE `donationsreceivable` SET
              `amount` = :amount
              ,`withdrawn` = :withdrawn
              ,`balance` = :balance
              ,`thedate` = :thedate WHERE `member_id` = :member_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->bindValue(":amount", $amount, PDO::PARAM_STR);
      $myrec->bindValue(":withdrawn", $withdrawn, PDO::PARAM_STR);
      $myrec->bindValue(":balance", $balance, PDO::PARAM_STR);
      $myrec->bindValue(":thedate", $thedate, PDO::PARAM_STR);

      if (!$myrec->execute()) return false;

      return true;
    }

    //add new to the donations receivable
    function donationsreceivable_update($mycon, $member_id, $amount, $balance)
    {
      $thedate = date("Y-m-d H:i:s");
      $sql = "UPDATE `donationsreceivable` SET
              `amount` = :amount
              ,`balance` = :balance
              ,`thedate` = :thedate WHERE `member_id` = :member_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->bindValue(":amount", $amount, PDO::PARAM_STR);
      $myrec->bindValue(":balance", $balance, PDO::PARAM_STR);
      $myrec->bindValue(":thedate", $thedate, PDO::PARAM_STR);

      if (!$myrec->execute()) return false;

      return true;
    }

    function donationsreceivable_updatewithdrawn($mycon,$member_id,$amount,$balance)
    {
      $thedate = date("Y-m-d H:i:s");
      $sql = "UPDATE `donationsreceivable` SET
              `withdrawn` = :withdrawn
              ,`balance` = :balance
              ,`thedate` = :thedate WHERE `member_id` = :member_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->bindValue(":withdrawn", $amount, PDO::PARAM_STR);
      $myrec->bindValue(":balance", $balance, PDO::PARAM_STR);
      $myrec->bindValue(":thedate", $thedate, PDO::PARAM_STR);
      

      if (!$myrec->execute()) return false;

      return true;
    }

    //matching add
    function matching_add($mycon,$receive_id,$transfer_id, $receivefund_id,$transferfund_id,$amount,$accountdetail_id,$expirydate)
    {
        $thedate = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `matching` SET `receive_id` = :receive_id
            ,`transfer_id` = :transfer_id
            ,`amount` = :amount
            ,`thedate` = :thedate
            ,`expirydate` = :expirydate
            ,`status` = :status
            ,`accountdetail_id` = :accountdetail_id
            ,`transferfund_id` = :transferfund_id
            ,`receivefund_id` = :receivefund_id";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":receive_id", $receive_id);
        $myrec->bindValue(":transfer_id", $transfer_id);
        $myrec->bindValue(":amount", $amount);
        $myrec->bindValue(":accountdetail_id", $accountdetail_id);
        $myrec->bindValue(":transferfund_id", $transferfund_id);
        $myrec->bindValue(":receivefund_id", $receivefund_id);
        $myrec->bindValue(":expirydate", $expirydate);
        $myrec->bindValue(":thedate", $thedate);
        $myrec->bindValue(":status", '5');// status set to 5 to show paired matched donations
        $myrec->execute();
        
        if($myrec->rowCount() < 1) return false;
        
        return $mycon->lastInsertId();
  
    }


    function donationsupdatestatus($mycon, $donation_id, $status, $matchedstatus)
    {
      $sql = "UPDATE `donations` SET
              `status` = :status
              ,`matchedstatus` = :matchedstatus WHERE `donation_id` = :donation_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":status", $status, PDO::PARAM_STR);
      $myrec->bindValue(":matchedstatus", $matchedstatus, PDO::PARAM_STR);
      $myrec->bindValue(":donation_id", $donation_id, PDO::PARAM_STR);

      if (!$myrec->execute()) return false;

      return true;
    }

    function donationsupdatestatus_withtestimony($mycon, $donation_id, $status, $matchedstatus, $testimonystatus)
    {
      $sql = "UPDATE `donations` SET
              `status` = :status
              ,`matchedstatus` = :matchedstatus
              ,`testimonialstatus` = :testimonialstatus WHERE `donation_id` = :donation_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":status", $status, PDO::PARAM_STR);
      $myrec->bindValue(":matchedstatus", $matchedstatus, PDO::PARAM_STR);
      $myrec->bindValue(":donation_id", $donation_id, PDO::PARAM_STR);
      $myrec->bindValue(":testimonialstatus", $testimonystatus, PDO::PARAM_STR);

      if (!$myrec->execute()) return false;

      return true;
    }

    //update the leftover
    function leftoverupdate($mycon, $donation_id, $leftover, $leftover_id)
    {
      $thedate = date("Y-m-d H:i:s");
      $sql = "UPDATE `donations` SET
              `leftover` = :leftover
              ,`leftover_id` = :leftover_id WHERE `donation_id` = :donation_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":leftover", $leftover, PDO::PARAM_STR);
      $myrec->bindValue(":leftover_id", $leftover_id, PDO::PARAM_STR);
      $myrec->bindValue(":donation_id", $donation_id, PDO::PARAM_STR);

      if (!$myrec->execute()) return false;

      return true;
    }

    function updateMatchingExpiryDate($mycon, $matching_id, $expirydate)
    {
      $sql = "UPDATE `matching` SET
              `expirydate` = :expirydate WHERE `matching_id` = :matching_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":expirydate", $expirydate, PDO::PARAM_STR);
      $myrec->bindValue(":matching_id", $matching_id, PDO::PARAM_STR);

      if (!$myrec->execute()) return false;

      return true;
    }

     function updateMatchingStatus($mycon, $matching_id, $status)
    {
      $sql = "UPDATE `matching` SET
              `status` = :status WHERE `matching_id` = :matching_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":status", $status, PDO::PARAM_STR);
      $myrec->bindValue(":matching_id", $matching_id, PDO::PARAM_STR);

      if (!$myrec->execute()) return false;

      return true;
    }

     function members_updatestatus($mycon, $member_id, $status)
    {
      $sql = "UPDATE `members` SET
              `status` = :status WHERE `member_id` = :member_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":status", $status, PDO::PARAM_STR);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);

      if (!$myrec->execute()) return false;

      return true;
    }


    function members_updatepassword($mycon, $member_id, $password)
    {
      $sql = "UPDATE `members` SET
              `password` = :password WHERE `member_id` = :member_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":password", $password, PDO::PARAM_STR);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);

      if (!$myrec->execute()) return false;

      return true;
    }



    //update the picture status
    function updatePictureStatus($mycon, $member_id, $picturestatus)
    {
      $sql = "UPDATE `members` SET
              `picturestatus` = :picturestatus WHERE `member_id` = :member_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":picturestatus", $picturestatus, PDO::PARAM_STR);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);

      if (!$myrec->execute()) return false;

      return true;
    }

    //update the donation gh
    function donation_update_gh($mycon, $donation_gh, $donation_id)
    {
      $sql = "UPDATE `donations` SET `donation_gh` = :donation_gh WHERE `donation_id` = :donation_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":donation_gh", $donation_gh, PDO::PARAM_STR);
      $myrec->bindValue(":donation_id", $donation_id, PDO::PARAM_STR);

      if(!$myrec->execute()) return false;

      return true;
    }

    //add new testimony
    function testimony_add($mycon, $letter, $donation_id, $member_id)
    {
      $thedate = date("Y-m-d H:i:s");
      $sql = "INSERT INTO `testimony` SET 
              `member_id` = :member_id
              ,`donation_id` = :donation_id
              ,`letter` = :letter
              ,`thedate` = :thedate
              ,`status` = :status";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->bindValue(":donation_id", $donation_id, PDO::PARAM_STR);
      $myrec->bindValue(":letter", $letter, PDO::PARAM_STR);
      $myrec->bindValue(":thedate", $thedate, PDO::PARAM_STR);
      $myrec->bindValue(":status", '5', PDO::PARAM_STR); //5 shows approved testimony
      $myrec->execute();

      if ($myrec->rowCount() < 1) return false;

      return $mycon->lastInsertId();
    }

    //update the testimony status in the donation 
    function donationupdate_testimony($mycon, $testimonialstatus, $testimony_id, $donation_id)
    {
      $sql = "UPDATE `donations` SET 
              `testimonialstatus` = :testimonialstatus 
              ,`testimony_id` = :testimony_id WHERE `donation_id` = :donation_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":testimonialstatus", $testimonialstatus, PDO::PARAM_STR);
      $myrec->bindValue(":testimony_id", $testimony_id, PDO::PARAM_STR);
      $myrec->bindValue(":donation_id", $donation_id, PDO::PARAM_STR);

      if(!$myrec->execute()) return false;

      return true;
    }

    //add new news
    function news_add($mycon, $title, $content, $member_id)
    {
      $thedate = date("Y-m-d H:i:s");
      $sql = "INSERT INTO `news` SET 
              `member_id` = :member_id
              ,`title` = :title
              ,`content` = :content
              ,`thedate` = :thedate";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->bindValue(":title", $title, PDO::PARAM_STR);
      $myrec->bindValue(":content", $content, PDO::PARAM_STR);
      $myrec->bindValue(":thedate", $thedate, PDO::PARAM_STR);
      $myrec->execute();

      if ($myrec->rowCount() < 1) return false;

      return $mycon->lastInsertId();
    }

    //update the news section
    function news_update($mycon, $title, $content, $member_id, $new_id)
    {
      $sql = "UPDATE `news` SET 
              `title` = :title 
              ,`content` = :content
              ,`member_id` = :member_id WHERE `new_id` = :new_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":title", $title, PDO::PARAM_STR);
      $myrec->bindValue(":content", $content, PDO::PARAM_STR);
      $myrec->bindValue(":donation_id", $donation_id, PDO::PARAM_STR);

      if(!$myrec->execute()) return false;

      return true; 
    }

    //update the send email status to 1
    function matching_updateemail($mycon, $matching_id, $status)
    {
        $sql = "UPDATE `matching` SET 
              `sendemail` = :sendemail WHERE `matching_id` = :matching_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":sendemail", $status, PDO::PARAM_STR);
      $myrec->bindValue(":matching_id", $matching_id, PDO::PARAM_STR);

      if(!$myrec->execute()) return false;

      return true; 
    }

     //add new testimony admin
    function testimony_add_admin($mycon, $content, $name, $amount, $date)
    {
      $thedate = date("Y-m-d H:i:s");
      $sql = "INSERT INTO `admintestimony` SET 
              `content` = :content
              ,`name` = :name
              ,`amount` = :amount
              ,`thedate` = :thedate
              ,`status` = :status";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":content", $content, PDO::PARAM_STR);
      $myrec->bindValue(":name", $name, PDO::PARAM_STR);
      $myrec->bindValue(":amount", $amount, PDO::PARAM_STR);
      $myrec->bindValue(":thedate", $date, PDO::PARAM_STR);
      $myrec->bindValue(":status", '5', PDO::PARAM_STR); //5 shows approved testimony
      $myrec->execute();

      if ($myrec->rowCount() < 1) return false;

      return $mycon->lastInsertId();
    }


    function testimony_update_admin($mycon, $admintestimony_id, $content, $name, $amount, $date)
    {
      $thedate = date("Y-m-d H:i:s");
      $sql = "UPDATE `admintestimony` SET 
              `content` = :content
              ,`name` = :name
              ,`amount` = :amount
              ,`thedate` = :thedate WHERE `admintestimony_id` = :admintestimony_id LIMIT 1";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":admintestimony_id", $admintestimony_id, PDO::PARAM_STR);
      $myrec->bindValue(":content", $content, PDO::PARAM_STR);
      $myrec->bindValue(":name", $name, PDO::PARAM_STR);
      $myrec->bindValue(":amount", $amount, PDO::PARAM_STR);
      $myrec->bindValue(":thedate", $date, PDO::PARAM_STR);
      
      if (!$myrec->execute()) return false;

      return true;
    }


}

//class dataRead

class DataRead
{
    //function to get the list of all the countries
    function country_getall($mycon)
    {
        $sql = "SELECT * FROM `country`";
        $myrec = $mycon->prepare($sql);
        $myrec->execute();

        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //check if username exists
    function member_getbyusername($mycon,$username)
    {
        $sql = "SELECT * FROM `members` WHERE `username` = :username LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":username", $username);
        $myrec->execute();
        
        if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //check if username exists
    function departments_getbyname($mycon, $department)
    {
       $sql = "SELECT * FROM `department` WHERE `name` = :name LIMIT 1";
       $myrec = $mycon->prepare($sql);
       $myrec->bindValue(":name", $department, PDO::PARAM_STR);
       $myrec->execute();

       if ($myrec->rowCount() < 1) return false;

       return $myrec->fetch(PDO::FETCH_ASSOC);
    }


    //check if username exists
    function departments_getbyid($mycon, $department_id)
    {
       $sql = "SELECT * FROM `department` WHERE `department_id` = :department_id LIMIT 1";
       $myrec = $mycon->prepare($sql);
       $myrec->bindValue(":department_id", $department_id, PDO::PARAM_STR);
       $myrec->execute();

       if ($myrec->rowCount() < 1) return false;

       return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //check if username exists
    function departments_getbyothers($mycon, $department, $department_id)
    {
       $sql = "SELECT * FROM `department` WHERE `name` = :name AND `department_id` != :department_id LIMIT 1";
       $myrec = $mycon->prepare($sql);
       $myrec->bindValue(":name", $department, PDO::PARAM_STR);
       $myrec->bindValue(":department_id", $department_id, PDO::PARAM_STR);
       $myrec->execute();

       if ($myrec->rowCount() < 1) return false;

       return $myrec->fetch(PDO::FETCH_ASSOC);
    }


    //check if username exists
    function priority_getbyidothers($mycon, $department_id, $priority_id)
    {
       $sql = "SELECT * FROM `priority` WHERE `department_id` = :department_id AND `priority_id` != :priority_id LIMIT 1";
       $myrec = $mycon->prepare($sql);
       $myrec->bindValue(":priority_id", $priority_id, PDO::PARAM_STR);
       $myrec->bindValue(":department_id", $department_id, PDO::PARAM_STR);
       $myrec->execute();

       if ($myrec->rowCount() < 1) return false;

       return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get the departments in the priority table
    function priority_getbyiddepartment($mycon, $department_id)
    {
      $sql = "SELECT * FROM `priority` WHERE `department_id` != :department_id LIMIT 1";
       $myrec = $mycon->prepare($sql);
       $myrec->bindValue(":department_id", $department_id, PDO::PARAM_STR);
       $myrec->execute();

       if ($myrec->rowCount() < 1) return false;

       return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get the departments in the priority table
    function priority_getbyidpriority($mycon, $priority_id)
    {
      $sql = "SELECT p.*, d.name FROM `priority` p LEFT JOIN `department` d ON d.department_id = p.department_id WHERE p.`priority_id` = :priority_id LIMIT 1";
       $myrec = $mycon->prepare($sql);
       $myrec->bindValue(":priority_id", $priority_id, PDO::PARAM_STR);
       $myrec->execute();

       if ($myrec->rowCount() < 1) return false;

       return $myrec->fetch(PDO::FETCH_ASSOC);
    }
    //get the departments in the priority table
    function priority_getall($mycon)
    {
      $sql = "SELECT p.*, d.name FROM `priority` p LEFT JOIN `department` d ON d.department_id = p.department_id ORDER BY p.priority_id ASC";
       $myrec = $mycon->prepare($sql);
       $myrec->execute();

       return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get the departments in the priority table
    function priority_getone($mycon)
    {
      $sql = "SELECT * FROM `priority` ORDER BY priority_id ASC LIMIT 1";
       $myrec = $mycon->prepare($sql);
       $myrec->execute();

       if ($myrec->rowCount() < 1) return false;

       return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get the departments in the priority table
    function priority_getnext($mycon, $priority_id)
    {
      $sql = "SELECT  * FROM `priority` WHERE `priority_id` > :priority_id ORDER BY priority_id ASC LIMIT 1";
       $myrec = $mycon->prepare($sql);
       $myrec->bindValue(":priority_id", $priority_id, PDO::PARAM_STR);
       $myrec->execute();

       if ($myrec->rowCount() < 1) return false;

       return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //check if username exists
    function member_getbyall($mycon)
    {
        $sql = "SELECT * FROM `members`";
        $myrec = $mycon->prepare($sql);
        $myrec->execute();

        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //check if email already exists
    function member_getbyemail($mycon,$email)
    {
        $sql = "SELECT * FROM `members` WHERE `email` = :email LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":email", $email);
        $myrec->execute();
        
        if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }


    //check if phonumber already exists
    function member_getbyphonenumber($mycon,$phonenumber)
    {
        $sql = "SELECT * FROM `members` WHERE `phonenumber` = :phonenumber LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":phonenumber", $phonenumber);
        $myrec->execute();
        
        if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //check if phone number already exist during member update
    function member_getbyphonenumberupdate($mycon,$member_id, $phonenumber)
    {
        $sql = "SELECT * FROM `members` WHERE `phonenumber` = :phonenumber AND `member_id` != :member_id LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":phonenumber", $phonenumber);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->execute();
        
        if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get the member_id of the referral
    function member_referral ($mycon,$referral)
    {
        $sql = "SELECT * FROM `members` WHERE `username` = :username OR `email` = :email LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":username", $referral);
        $myrec->bindValue(":email", $referral);
        $myrec->execute();
        
        if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get member by id
    function member_getbyid($mycon,$member_id)
    {
        $sql = "SELECT * FROM `members` WHERE `member_id` = :member_id LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->execute();
        
        if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    function member_getbyidstaff($mycon, $type, $member_id)
    {
        $sql = "SELECT m.*, d.`name` FROM `members` m LEFT JOIN `department` d ON m.department_id = d.department_id WHERE m.`type` = :type AND m.`member_id` = :member_id LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":type", $type, PDO::PARAM_STR);
        $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
        $myrec->execute();
        
         if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get member by id
    function members_getbytype($mycon,$type1, $type2)
    {
        $sql = "SELECT * FROM `members` WHERE `type` = ".$type1." OR `type` = ".$type2;
        $myrec = $mycon->prepare($sql);
        $myrec->execute();
        
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get member by id
    function members_getbystudenttype($mycon,$type)
    {
        $sql = "SELECT * FROM `members` WHERE `type` = :type";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":type", $type, PDO::PARAM_STR);
        $myrec->execute();
        
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }


    //get member by id
    function departments_getbyhead($mycon,$status)
    {
        $sql = "SELECT d.*, m.`firstname`, m.`lastname`, m.`username` FROM `department` d LEFT JOIN `members` m ON m.member_id = d.member_id WHERE d.`status` = :status";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":status", $status, PDO::PARAM_STR);
        $myrec->execute();
        
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

     function staff_getall($mycon, $type)
    {
        $sql = "SELECT m.*, d.`name` FROM `members` m LEFT JOIN `department` d ON m.department_id = d.department_id WHERE m.`type` = :type";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":type", $type, PDO::PARAM_STR);
        $myrec->execute();
        
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get member by id
    function departments_getbyiddapartments($mycon,$department_id)
    {
        $sql = "SELECT d.*, m.`firstname`, m.`lastname` FROM `department` d LEFT JOIN `members` m ON m.member_id = d.member_id WHERE d.`department_id` = :department_id LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":department_id", $department_id, PDO::PARAM_STR);
        $myrec->execute();
        
        if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }


    //get the clearance status by member_id and priority_id
    function clearance_status_get($mycon, $member_id, $priority_id, $status)
    {
      $sql = "SELECT * FROM `clearance_status` WHERE `member_id` = :member_id AND `priority_id` = :priority_id AND `status` = :status OR `status` = :status1 LIMIT 1";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->bindValue(":priority_id", $priority_id, PDO::PARAM_STR);
      $myrec->bindValue(":status", $status, PDO::PARAM_STR);
      $myrec->bindValue(":status1", '4', PDO::PARAM_STR);
      $myrec->execute();
      
      if ($myrec->rowCount() < 1) return false;
      
      return $myrec->fetch(PDO::FETCH_ASSOC);
    }


    //get the clearance status by member_id and priority_id
    function clearance_status_getbyid($mycon, $clearance_status_id)
    {
      $sql = "SELECT * FROM `clearance_status` WHERE `clearance_status_id` = :clearance_status_id LIMIT 1";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":clearance_status_id", $clearance_status_id, PDO::PARAM_STR);
      $myrec->execute();
      
      if ($myrec->rowCount() < 1) return false;
      
      return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get the clearance status by member_id and priority_id
    function clearance_status_getone($mycon, $member_id, $priority_id)
    {
      $sql = "SELECT * FROM `clearance_status` WHERE `member_id` = :member_id AND `priority_id` = :priority_id LIMIT 1";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->bindValue(":priority_id", $priority_id, PDO::PARAM_STR);
      $myrec->execute();
      
      if ($myrec->rowCount() < 1) return false;
      
      return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get the clearance done by the students 
    function clearance_done_by_students($mycon, $member_id, $status)
    {
      $sql = "SELECT c.*, d.`name` from `clearance_status` c LEFT JOIN `department` d ON d.`department_id` = c.`department_id` WHERE c.`member_id` = :member_id AND c.`status` = :status";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->bindValue(":status", $status, PDO::PARAM_STR);
      $myrec->execute();

      return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }


    //get the clearance done by the students 
    function clearance_status_done_by_students($mycon, $department_id, $status)
    {
     $sql = "SELECT c.*, d.`username`, d.`lastname`, d.`firstname` from `clearance_status` c INNER JOIN `members` d ON d.`member_id` = c.`member_id` WHERE c.`status` = :status AND c.`department_id` = :department_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":status", $status, PDO::PARAM_STR);
      $myrec->bindValue(":department_id", $department_id, PDO::PARAM_STR);
      $myrec->execute();

      return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

     //get the clearance done by the students 
    function clearance_status_done_by_students_department($mycon, $department_id)
    {
     $sql = "SELECT c.*, d.`username`, d.`lastname`, d.`firstname` from `clearance_status` c INNER JOIN `members` d ON d.`member_id` = c.`member_id` WHERE c.`department_id` = :department_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":department_id", $department_id, PDO::PARAM_STR);
      $myrec->execute();

      return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }


    //get the clearance done by the students  and departments
    function clearance_done_by_students_departments($mycon, $member_id, $status,$department_id)
    {
      $sql = "SELECT c.*, d.`name` from `clearance_status` c LEFT JOIN `department` d ON d.`department_id` = c.`department_id` WHERE c.`member_id` = :member_id AND c.`status` = :status AND c.`department_id` = :department_id";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->bindValue(":status", $status, PDO::PARAM_STR);
      $myrec->bindValue(":department_id", $department_id, PDO::PARAM_STR);
      $myrec->execute();

      return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }


    //get the state of any clearance with status
    function clearance_status_getstate($mycon, $member_id, $status)
    {
      $sql = "SELECT * FROM `clearance_status` WHERE `member_id` = :member_id AND `status` = :status LIMIT 1";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
      $myrec->bindValue(":status", $status, PDO::PARAM_STR);
      $myrec->execute();
      
      if ($myrec->rowCount() < 1) return false;
      
      return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get the member_id of the referral
    function member_getbyusernamepassword($mycon,$username, $password, $type)
    {
        $sql = "SELECT * FROM `members` WHERE (`username` = :username OR `email` = :email) AND `password` = :password AND `type` = :type LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":username", $username);
        $myrec->bindValue(":email", $username);
        $myrec->bindValue(":password", $password);
        $myrec->bindValue(":type", $type);
        $myrec->execute();
        
        if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //check if bank name, bank account number and name is in the database
    function member_bankuniqueness($mycon, $bankaccountnumber)
    {
        $sql = "SELECT * FROM `accountdetails` WHERE `bankaccountnumber` = :bankaccountnumber LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":bankaccountnumber", $bankaccountnumber);
        $myrec->execute();
        
        if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get the bank account details 
    function bankaccountdetails($mycon,$member_id)
    {
        $sql = "SELECT * FROM `accountdetails` WHERE `member_id` = :member_id";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id, PDO::PARAM_STR);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get the bank account details 
    function bankaccountdetails_getbyid($mycon,$accountdetail_id)
    {
        $sql = "SELECT * FROM `accountdetails` WHERE `accountdetail_id` = :accountdetail_id LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":accountdetail_id", $accountdetail_id, PDO::PARAM_STR);
        $myrec->execute();
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get the list of all the members referred
    function memberreferral_getbyid($mycon,$member_id)
    {
        $sql = "SELECT * FROM `members` WHERE `referral_id` = :referral_id";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":referral_id", $member_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get active donations donation by user
    function donations_getbyidrecent($mycon,$member_id)
    {
        $sql = "SELECT d.*, m.firstname, m.lastname, m.username, m.status as memberstatus FROM `donations` d LEFT JOIN `members` m ON m.member_id = d.member_id WHERE d.`member_id` = :member_id ORDER BY d.createdon DESC LIMIT 1 ";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->execute();
        
        if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }


    //get active donations donation by user
    function donations_getbyid($mycon,$member_id)
    {
        $sql = "SELECT d.*, m.firstname, m.lastname, m.username, m.status as memberstatus FROM `donations` d LEFT JOIN `members` m ON m.member_id = d.member_id WHERE d.`member_id` = :member_id ORDER BY d.createdon ASC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->execute();

        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //function to get the last donation of the user if it is still pending
    function donations_getlastdonation($mycon, $member_id)
    {
        $sql = "SELECT d.*, m.firstname, m.lastname, m.username, m.status as memberstatus FROM `donations` d LEFT JOIN `members` m ON m.member_id = d.member_id WHERE d.`member_id` = :member_id ORDER BY d.createdon DESC LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->execute();

        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }


    //get active donations donation by user
    function news_getall($mycon)
    {
        $sql = "SELECT n.*, m.firstname, m.lastname, m.username, m.status as memberstatus FROM `news` n LEFT JOIN `members` m ON m.member_id = n.member_id ORDER BY n.`thedate` DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->execute();
        
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get all active donations with staus of 5 and 3
    function donations_getall($mycon)
    {
        $sql = "SELECT d.*, d.`createdon` as donationcreatedon, m.firstname, m.lastname, m.username, m.email, m.referral_id, m.status as memberstatus FROM `donations` d LEFT JOIN `members` m ON m.member_id = d.member_id WHERE d.`donation_ph` != '' ORDER BY d.createdon ASC";
        $myrec = $mycon->prepare($sql);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get all active donations with staus of 5 and 3
    function donations_getidmember($mycon, $member_id)
    {
        $sql = "SELECT d.*, dr.* FROM `donations` d INNER JOIN `donationsreceivable` dr On dr.member_id = d.member_id WHERE d.`donation_ph` != '' AND dr.`member_id` = :member_id ORDER BY d.`createdon` ASC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get all active donations with staus of 5 and 3
    function donations_getidmember_limit($mycon, $member_id)
    {
        $sql = "SELECT d.*, dr.* FROM `donations` d INNER JOIN `donationsreceivable` dr On dr.member_id = d.member_id WHERE d.`donation_ph` != '' AND dr.`member_id` = :member_id ORDER BY d.`createdon` DESC LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->execute();
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }


    //get the details of the make donations
    function donations_gh_getall($mycon)
    {
        $sql = "SELECT d.*, d.`createdon` as donationcreatedon, d.status as donationstatus,m.username, m.firstname, m.lastname, m.email, m.country as country, m.member_id as memberid, pm.* FROM `donations` d LEFT JOIN `members` m ON m.member_id = d.member_id LEFT JOIN `accountdetails` pm ON pm.accountdetail_id = d.accountdetail_id WHERE d.donation_gh != 0";
        $myrec = $mycon->prepare($sql);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get active donations donation by user
    function donation_getbyidreferral($mycon,$member_id)
    {
        $sql = "SELECT d.*, pm.*, m.firstname, m.lastname, m.username, m.status as memberstatus FROM `members` m LEFT JOIN `donations` d ON m.member_id = d.member_id LEFT JOIN `accountdetails` pm ON pm.accountdetail_id = d.accountdetail_id WHERE d.`member_id` = :member_id OR m.referral_id = d.member_id AND d.`status` != 0.00 ORDER BY d.donation_id DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get active donations donation by user
    function donation_getallrandom($mycon, $limit)
    {
        $sql = "SELECT d.*, d.createdon as donationcreated, pm.*, m.firstname, m.lastname, m.username, m.picturestatus, m.status as memberstatus FROM `members` m INNER JOIN `donations` d ON m.member_id = d.member_id LEFT JOIN `accountdetails` pm ON pm.accountdetail_id = d.accountdetail_id WHERE d.`status` != 0.00 AND d.`donation_ph` != '' ORDER BY RAND() LIMIT ".$limit;
        $myrec = $mycon->prepare($sql);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }


     //get the donation request by id
    function donationrequest_getbyid($mycon, $donation_id)
    {
        $sql = "SELECT * FROM `donations` WHERE `donation_id` = :donation_id AND `status` = :status LIMIT 1 ";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":donation_id", $donation_id);
        $myrec->bindValue(":status", 5);// 5 signifies active donations
        $myrec->execute();
        
        if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);

    }

     //get the donation request by id
    function donationrequest_getbyidstatus($mycon, $donation_id, $status)
    {
        $sql = "SELECT * FROM `donations` WHERE `donation_id` = :donation_id AND `status` = :status LIMIT 1 ";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":donation_id", $donation_id);
        $myrec->bindValue(":status", $status);// 5 signifies active donations
        $myrec->execute();
        
        if ($myrec->rowCount() < 1) return false;
        
        return $myrec->fetch(PDO::FETCH_ASSOC);

    }

    //get active donations donation by user
    function donation_getallrandomconfirmed($mycon, $limit)
    {
        $sql = "SELECT d.*, d.createdon as donationcreated, pm.*, m.firstname, m.lastname, m.username, m.role, m.random_match, m.status as memberstatus, m.picturestatus FROM `members` m INNER JOIN `donations` d ON m.member_id = d.member_id LEFT JOIN `accountdetails` pm ON pm.accountdetail_id = d.accountdetail_id WHERE d.`status` = 0 AND d.`donation_ph` != '' AND m.`random_match` = 0 ORDER BY RAND(".$limit.")";
        $myrec = $mycon->prepare($sql);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get active donations donation by user
    function donation_getall_admin($mycon)
    {
        $sql = "SELECT d.*, d.createdon as donationcreatedon, pm.*, m.firstname, m.lastname, m.username, m.email, m.status as memberstatus, m.picturestatus FROM `members` m INNER JOIN `donations` d ON m.member_id = d.member_id LEFT JOIN `accountdetails` pm ON pm.accountdetail_id = d.accountdetail_id WHERE d.`status` = 5 AND d.`donation_ph` != '' ORDER BY d.`createdon` ASC";
        $myrec = $mycon->prepare($sql);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get active donations donation by user
    function donation_getall_gh_admin($mycon)
    {
        $sql = "SELECT d.*, d.createdon as donationcreatedon, pm.*, m.firstname, m.lastname, m.username, m.email, m.status as memberstatus, m.picturestatus FROM `members` m INNER JOIN `donations` d ON m.member_id = d.member_id LEFT JOIN `accountdetails` pm ON pm.accountdetail_id = d.accountdetail_id WHERE d.`status` = 0 AND d.`donation_gh` != '' ORDER BY d.`createdon` ASC";
        $myrec = $mycon->prepare($sql);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get active donations donation by user with status
    function donations_getbyidstatus($mycon,$member_id, $status)
    {
        $sql = "SELECT d.*, m.firstname, m.lastname, m.username, m.status as memberstatus FROM `donations` d LEFT JOIN `members` m ON m.member_id = d.member_id WHERE d.`member_id` = :member_id AND d.`status` = :status ORDER BY d.createdon ASC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->bindValue(":status", $status);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

     //get the referral bonus for a particular member
    function referraldonations_getbyid($mycon,$member_id)
    {
        $sql = "SELECT d.*, d.createdon as donationcreatedon, m.referral_id, m.firstname, m.lastname, m.username, m.email, m.status as memberstatus FROM `members` m LEFT JOIN `donations` d ON m.member_id = d.member_id  WHERE m.`referral_id` = :member_id AND d.`status` != 1.0 AND d.`donation_ph` != '' ORDER BY d.createdon DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }


 //get the referral bonus for a particular member
    function referraldonations_getbyidmember($mycon,$member_id)
    {
        $sql = "SELECT d.*, m.referral_id, m.firstname, m.lastname, m.username, m.email, m.status as memberstatus FROM `members` m LEFT JOIN `donations` d ON m.member_id = d.member_id  WHERE m.`referral_id` = :member_id LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->execute();
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

      //get the referral bonus for a particular member
    function referraldonations_getall($mycon)
    {
        $sql = "SELECT d.*, m.referral_id, m.firstname, m.lastname, m.username, m.email, m.status as memberstatus FROM `members` m LEFT JOIN `donations` d ON m.member_id = d.member_id  WHERE m.`referral_id` = :member_id";
        $myrec = $mycon->prepare($sql);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get active donations donation by user
    function donation_getbyid($mycon,$member_id)
    {
        $sql = "SELECT d.*, d.createdon as donationcreatedon, m.firstname, m.lastname, m.username, m.email, m.status as memberstatus FROM `members` m LEFT JOIN `donations` d ON m.member_id = d.member_id WHERE d.`member_id` = :member_id OR m.referral_id = d.member_id AND d.`status` != 0.00 ORDER BY d.donation_id DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }


    //get active donations donation by user
    function donation_getallbystatus($mycon, $status)
    {
        $sql = "SELECT d.*, m.firstname, m.lastname, m.username, m.email, m.status as memberstatus FROM `members` m LEFT JOIN `donations` d ON m.member_id = d.member_id WHERE d.`member_id` = :member_id AND d.`status` = :status ORDER BY d.donation_id DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":status", $status);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    //get active donations donation by user
    function donationsreceivable_getbyidmember($mycon, $member_id)
    {
        $sql = "SELECT d.*, m.firstname, m.lastname, m.username, m.referral_id, m.email, m.status as memberstatus FROM `members` m LEFT JOIN `donationsreceivable` d ON m.member_id = d.member_id WHERE d.`member_id` = :member_id LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->execute();
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get active donations donation by user
    function donationsreceivable_getbyidreferral($mycon, $referral_id)
    {
        $sql = "SELECT d.*, m.firstname, m.lastname, m.username, m.referral_id, m.email, m.status as memberstatus FROM `members` m LEFT JOIN `donationsreceivable` d ON m.referral_id = d.member_id WHERE m.`referral_id` = :referral_id LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":referral_id", $referral_id);
        $myrec->execute();
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get active donations donation by user
    function donations_getbyidreferral($mycon, $referral_id)
    {
        $sql = "SELECT d.*, m.firstname, m.lastname, m.username, m.referral_id, m.email, m.status as memberstatus FROM `members` m LEFT JOIN `donations` d ON m.referral_id = d.member_id WHERE m.`referral_id` = :referral_id AND d.`donation_ph` != '' LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":referral_id", $referral_id);
        $myrec->execute();
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }

     //get the new donation request with status of 5 and matchedstatus of 0 and member status equal to 0
    function receiefundrequestall($mycon, $status, $matchedstatus, $memberstatus)
    {
        $sql = "SELECT d.*, m.firstname, m.lastname, m.username, m.email, m.country, m.status as memberstatus FROM `members` m LEFT JOIN `donations` d ON m.member_id = d.member_id WHERE d.`status` = :status AND d.`matchedstatus` = :matchedstatus AND d.`donation_gh` != '' AND m.`status` = :mstatus ORDER BY d.`createdon` ASC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":status", $status);
        $myrec->bindValue(":matchedstatus", $matchedstatus);
        $myrec->bindValue(":mstatus", $memberstatus);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

     //get the new donation request with status of 5 and matchedstatus of 0 and member status equal to 0
    function receivefundrequestall($mycon)
    {
        $sql = "SELECT d.*, m.firstname, m.lastname, m.username, m.email, m.country, m.status as memberstatus FROM `members` m LEFT JOIN `donations` d ON m.member_id = d.member_id WHERE d.`donation_gh` != '' ORDER BY d.createdon ASC";
        $myrec = $mycon->prepare($sql);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

     //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function activetransferdonations($mycon, $status, $matchedstatus, $memberstatus, $member_id, $country)
    {
        $sql = "SELECT d.*, m.firstname, m.lastname, m.username, m.email, m.status as memberstatus FROM `members` m LEFT JOIN `donations` d ON m.member_id = d.member_id WHERE d.`status` = :status AND d.`matchedstatus` = :matchedstatus AND m.`country` = :country AND d.`donation_ph` != '' AND m.`status` = :mstatus AND d.`member_id` != :member_id ORDER BY d.`createdon` ASC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":status", $status);
        $myrec->bindValue(":matchedstatus", $matchedstatus);
        $myrec->bindValue(":mstatus", $memberstatus);
        $myrec->bindValue(":member_id", $member_id);
        $myrec->bindValue(":country", $country);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

     //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function matching_transfer_getbyidmemeber($mycon, $matchedstatus, $transfer_id)
    {
        $sql = "SELECT ma.*, ma.`status` as matchingstatus, d.* FROM `donations` d RIGHT JOIN `matching` ma ON d.`donation_id` = ma.`transferfund_id` WHERE `transfer_id` = :transfer_id AND ma.`status` = :status AND d.`donation_ph` != '' AND d.`donation_gh` = '' AND d.`donation_id` = ma.`transferfund_id` ORDER BY ma.`thedate` DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":status", $matchedstatus, PDO::PARAM_STR);
        $myrec->bindValue(":transfer_id", $transfer_id, PDO::PARAM_STR);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

     //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function matching_transfer_getbyidmemeber_admin($mycon)
    {
        $sql = "SELECT ma.*, ma.`status` as matchingstatus, d.* FROM `donations` d RIGHT JOIN `matching` ma ON d.`donation_id` = ma.`transferfund_id` WHERE d.`donation_ph` != '' AND d.`donation_gh` = '' AND d.`donation_id` = ma.`transferfund_id` ORDER BY ma.`thedate` DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

     //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function matching_receive_getbyidmemeber($mycon, $matchedstatus, $receive_id)
    {
        $sql = "SELECT ma.*, ma.`status` as matchingstatus, d.* FROM `donations` d RIGHT JOIN `matching` ma ON d.`donation_id` = ma.`receivefund_id` WHERE `receive_id` = :receive_id AND ma.`status` = :status AND d.`donation_gh` != '' AND d.`donation_ph` = '' AND d.`donation_id` = ma.`receivefund_id` ORDER BY ma.`thedate` DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":status", $matchedstatus, PDO::PARAM_STR);
        $myrec->bindValue(":receive_id", $receive_id, PDO::PARAM_STR);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

     //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function matching_receive_getbyidmemeber_admin($mycon)
    {
        $sql = "SELECT ma.*, ma.`status` as matchingstatus, d.* FROM `donations` d RIGHT JOIN `matching` ma ON d.`donation_id` = ma.`receivefund_id` WHERE d.`donation_gh` != '' AND d.`donation_ph` = '' AND d.`donation_id` = ma.`receivefund_id` ORDER BY ma.`thedate` DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }


     //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function matching_transfer_getall($mycon, $transfer_id)
    {
        $sql = "SELECT ma.*, m.`username`, ma.`status` as matchingstatus, d.* FROM `matching` ma LEFT JOIN `donations` d ON d.`member_id` = ma.`transfer_id` LEFT JOIN `members` m ON m.`member_id` = ma.`transfer_id` WHERE `transfer_id` = :transfer_id AND d.`donation_ph` != '' ORDER BY ma.`thedate` DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":transfer_id", $transfer_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

     //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function matching_receive_getall($mycon, $receive_id)
    {
        $sql = "SELECT ma.*, m.`username`, ma.`status` as matchingstatus, d.* FROM `matching` ma LEFT JOIN `donations` d ON d.`member_id` = ma.`receive_id` LEFT JOIN `members` m ON m.`member_id` = ma.`receive_id` WHERE `receive_id` = :receive_id AND d.`donation_gh` != '' ORDER BY ma.`thedate` DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":receive_id", $receive_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

     //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function matching_getbyid($mycon, $matching_id)
    {
        $sql = "SELECT * FROM `matching` WHERE `matching_id` = :matching_id LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":matching_id", $matching_id);
        $myrec->execute();
        
        return $myrec->fetch(PDO::FETCH_ASSOC);
    }


      //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function matching_transfer_getbyidmatchingstatus($mycon, $matchingstatus, $transfer_id)
    {
        $sql = "SELECT ma.*, m.`username`, ma.`status` as matchingstatus, d.* FROM `matching` ma LEFT JOIN `donations` d ON d.`donation_id` = ma.`transferfund_id` LEFT JOIN `members` m ON m.`member_id` = ma.`transfer_id` WHERE `transfer_id` = :transfer_id AND ma.`status` = :status AND d.`donation_ph` != '' ORDER BY ma.`thedate` DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":status", $matchingstatus);
        $myrec->bindValue(":transfer_id", $transfer_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }
      //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function matching_receive_getbyidmatchingstatus($mycon, $matchingstatus, $receive_id)
    {
        $sql = "SELECT ma.*,  m.`username`, ma.`status` as matchingstatus, d.* FROM `matching` ma LEFT JOIN `donations` d ON d.`donation_id` = ma.`receivefund_id` LEFT JOIN `members` m ON m.`member_id` = ma.`receive_id` WHERE `receive_id` = :receive_id AND ma.`status` = :status AND d.`donation_gh` != '' ORDER BY ma.`thedate` DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":status", $matchingstatus);
        $myrec->bindValue(":receive_id", $receive_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

      //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function matching_transfer_getbyidmatching($mycon, $matching_id, $transfer_id)
    {
        $sql = "SELECT ma.*, ma.`status` as matchingstatus, d.* FROM `matching` ma LEFT JOIN `donations` d ON d.`member_id` = ma.`transfer_id` WHERE `transfer_id` != :transfer_id AND ma.`matching_id` = :matching_id AND d.`donation_ph` != '' LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":matching_id", $matching_id);
        $myrec->bindValue(":transfer_id", $transfer_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }
      //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function matching_receive_getbyidmatching($mycon, $matching_id, $receive_id)
    {
        $sql = "SELECT ma.*, ma.`status` as matchingstatus, d.* FROM `matching` ma LEFT JOIN `donations` d ON d.`member_id` = ma.`receive_id` WHERE `receive_id` != :receive_id AND ma.`matching_id` = :matching_id AND d.`donation_gh` != '' LIMIT 1";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":matching_id", $matching_id);
        $myrec->bindValue(":receive_id", $receive_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }


     //get the list of all the  active donations that are at least 3 days and matched status of 0, status of 5 and memberstatus of 0
    function matching_getbyidmemberandreceiver($mycon, $member_id, $receiver_id)
    {
        $sql = "SELECT * FROM `matching` WHERE `receive_id` = :receive_id AND `receivefund_id` = :receivefund_id";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":receive_id", $member_id);
        $myrec->bindValue(":receivefund_id", $receiver_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

    function matching_getbyidstatus($mycon, $member_id)
    {
      $sql = "SELECT ma.*, ma.`status` as matchingstatus, d.* FROM `matching` ma LEFT JOIN `donations` d ON d.`member_id` = ma.`receive_id` LEFT JOIN `donations` da ON d.`member_id` = ma.`transfer_id` WHERE d.`donation_ph` != '' AND (ma.`receive_id` != :receive_id OR ma.`transfer_id` = :transfer_id) ORDER BY ma.`thedate` DESC";
        $myrec = $mycon->prepare($sql);
        $myrec->bindValue(":transfer_id", $member_id);
        $myrec->bindValue(":receive_id", $member_id);
        $myrec->execute();
        
        return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }


    function receivefundsallrandom($mycon, $limit)
    {
      $sql = "SELECT ma.*, ma.thedate as matchingcreatedon, m.firstname, m.lastname, m.username, m.email, m.picturestatus, m.role, m.random_match, m.status as memberstatus FROM `members` m LEFT JOIN `matching` ma ON ma.receive_id = m.member_id WHERE ma.`status` = 0 ORDER BY RAND(".$limit.")";
      $myrec = $mycon->prepare($sql);
      $myrec->execute();
      
      return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }



    //function to get the account details of the member 
    function accountdetails_getbyidnumber($mycon, $accountdetail_id, $bankaccountnumber)
    {
      $sql = "SELECT * FROM `accountdetails` WHERE `accountdetail_id` != $accountdetail_id AND `bankaccountnumber` != :bankaccountnumber LIMIT 1";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":accountdetail_id", $accountdetail_id, PDO::PARAM_STR);
      $myrec->bindValue(":bankaccountnumber", $bankaccountnumber, PDO::PARAM_STR);
      $myrec->execute();

      if ($myrec->rowCount() < 1) return false;

      return $myrec->fetch(PDO::FETCH_ASSOC);
    }
    

    //get donations details by id
    function donations_getbyiddonation($mycon, $donation_id)
    {
      $sql = "SELECT * FROM `donations` WHERE `donation_id` = :donation_id LIMIT 1";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":donation_id", $donation_id, PDO::PARAM_STR);
      $myrec->execute();

      if ($myrec->rowCount() < 1) return false;

      return $myrec->fetch(PDO::FETCH_ASSOC);
    }


    //function to find all leftover with an amount of the leftover
    function leftover_getall($mycon)
    {
      $sql = "SELECT * FROM `donations` WHERE `leftover` != 0 AND `leftover_id` = 1";
      $myrec = $mycon->prepare($sql);
      $myrec->execute();

      return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }


    //get the details of the news by id
    function news_getbyid($mycon, $new_id)
    {
      $sql = "SELECT * FROM `news` WHERE `new_id` = :new_id LIMIT 1";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":new_id", $new_id);
      $myrec->execute();

      return $myrec->fetch(PDO::FETCH_ASSOC);
    }

    //get all the matching details  with active 
    function matching_getallactivestatus($mycon, $status)
    {
      $sql = "SELECT * FROM `matching` WHERE `status` = :status";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":status", $status, PDO::PARAM_STR);
      $myrec->execute();

      return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }

     //get all the testimonies added by admin 
    function admintestimonials_getall($mycon)
    {
      $sql = "SELECT * FROM `admintestimony`";
      $myrec = $mycon->prepare($sql);
      $myrec->execute();

      return $myrec->fetchAll(PDO::FETCH_ASSOC);
    }


    //get the admin testimony details by id
    function admintestimony_getbyid($mycon, $id)
    {
      $sql = "SELECT * FROM `admintestimony` WHERE `admintestimony_id` = :admintestimony_id LIMIT 1";
      $myrec = $mycon->prepare($sql);
      $myrec->bindValue(":admintestimony_id", $id, PDO::PARAM_STR);
      $myrec->execute();

      if ($myrec->rowCount() < 1) return false;

      return $myrec->fetch(PDO::FETCH_ASSOC);
    }
}
?>