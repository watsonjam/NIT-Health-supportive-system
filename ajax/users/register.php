<?php 
//including database connection
include("db_connection/db_connection.php");

//assign variables
$userId=$_POST['userId'];
$fname=mysqli_real_escape_string($conn,$_POST['fname']);
$mName=mysqli_real_escape_string($conn,$_POST['mName']);
$lname=mysqli_real_escape_string($conn,$_POST['lname']);
$gender=mysqli_real_escape_string($conn,$_POST['gender']);
$nationality=mysqli_real_escape_string($conn,$_POST['nationality']);
$date_of_birth=mysqli_real_escape_string($conn,$_POST['date_of_birth']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$phone_no=mysqli_real_escape_string($conn,$_POST['phone_no']);
$codeNo=$_POST['codeNo'];
$date=date('d/m/Y');
$time=date('h:i a');
$email_verification="not verified";

//form validation
if(empty($fname) and empty($mName) and empty($lname) and empty($gender) and empty($nationality) and empty($date_of_birth) and empty($email) and empty($phone_no))
{
?>
<style type="text/css">
.formControlCont2 input{border-color:red;box-shadow: 0px 0px 2px 0px red;}
.formControlCont2 select{border-color:red;box-shadow: 0px 0px 2px 0px red;}
.signUpError{display: block;}
</style>
<?php
}
else
{
if(empty($fname))
{
?>
<style type="text/css">
#fname{border-color:red;box-shadow: 0px 0px 2px 0px red;}
.fname{display: block;}
</style>
<?php
}
else
{
if(strlen($fname)>=3 and strlen($fname)<=20)
{
if(preg_match('/^[A-Z a-z]+$/', $fname))
{
if(empty($mName))
{
?>
<style type="text/css">
#mName{border-color:red;box-shadow: 0px 0px 2px 0px red;}
.mName{display: block;}
</style>
<?php
}
else
{
if(strlen($mName)>=3 and strlen($mName)<=20)
{
if(preg_match('/^[A-Z a-z]+$/', $mName))
{
if(empty($lname))
{
?>
<style type="text/css">
#lname{border-color:red;box-shadow: 0px 0px 2px 0px red;}
.lname{display: block;}
</style>
<?php
}
else
{
if(strlen($lname)>=3 and strlen($lname)<=20)
{
if(preg_match('/^[A-Z a-z]+$/', $lname))
{
if(empty($gender))
{
?>
<style type="text/css">
#gender{border-color:red;box-shadow: 0px 0px 2px 0px red;}
.gender{display: block;}
</style>
<?php
}
else
{
if(empty($nationality))
{
?>
<style type="text/css">
#nationality{border-color:red;box-shadow: 0px 0px 2px 0px red;}
.nationality{display: block;}
</style>
<?php
}
else
{
if (empty($date_of_birth))
{
?>
<style type="text/css">
#date_of_birth{border-color:red;box-shadow: 0px 0px 2px 0px red;}
.date_of_birth{display: block;}
</style>
<?php
}
else
{
if(empty($email))
{
?>
<style type="text/css">
#email{border-color:red;box-shadow: 0px 0px 2px 0px red;}
.email{display: block;}
</style>
<?php
}
else
{
if(strlen($email)>=10 and strlen($email)<=30)
{
if(filter_var($email,FILTER_VALIDATE_EMAIL))
{
if(empty($phone_no))
{
?>
<style type="text/css">
#phone_no{border-color:red;box-shadow: 0px 0px 2px 0px red;}
.phone_no{display: block;}
</style>
<?php	
}
else
{
	if(preg_match_all('/^[0-9]{9}+$/',$phone_no))
	{
        $selects=mysqli_query($conn,"select * from admin");
        $rowDt=mysqli_fetch_array($selects);
        $systmEmail=$rowDt['systemEmail'];
        $emalPassword=$rowDt['emailPassword'];
        $ver_code1=rand(999,9999);
        $ver_code2=rand(999,9999);
        $code=$ver_code1.'-'.$ver_code2;
        $fullName=$fname." ".$mName." ".$lname;
        ///////////////////////////////////////
        require 'emailFile/PHPMailer.php';
        require 'emailFile/SMTP.php';
        require 'emailFile/Exception.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host ='smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure="tls";
        $mail->Username = $systmEmail;
        $mail->Password = $emalPassword;
        $mail->Port = "587";
        $mail->setFrom($systmEmail,"NIT Health Supportive System");
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'No reply';
        $mail->Body = '<div style="font-size:17px;font-weight:bold;color:green">Email Verification Code</div><br>
        <div style="font-size:15px;">Dear,&nbsp;<label style="font-weight:bold">'.$fullName.',</label>
        <br><br>
        Thank you for creating an account with us. Please copy the Verification code below and put into the textbox in your account to verify your email address and complete your registration
        <div><br>
        If you did not signup for anything, please ignore this email.
        </div>
        <br>
        <div style="padding:15px;">
        Verification Code: <label style="font-size:16px;"><b>'.$code.'</b></label>
        </div>
        <br>
        <div style="font-size:15px;color:#283747">Thank you for using our system</div></div>';
        if($mail->send())
        {
            $phone=$codeNo." ".$phone_no;
            //inserting data
            $update=("update users set fname='$fname',mName='$mName',lname='$lname',fullName='$fullName',gender='$gender',nationality='$nationality',date_of_birth='$date_of_birth',email='$email',phone_no='$phone',email_verification_code='$code',about_email='not verified',details='added',date_registered='$date',time_registered='$time' where id='$userId'");
            $result=mysqli_query($conn,$update);
            if($result)
            {
            ?>
            <script type="text/javascript">
                 window.location.reload();
             </script>
            <?php
            }
            else
            {
                ?>
                <div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;prox error occur! there problem on the server</div>
                <?php
            }
        }
        else
        {
            ?>
            <div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;prox error occur due<br>
                <ul style="margin-left: 50px">
                    <li>There problem on server</li>
                    <b>OR</b>
                    <li>Check your internet connection</li>
                </ul>
            </div>
            <?php
        }
	}
	else
	{
		?>
		<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;invalid phone number</div>
		<style type="text/css">#phone_no{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
		<?php
	}
}
}
else
{
?>
<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;invalid email address Format.! email address must contain ( @ , <span style="font-size:30px;">.</span> , com )</div>
<style type="text/css">#email{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
<?php
}
}
else
{
?>
<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;email address can&#39;t be less than 10 or greater than 30 character</div>
<style type="text/css">#email{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
<?php
}
}
}
}
}
}
else
{
?>
<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;Special character and numbers are not allowed in last name</div>
<style type="text/css">#lname{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
<?php
}
}
else
{
?>
<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;last name can&#39;t be less than 3 or greater than 20 character</div>
<style type="text/css">#lname{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
<?php
}
}
}
else
{
?>
<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;Special character and numbers are not allowed in middle name</div>
<style type="text/css">#mName{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
<?php
}
}
else
{
?>
<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;middle name can&#39;t be less than 3 or greater than 20 character</div>
<style type="text/css">#mName{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
<?php
}
}
}
else
{
?>
<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;Special character and numbers are not allowed in first name</div>
<style type="text/css">#fname{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
<?php
}
}
else
{
?>
<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;first name can&#39;t be less than 3 or greater than 20 character</div>
<style type="text/css">#fname{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
<?php
}
}
}
?>