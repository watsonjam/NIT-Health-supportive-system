<?php
//database connection
include("db_connection/db_connection.php");
$userId=$_POST['adminId'];
$uname=$_POST['uname'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$gender=$_POST['gender'];
$nationality=$_POST['nationality'];
$date_of_birth=$_POST['date_of_birth'];
$email=$_POST['email'];
$phoneNo=$_POST['phoneNo'];

if(empty($uname))
{
    ?>
    <div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);">
        <i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;User name required</div>
         <style type="text/css">#uname{border: 1px solid red;}</style>
    <?php
}
else
{
    if(strlen($uname)>=5)
    {
        if (empty($email)) 
        {
        ?>
        <div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);">
            <i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;Email required</div>
             <style type="text/css">#email{border: 1px solid red;}</style>
        <?php
        }
        else
        {
            if (strlen($email)>=10) 
            {
                $updateAdmin=("update users set username='$uname',fname='$fname',lname='$lname',gender='$gender',nationality='$nationality',date_of_birth='$date_of_birth',email='$email',phone_no='$phoneNo' where id='$userId'");
                $resultUpdateAdmin=mysqli_query($conn,$updateAdmin);
                if($resultUpdateAdmin)
                {
                    ?>
                    <div style="color: #2f3a48;padding: 7px;background-color: #A9DFBF;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);"><i class="fas fa-check-circle" style="font-size: 18px;color: #229954;"></i>&nbsp;&nbsp;Successfully Update your Profile</div>
                    <?php
                }
                else
                {
                    echo "error occur";
                }
            }
            else
            {
            ?>
            <div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);">
                <i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;email address can not be less than 10 characters</div>
                 <style type="text/css">#email{border: 1px solid red;}</style>
            <?php
            }
        }
    }
    else
    {
    ?>
    <div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);">
        <i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;User name can not be less than 5 characters</div>
         <style type="text/css">#uname{border: 1px solid red;}</style>
    <?php
    }   
}
?>