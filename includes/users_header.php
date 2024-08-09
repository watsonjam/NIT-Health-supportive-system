<?php
//------------------------------->>
if(isset($_POST['editProfPicture']))
{
    $picture=$_FILES['picture']['name'];
    $tmp_file=$_FILES['picture']['tmp_name'];
    if(empty($picture))
    {
        echo'<script> alert("please select a picture") </script>';
    }
    else
    {
        $fileExploded=explode('.', $picture);
        $fileExit=strtolower(end($fileExploded));
        $typeOfFileAllowed=array('jpg','JPEG','PNG','SVG');
        if(in_array($fileExit, $typeOfFileAllowed))
        {
            $newFileName=uniqid('',true).".".$fileExit;
            $fileDestination='images/profilePicture/'.$newFileName;
            move_uploaded_file($tmp_file, $fileDestination);
            //----------------------->>
            $update=mysqli_query($conn,"update users set picture='$fileDestination' where id='$id'");
        }
    }
}
if(isset($_POST['resendBtn']))
{
    $email=$_POST['email'];
    $userId=$_POST['userId'];
    $error='';
    $success='';
    $select_uDt=mysqli_query($conn,"select * from users where id='$userId'");
    $rwDt_s=mysqli_fetch_array($select_uDt);
    ////////////////////////////////////////////
    $selects=mysqli_query($conn,"select * from admin");
    $rowDt=mysqli_fetch_array($selects);
    $systmEmail=$rowDt['systemEmail'];
    $emalPassword=$rowDt['emailPassword'];
    $ver_code1=rand(999,9999);
    $ver_code2=rand(999,9999);
    $code=$ver_code1.'-'.$ver_code2;
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
    <div style="font-size:15px;">Dear,&nbsp;<label style="font-weight:bold">'.$rwDt_s['fullName'].',</label>
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
        //inserting data
        $update=("update users set email_verification_code='$code' where id='$userId'");
        $result=mysqli_query($conn,$update);
        if($result)
        {
            $success="email sent";
        }
        else
        {
            $error='prox error occur! there problem on the server';
            
        }
    }
    else
    {
         $error='prox error occur due<br>
            <ul style="margin-left: 50px">
                <li>There problem on server</li>
                <b>OR</b>
                <li>Check your internet connection</li>
            </ul>';
    }
}
?>
<html>
    <style type="text/css">
	    .loginError{
	    	color: red;display:none;
	    }
	    .codeNo input{position:absolute;width:25%;border:1px solid transparent;margin-top:1px;letter-spacing:1px;outline:none;background-color:transparent;color:teal;}
	    .signUpBtn{width: 100%;height: 42px;cursor: pointer;border-radius: 3px;background:linear-gradient(#2980B9,#2E86C1);color: white;border:1px solid #1B4F72;}
	    .passAlert{position:absolute;margin-top:6.5%;margin-left:54%;font-size:11.5px;font-family:sans-serif;font-weight:500;letter-spacing:0.6px;margin-right:20px;}
	    .floatContainer{float: right;margin-top: 14px;margin-right: 20px;width: 25%;}
	    .logOutBtn{background-color: transparent;border:1px solid transparent;cursor: pointer;}
	    .expiredCart_NotificationMainContainer{position: fixed;top: 0px;left: 0px;float: none;width: 100%;height: 100%;background-color: rgba(0,0,0,.6);z-index: 100;display: none;}
	    .expiredCart_NotificationSubContainer{width: 30%;background-color: white;position: relative;top:8%;border-radius: 4px;box-shadow: 0px 0px 50px 0px black;}
	    .showPasswordCont{float: right;margin: 12px 3px;display: none;}
	    .showPasswordCont2{float: right;margin: 12px 3px;display: none;}
        #signUpBtn_ld,
        .verfyEmail,
	    .passwordAlertCont{display: none;}
	    .passInfo{color: #E74C3C;margin-left: 20px;}
	    .valid {color: #029D34;}
	    .valid:before {
	        font-family: 'Font Awesome 5 Free';font-weight: 900;content: '\f00c';left: -15px;position: relative;font-size: 18px;
	    }
	    .invalid {color:#E74C3C;}
	    .invalid:before {
	        font-family: 'Font Awesome 5 Free';font-weight: 900;content: '\f00d';left: -15px;position: relative;font-size: 18px;
	    }
        .verification_container{background-color:white;margin-top: 5%;border-radius: 3px;border:1px solid silver;
    box-shadow: 0px 0px 50px 0px rgba(0,0,0,.5);width: 40%;}
    .verification_container p{word-wrap: break-word;}
    </style>
<header>
	<div class="headerMainContainer">
		<div class="headerSubContainer">
			<div class="leftMenu">
				<div style="display: inline-block;vertical-align: top;margin-top: 5px;cursor: pointer;">
					<label id="dropDwnMenu">
						<i class="fas fa-user"></i>
						<?php
							if(empty($row['fname']) and empty($row['lname']))
							{
								?>
								<label style="margin-top: -5px;margin-left: 7px;cursor: pointer;"><center><?php echo $row['username']; ?>&nbsp;&nbsp;<i class="fas fa-caret-down"></i></center></label><br>
								<?php
							}
							else
							{
								?>
								<label style="margin-top: -5px;margin-left: 7px;cursor: pointer;"><center><?php echo $row['fname']; ?>&nbsp;&nbsp;<i class="fas fa-caret-down"></i></center></label><br>
								<?php
							}
						?>
					</label>
				</div>
					<div id="moreInfoContainer" class="mainCont">
						<div class="loadMoreCont" id="lodMore">
			                <center><img src="images/icons/lod.gif" height="30" width="30"></center>
			            </div>
			            <div class="moreMainContainer" id="moreMainCont">
			                <div class="moreSubContainer">
			                   <div class="moreThirdContainer" style="border-bottom: 1px solid #E5E7E9">
			                        <a href="user_profile?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-user"></i>&nbsp;<span>My Profile</span></a>
			                    </div>
			                    <div class="moreThirdContainer" id="changePass" style="border-bottom: 1px solid #E5E7E9">
			                        <a href="#"><i class="fas fa-unlock-alt" ></i>&nbsp;<span>Change Password</span></a>
			                    </div>
			                    <div class="moreThirdContainer" id="changePrflPictur" style="cursor: pointer;border-bottom: 1px solid #E5E7E9"><i class="fas fa-camera" id="asideDrpDwnSubContIcon" style="margin-top: 4px;"></i>&nbsp;<span style="cursor:pointer;">Edit Profile Picture</span></div>
			                    <div class="moreThirdContainer" style="border-bottom: 1px solid #E5E7E9">
			                        <a href="index.php"><i class="fas fa-sign-out-alt"></i>&nbsp;<button type="button" name="logOutBtn" class="logOutBtn" style="outline:none"><span>Log out</span></button></a>
			                    </div>
			                </div>
			            </div>
			        </div>
			</div>
			<div style="display: inline-block;margin-left: 3px;vertical-align: top;" class="company_logo">
				<?php
				$selectLogo=mysqli_query($conn,"select * from company_information");
				$query=mysqli_fetch_array($selectLogo);
				if(empty($query['company_logo']))
				{
					echo'<img src="images/icons/company_logo.png" style="height:50px">';
				}
				else{
					?>
					<img src="<?php echo  $query['company_logo']; ?>">
					<?php
				}
				?>
			</div>
			<div class="company_name" style="display: inline-block;margin-left: 3px;vertical-align: top;margin-top: 2px;">
				<?php
				if(empty($query['company_name']))
				{
					?>
					<h5 style="margin-top: 6px;">NIT HEALTH SUPPORTIVE SYSTEM</h5>
					<?php					}
				else{
					?>
					<h5 style="margin-top: 6px;"><?php echo $query['company_name']; ?></h5>
					<?php
				}
				if(empty($query['company_moto']))
				{
					?>
					<label style="font-size: 14px;margin-left: 0px">Good Treatment for Good Health</label>
					<?php
				}
				else{
					?>
					<label style="font-size: 14px;margin-left: 0px"><?php echo $query['company_moto']; ?></label>
					<?php
				}
				?>
            </div>
		</div>
	</div>
</header>
<div class="changeProfilePictureHvCont">
	<div class="changeProfilePictureMainCont">
		<div style="padding: 10px;border-bottom: 1px solid silver">
			<div style="float: right;cursor: pointer;" id="closeCont"><i class="fas fa-times"></i></div>
			<h6>Change Profile Picture</h6>
		</div>
		<div style="padding: 20px;">
			<div id="imagePrevCont">
                <img src="" id="imagePrev" height="200" width="200" style="object-fit: cover;border-radius: 3px;border:1px solid silver">
            </div>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="picture" class="inputEditPicture" id="inputEditPicture">
                <input type="submit" name="editProfPicture" value="Update" class="editPicture" id="editPicture">
            </form>
		</div>
	</div>
</div>
<div class="changePasswordHvCont changePasswordHvCont_22" style="z-index: 120">
	<div class="changePasswordMainCont">
		<div style="padding: 10px;color: darkslategrey;border-bottom: 1px solid silver">
			<div style="float: right;cursor: pointer;z-index: 20" id="closeChangePassCont"><button class="btn btn-danger"><i class="fas fa-times"></i></button></div>
			<h6><i class="fas fa-unlock-alt"></i>&nbsp;&nbsp;Change Your Password</h6>
		</div>
		<div style="margin: 10px;" class="displayChangePasswordResult"></div>
		<div style="padding: 20px;padding-top: 10px;">
			<div>
				<div>Old Password</div>
				<div class="formControlCont">
                    <input type="text" name="oldPass" id="oldPass" placeholder="enter old password" class="form-control" autocomplete="off">
                </div>
                <span class="loginError oldPass">*old password required</span>
			</div><br>
			<div>
				<div>New Password</div>
				<div class="formControlCont">
                    <input type="password" name="newPass" id="newPass" placeholder="enter new password" class="form-control">
                </div>
                <div class="showPasswordCont">
                    <label class="checkContainer">
                        <input type="checkbox" id="showPass" style="cursor: pointer;">
                        <span class="checkmark"></span>
                    </label>&nbsp;&nbsp; <label id="info">Show Password</label>
                </div>
                <div class="passwordAlertCont" style="border:1px solid silver">
                   <div style="padding: 8px;background-color:#E5E7E9;border-bottom:2px solid silver">
                    <h6>Password must contain the following:</h6>
                   </div>
                   <div style="padding: 20px;" class="passInfo">
                      <p id="letter1" class="invalid">A <b>lowercase</b> letter</p>
                      <p id="capital1" class="invalid">A <b>capital (uppercase)</b> letter</p>
                      <p id="number1" class="invalid">A <b>number</b></p>
                      <p id="length1" class="invalid">Minimum <b>8 characters</b></p>
                   </div>
                </div>
                <span class="loginError newPass">*new password required</span>
			</div><br>
			<div>
				<div>Re-enter Password</div>
				<div class="formControlCont">
                    <input type="password" name="confPass" id="confPass" placeholder="re-enter password" class="form-control">
                </div>
                <div class="showPasswordCont2">
                    <label class="checkContainer">
                        <input type="checkbox" id="showPass2" style="cursor: pointer;" >
                        <span class="checkmark"></span>
                    </label>&nbsp;&nbsp; <label id="info2">Show Password</label>
                </div>
                <span class="loginError confPass">*re-enter password</span>
			</div><br>
			<div style="height: 70px;">
				<div>
					<button type="button" name="changePassBtn" id="changePassBtn" class="btn btn-success" style="width: 100%"><i class="fas fa-save"></i>&nbsp;&nbsp;Save Changes</button>
				</div>
			</div>
			<input type="text" name="adminId" id="adminId" value="<?php echo $id; ?>" style="display: none;">
		</div>
	</div>
</div>
<?php
if(empty($row['fname']) and empty($row['lname']) and empty($row['email']) and empty($row['mName']) and empty($row['phone_no']) and empty($row['gender']))

{
	?>
	<div class="registerMainContainer" style="display:block;z-index: 100;">
        <div class="registerSubContainer">
            <div style="float: right;margin: 5px;margin-right: 10px;cursor: pointer;">
               <a href="index.php"><i class="fas fa-sign-out-alt"></i>&nbsp;<span>Log out</span></a>
            </div>
            <div style="padding: 10px;">
                <center>
                '<img src="images/icons/company_logo.png" style="height:70px">
                <div style="display: inline-block;margin-left: 3px;vertical-align: top;">
                    <h5 style="margin-top: 6px;">NIT HEALTH SUPPORTIVE SYSTEM</h5>
                    <label style="font-size: 14px;margin-left: -100px">Good Treatment for Good Health</label>
                </div>
                <h4 style="color: darkslategray">Add your Details</h4></center>
                <div><hr></div>
            </div>
            <div style="padding-left: 10px;padding-right: 10px;" class="displaySignUpResult"></div>
            <div style="padding: 30px;padding-top: 2px;">
                <form class="signUpForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div>First Name:</div>
                            <div class="formControlCont">
                                <div class="inputIcon"><i class="fas fa-user"></i></div>
                                <input type="text" name="fname" id="fname" placeholder="enter first name" autocomplete="off">
                            </div>
                            <span class="signUpError fname">*first name required</span>
                        </div>
                        <div class="col-md-6">
                            <div>Middle Name:</div>
                            <div class="formControlCont">
                                <div class="inputIcon"><i class="fas fa-user"></i></div>
                                <input type="text" name="mName" id="mName" placeholder="enter middle name" autocomplete="off">
                            </div>
                            <span class="signUpError mName">*middle name required</span>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div>Last Name:</div>
                            <div class="formControlCont">
                                <div class="inputIcon"><i class="fas fa-user"></i></div>
                                <input type="text" name="lname" id="lname" placeholder="enter last name" autocomplete="off">
                            </div>
                            <span class="signUpError lname">*last name required</span>
                        </div>
                        <div class="col-md-6">
                            <div>Gender:</div>
                            <div class="formControlCont2">
                                <div class="inputIcon"><i class="fas fa-transgender"></i></div>
                                <select name="gender" id="gender" class="form-control">
                                    <option></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <span class="signUpError gender">*gender required</span>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div>Nationality:</div>
                            <div class="formControlCont">
                                <div class="inputIcon"><i class="fas fa-globe"></i></div>
                                <select name="nationality" style="padding-left: 50px;" id="nationality" onclick="showCountryCodeNo()" class="form-control">
                                    <option>Tanzania</option>
                                    <?php
                                    $select=mysqli_query($conn,"select * from countries");
                                    while ($fetch=mysqli_fetch_array($select)) {
                                        echo'<option>'.$fetch['country_name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <span class="signUpError nationality">*nationality required</span>
                        </div>
                        <div class="col-md-6">
                            <div>Date of Birth:</div>
                            <div class="formControlCont">
                                <div class="inputIcon"><i class="fas fa-birthday-cake"></i></div>
                                <input type="date" name="date_of_birth" id="date_of_birth">
                            </div>
                            <span class="signUpError date_of_birth">*date of birth required</span>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div>Email Address:</div>
                            <div class="formControlCont">
                                <div class="inputIcon"><i class="fas fa-envelope"></i></div>
                                <input type="text" name="email" id="email" placeholder="enter email address" autocomplete="off">
                            </div>
                            <span class="signUpError email">*email address required</span>
                        </div>
                        <div class="col-md-6">
                            <div>Phone Number:</div>
                            <div class="formControlCont">
                                <div class="codeNo"><input type="text" name="codeNo" id="codeNo" placeholder="Code: " value="+255" readonly></div>
                                <div class="inputIcon"><i class="fas fa-mobile-alt"></i></div>
                                <input style="padding-left: 85px;" type="text" name="phone_no" id="phone_no" placeholder="enter phone number" autocomplete="off">
                            </div>
                            <span class="signUpError phone_no">*phone number required</span>
                        </div>
                    </div><br>
                    <input type="text" name="userId" id="userId" value="<?php echo $id; ?>" style="display: none;">
                    <div style="float: right;margin-top: 15px;width: 40%;">
                        <button style="outline: none;" type="button" name="signUp" id="signUpBtn" class="signUpBtn"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Add Details</button>
                        <button style="outline: none;" type="button" name="signUp" id="signUpBtn_ld" class="signUpBtn"><img src="images/icons/lod.gif" style="height: 25px;">&nbsp;&nbsp;Please wait.....</button>
                    </div>
                </form>
                <div style="margin-top: 20px;font-size: 14px;letter-spacing: 0.4px;">
                    <span>&copy; <?php echo date("Y"); ?> NIT Health Supportive System</span>
                </div>
            </div>
        </div>
    </div>
	<?php
}
else if($row['about_email']=="not verified")
{
    ?>
    <div class="registerMainContainer" style="display:block;z-index: 100;">
        <div class="container verification_container">
            <div style="padding: 10px;border-bottom: 2px solid silver">
                <div style="float: right;margin: 5px;margin-right: 10px;cursor: pointer;">
                   <a href="index.php"><i class="fas fa-sign-out-alt"></i>&nbsp;<span>Log out</span></a>
                </div>
                <h5>Verify Email Address</h5>
            </div>
            <div style="padding: 20px;">
                <p style="word-wrap: break-word;">Dear, <b><?php echo $row['fullName']; ?></b> please check verification code sent to your email address ( <b><?php echo $row['email'];?></b> ) and copy a code to the textbox below to verify your email address</p>
                <div>
                    <div>
                        <?php
                        if(isset($_POST['resendBtn']))
                        {
                            if($error)
                            {
                                ?>
                                <div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error; ?></div>
                                <?php
                            }
                            if($success)
                            {
                                ?>
                                <div  style="color: #2f3a48;padding: 4px;background-color: #A9DFBF;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom: 10px;">
                                    <i class="fas fa-check-circle" style="font-size: 18px;color: #229954;"></i>&nbsp;&nbsp;<?php echo $success; ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div style="margin-top: 40px;">
                        <form method="post">
                            <input type="text" name="email" id="email" value="<?php echo $row['email']; ?>" style="display: none;">
                            <input type="text" name="userId" id="userId" value="<?php echo $id ?>" style="display: none;">
                            I didn't receive any Email Address&nbsp;<button type="submit" name="resendBtn" class="btn btn-success">Resend</button>
                        </form>
                    </div><br>
                    <hr><br>
                    <div>
                        <div class="displayVrfyEmlRslt"></div>
                        <label>Enter Verification Code:</label>
                        <div class="formControlCont">
                            <div class="row">
                                <div class="col-md-9 col-lg-9 col-sm-9 col-xs-9">
                                    <input type="text" name="verfyEmail" id="verfyEmail" class="form-control" autocomplete="off">
                                    <div>
                                        <label class="text-danger verfyEmail">*verification code required</label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                                    <button type="button" class="btn btn-info verfyEmailBtn">Verify Email</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <?php
}
else{echo"";}
?>
<input type="text" name="userId" id="userId" value="<?php echo $id; ?>" style="display: none;">
<input type="text" name="token" id="token" value="<?php echo $token; ?>" style="display: none;">
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#changePassBtn").click(function(){
			var oldPass=$("#oldPass").val();
			var newPass=$("#newPass").val();
			var confPass=$("#confPass").val();
			var userId=$("#userId").val();
			$.ajax({
				url:"ajax/users/query.php",
				method:"post",
				async:false,
				data:{
					"oldPass":oldPass,
					"newPass":newPass,
					"confPass":confPass,
					"userId":userId
				},
				success:function(data)
				{
					$(".displayChangePasswordResult").html(data);
				}
			});
		});
		//-------------------------->>
		$("#closeCont").on('click',function(){$(".changeProfilePictureHvCont").hide();});
		//---------------------------------->>
		$("#closeChangePassCont").on('click',function(){$(".changePasswordHvCont_22").hide();});
		//---------------------------------->>
		$("#changePrflPictur").on('click',function(){$(".changeProfilePictureHvCont").show();});
		//------------------------------>>
		$("#changePass").on('click',function(){$(".changePasswordHvCont").show();});
		//------------------------------>>
		//------------------------------>>
	    $("#dropDwnMenu").click(function(){
	        if($("#moreInfoContainer").css('display')=="none")
	        {
	            $("#moreInfoContainer").show();
	        }
	        else{
	            $("#moreInfoContainer").hide();
	        }
	    });
	    //--------------------------------->>
		$("#inputEditPicture").change(function(){
	        prevImg(this);
	    });
	    function prevImg(file)
	    {
	        if(file.files&&file.files[0])
	        {
	            var reader=new FileReader();
	            reader.onload=function(e)
	            {
	                $("#imagePrevCont").css("display","block");
	                $("#imagePrev").attr('src',e.target.result);
	            }
	            reader.readAsDataURL(file.files[0]);
	        }
	    }
        ////////////////////////////////////////
	    //-------------------->>
	    $("#newPass").keyup(function(){
	        var pass=$(this).val(),lowerCase= new RegExp('[a-z]'),upperCase= new RegExp('[A-Z]'),numbers= new RegExp('[0-9]');
	        if(pass.length>0){$(".showPasswordCont").show();}
	        else{$(".showPasswordCont").hide();}
	        //----------------------------->>
	        $("#showPass").change(function(){
	            if($(this).prop("checked")==true)
	            {
	                $("#info").html("Hide Password");
	                $("#newPass").attr('type','text');
	            }
	            else{
	                $("#info").html("Show Password");
	                $("#newPass").attr('type','password');
	            }
	        });
	        // Validate lowercase letters
	        if($(this).val().match(lowerCase))
	        {
	            $("#letter1").removeClass("invalid");
	            $("#letter1").addClass("valid");
	        }
	        else{
	            $("#letter1").addClass("invalid");
	            $("#letter1").removeClass("valid");
	        }
	        // Validate uppercase letters
	        if($(this).val().match(upperCase))
	        {
	            $("#capital1").removeClass("invalid");
	            $("#capital1").addClass("valid");
	        }
	        else{
	            $("#capital1").addClass("invalid");
	            $("#capital1").removeClass("valid");
	        }
	        // Validate numbers
	        if($(this).val().match(numbers))
	        {
	            $("#number1").removeClass("invalid");
	            $("#number1").addClass("valid");
	        }
	        else{
	            $("#number1").addClass("invalid");
	            $("#number1").removeClass("valid");
	        }
	        // Validate input length
	        if($(this).val().length>=8)
	        {
	            $("#length1").removeClass("invalid");
	            $("#length1").addClass("valid");
	        }
	        else{
	            $("#length1").addClass("invalid");
	            $("#length1").removeClass("valid");
	        }
	    });
	    //------------------------->>
	    $("#confPass").keyup(function(){
	        var confPass=$(this).val();
	        if(confPass.length>0)
	        {
	            $(".showPasswordCont2").show();
	        }
	        else{
	            $(".showPasswordCont2").hide();
	        }
	        $("#showPass2").change(function(){
	            if($(this).prop("checked")==true)
	            {
	                $("#info2").html("Hide Password");
	                $("#confPass").attr('type','text');
	            }
	            else{
	                $("#info2").html("Show Password");
	                $("#confPass").attr('type','password');
	            }
	        });
	    });
	    //---------------------------------------->>
	    $("#newPass").focus(function(){
	        $(".passwordAlertCont").slideDown(700);
	        var lowercase=new RegExp('[a-z]'),uppercase=new RegExp('[A-Z]'),numbers=new RegExp('[0-9]');
	        if($("#newPass").val().match(lowercase) && $("#newPass").val().match(uppercase) && $("#newPass").val().match(numbers) && $("#newPass").val().length>=8)
	        {
	            $("#changePassBtn").show();
	        }
	        else{
	            $("#changePassBtn").hide();
	        }
	    });
	    $("#newPass").blur(function(){
	        var lowercase=new RegExp('[a-z]'),uppercase=new RegExp('[A-Z]'),numbers=new RegExp('[0-9]');
	        $(".passwordAlertCont").slideUp(700);
	        if($("#newPass").val().match(lowercase) && $("#newPass").val().match(uppercase) && $("#newPass").val().match(numbers) && $("#newPass").val().length>=8)
	        {
	            $("#changePassBtn").show();
	        }
	        else{
	            $("#changePassBtn").hide();
	        }
    	});
    	//---------------------->>
        $("#signUpBtn").click(function(){
            $("#signUpBtn_ld").show();
            $(this).hide();
            setTimeout(function(){
                $("#signUpBtn_ld").hide();
                $('#signUpBtn').show();
            },4000);
            //ajax code
            $.ajax({
                url:"ajax/users/register.php",
                method:"post",
                async:false,// async means Asynchronous which also known as Ajax / XMLHttpRequest
                data:$(".signUpForm").serialize(),
                success:function(data)
                {
                    $(".displaySignUpResult").html(data);
                }
            });
        });
        //--------------------------------->>
        $(".closeNotification").click(function(){window.location.reload();});
	});
    ///////////////////////////////////
    $(".verfyEmailBtn").on('click',function(){
        var verfyEmail=$("#verfyEmail").val();
        var userId=$("#userId").val();
        $.ajax({
            url:"ajax/users/verify_email.php",
            method:"post",
            data:{verfyEmail:verfyEmail,userId:userId},
            success:function(data)
            {
                $(".displayVrfyEmlRslt").html(data);
            }
        });
    });
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//------------------------------>>
	function showMoreCont(){
        document.getElementById('lodMore').style.display="none";
        document.getElementById('moreMainCont').style.display="block";
    }
    setTimeout("showMoreCont()",5000);
</script>
<script type="text/javascript" src="javaScript/codeNo.js"></script>