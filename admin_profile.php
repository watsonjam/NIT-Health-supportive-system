<?php 
include("includes/db_connection.php");
include("includes/security1.php");
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include("includes/head.php");
	?>
	<title>NIT Health Supportive System</title>
	<style type="text/css">
		<style type="text/css">
		.form-control{border:1px solid silver;}
		.pictureAction{position: absolute;margin-left: 220px;margin-top: -30px;padding: 8px;background-color: white;border-radius: 100px;border:1px solid silver;cursor:  pointer;box-shadow: 0px 2px 2px rgba(0,0,0,.4);}
		.pictureAction i{font-size: 20px;color: #2874A6;}
		.pictureAction i:active{color:  transparent;}
		.pictureActionCont{box-sizing: border-box;border: 1px solid silver;padding: 5px;width: inherit;margin-top: 25px;border-radius: 3px;box-shadow: 0px 4px 2px rgba(0,0,0,.2), 0px 3px 6px rgba(0,0,0,.4);padding-left: 12px;display: none;}
		.pictureActionCont:before{content: "";float: right;border:11.5px solid transparent;border-bottom-color: silver;width: 0px;height: 0px;margin-top: -17px;border-top: 0px;margin-right: 16px;}
		.pictureActionCont:after{content: "";float: right;border:9.5px solid transparent;border-bottom-color: white;width: 0px;height: 0px;margin-top: -46.5px;border-top: 0px;margin-right: 17.5px;}
		.editDrugMainCont{position: fixed;top: 0px;left: 0px;float: none;background-color: rgba(0,0,0,.6);width: 100%;height: 100%;z-index: 14;display: none;}
		.deleteMainCont{width: 35%;margin-left:35%;margin-top: 10%;background-color: white;border-radius: 3px;box-shadow: 0px 20px 10px rgba(0,0,0,.4);animation: 1s deleteCont;position: relative;}
		@keyframes deleteCont{from{top: -300px;opacity: 0}to{top: 0px;opacity: 1}}
	    .showPassCont{float: right;margin: 12px 3px;display: none;}
        .showPassCont2{float: right;margin: 12px 3px;display: none;}
        .passAlertCont{display: none;}
        .passInfo{color: #E74C3C;margin-left: 20px;}
        .valid {color: #029D34;}
		.valid:before {
			font-family: 'Font Awesome 5 Free';font-weight: 900;content: '\f00c';left: -15px;position: relative;font-size: 18px;
		}
		.invalid {color:#E74C3C;}
		.invalid:before {
		  	font-family: 'Font Awesome 5 Free';font-weight: 900;content: '\f00d';left: -15px;position: relative;font-size: 18px;
		}
	</style>
</head>
<?php
include("includes/admin_header.php");
?>
<body class="system-body">
	<div class="row">
		<div class="col-md-3">
			<?php
			include("includes/aside_admin.php");
			?>
		</div>
		<div class="col-md-9">
			<div class="pathMaincont">
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Profile</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="container mainContainer" id="mainContainer" style="margin-top:-12px;padding: 10px;">
                        <div>
							<div id="goTop" title="Go back to Top"><a href=""><i class="fas fa-angle-double-up fa-2x"></i></a></div>
							<div class="profileMainCont">
						<div style="padding: 8px;border-bottom: 0.5px solid lavender">
							<div style="float: right;font-size: 14px;">
								<div id="floatButton">
									<button id="btn1_profile" class="saveChanges"><i class="fas fa-save"></i>&nbsp;Save Changes</button>
									<button id="btn2_profile" class="changePass"><i class="fas fa-unlock-alt"></i>&nbsp;Change Password</button>
								</div>
								<div id="floatButton2" style="display: none;">
									<button id="btn1_profile" class="changePassBtn"><i class="fas fa-save"></i>&nbsp;Save Changes</button>
									<button id="btn2_profile" class="details"><i class="fas fa-user"></i>&nbsp;Show Details</button>
								</div>
							</div>
							<div id="link" style="font-weight: 500;">Admin Informations</div>
							<div id="link2" style="font-weight: 500;display: none;">Change Password</div>
						</div>
						<div style="margin-top: 4px;" class="showResult"></div>
						 <div class="profileSubCont">
						 	<div class="row">
						 		<div class="col-md-9">
						 			<div class="detailsCont">
						 				<form class="updateProfileForm">
							 				<input type="text" name="adminId" id="adminId" value="<?php echo $id; ?>" style="display: none;">
							 				<div>
								 				<div><span>User Name:</span></div>
								 				<div>
								 					<input class="form-control" type="text" name="uname" id="uname" value="<?php echo $row['username']; ?>" autocomplete="off">
								 				</div>
								 			</div><br>
								 			<div>
								 				<div><span>First Name:</span></div>
								 				<div>
								 					<input class="form-control" type="text" name="fname" id="fname" value="<?php echo $row['fname']; ?>" autocomplete="off">
								 				</div>
								 			</div><br>
								 			<div>
								 				<div><span>Last Name:</span></div>
								 				<div>
								 					<input class="form-control" type="text" name="lname" id="lname" value="<?php echo $row['lname']; ?>" autocomplete="off">
								 				</div>
								 			</div><br>
								 			<div>
								 				<div><span>Gender:</span></div>
								 				<div>
								 					<select class="form-control" type="text" name="gender" id="gender">
								 						<option><?php echo $row['gender']; ?></option>
								 						<option>Male</option>
								 						<option>Female</option>
								 					</select>
								 				</div>
								 			</div><br>
								 			<div>
								 				<div><span>Nationality:</span></div>
								 				<div>
								 					<select class="form-control" type="text" name="nationality" id="nationality">
								 						<option><?php echo $row['nationality']; ?></option>
								 						<?php
					                                    $select=mysqli_query($conn,"select * from countries");
					                                    while ($fetch=mysqli_fetch_array($select)) {
					                                        echo'<option>'.$fetch['country_name'].'</option>';
					                                    }
					                                    ?>
								 					</select>
								 				</div>
								 			</div><br>
								 			<div>
								 				<div><span>Date of Birth:</span></div>
								 				<div>
								 					<input class="form-control" type="date" name="date_of_birth" id="date_of_birth" value="<?php echo $row['date_of_birth']; ?>">
								 				</div>
								 			</div><br>
								 			<div>
								 				<div><span>Eamil Address:</span></div>
								 				<div>
								 					<input class="form-control" type="text" name="email" id="email" value="<?php echo $row['email']; ?>" autocomplete="off">
								 				</div>
								 			</div><br>
								 			<div>
								 				<div><span>Phone Number:</span></div>
								 				<div>
								 					<input class="form-control" type="text" name="phoneNo" id="phoneNo" value="<?php echo $row['phone_no']; ?>" autocomplete="off">
								 				</div>
								 			</div><br>
								 		</form>
						 			</div>
						 			<div class="passCont" style="display: none;">
						 				<input type="text" name="adminId" id="adminId" value="<?php echo $id; ?>" style="display: none;">
						 				<div>
											<div>Old Password</div>
											<div class="formControlCont">
							                    <input type="text" name="oldPas" id="oldPas" placeholder="enter old password" class="form-control">
							                </div>
							                <span class="loginError oldPas">*old password required</span>
										</div><br>
										<div>
											<div>New Password</div>
											<div class="formControlCont">
							                    <input type="password" name="nwPassword" id="nwPassword" placeholder="enter new password" class="form-control">
							                </div>
							                <div class="showPassCont">
					                        	<label class="checkContainer">
	                                                <input type="checkbox" id="shwPass" style="cursor: pointer;" >
	                                                <span class="checkmark"></span>
	                                            </label>&nbsp;&nbsp; <label id="info">Show Password</label>
					                        </div>
					                        <div class="passAlertCont" style="border:1px solid silver">
											   <div style="padding: 8px;background-color:#E5E7E9;border-bottom:2px solid silver">
											  	<h6>Password must contain the following:</h6>
											   </div>
											   <div style="padding: 20px;" class="passInfo">
												  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
												  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
												  <p id="number" class="invalid">A <b>number</b></p>
												  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
											   </div>
											</div>
							                <span class="loginError newPas">*new password required</span>
										</div><br>
										<div>
											<div>Re-enter Password</div>
											<div class="formControlCont">
							                    <input type="password" name="confPas" id="confPas" placeholder="re-enter password" class="form-control">
							                </div>
							                <div class="showPassCont2">
					                        	<label class="checkContainer">
	                                                <input type="checkbox" id="shwPass2" style="cursor: pointer;" >
	                                                <span class="checkmark"></span>
	                                            </label>&nbsp;&nbsp; <label id="info2">Show Password</label>
					                        </div>
							                <span class="loginError confPas">*re-enter password</span>
										</div><br>
										<input type="text" name="adminId" id="adminId" value="<?php echo $id; ?>" style="display: none;">
						 			</div>
						 		</div>
						 		<div class="col-md-3">
						 			<?php
						 			if(empty($row['picture']))
						 			{
						 				echo"";
						 			}
						 			else
						 			{
							 			?>
							 			<div>
								 			<img src="<?php echo $row['picture']; ?>" height="250" width="250" style="object-fit: cover;border: 1px solid silver;border-radius: 4px;">
								 			<div class="pictureAction"><i class="fas fa-camera"></i></div>
								 		</div>
								 		<div class="pictureActionCont">
							 				<div>
							 					<label style="cursor: pointer;" class="text-info" id="editProfile"><i class="fas fa-edit"></i> &nbsp;Change</label>
							 					&nbsp;&nbsp;|&nbsp;&nbsp;
							 					<label style="cursor: pointer;" class="text-danger delete"><i class="fas fa-trash-alt"></i> &nbsp;Delete</label>
							 				</div>
							 			</div>
							 			<?php
							 		}
						 			?>
						 		</div>
						 	</div>
						 </div>
					</div>
						</div>
						
					</div>
				</div>
			</article>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
	    $(window).scroll(function() {
	    if($(this).scrollTop()>300)
	    {
	       $('#goTop').show(1000);
	    }
	    else
	    {
	       $('#goTop').hide(1000);
	    }
	    });
	    $("#goTop").on('click', function(e) {
	       e.preventDefault();
	       $('html, body').animate({scrollTop:0}, '800');
	    });
	    //---------------------->>
		$(".changePassBtn").click(function(){
			var oldPas=$("#oldPas").val();
			var newPas=$("#nwPassword").val();
			var confPas=$("#confPas").val();
			var adminId2=$("#adminId").val();
			$.ajax({
				url:"ajax/admin/query.php",
				method:"post",
				async:false,
				data:{
					"oldPas":oldPas,
					"newPas":newPas,
					"confPas":confPas,
					"adminIdChangePass":adminId2
				},
				success:function(data)
				{
					$(".showResult").html(data);
				}
			});
		});
		//------------------------>>
		$(".saveChanges").click(function(){
			$.ajax({
				url:"ajax/admin/ajaxUpdateAdminProfile.php",
				method:"post",
				async:false,
				data:$(".updateProfileForm").serialize(),
				success:function(data)
				{
					$(".showResult").html(data);
				}
			});
		});
		//-------------------->>
	    $(".changePass").on('click',function(){
	    	$("#floatButton2").show();
	    	$("#floatButton").hide();
	    	$(".detailsCont").hide();
	    	$(".passCont").show();
	    	$("#link").hide();
	    	$("#link2").show();
	    	/*$("#path1").hide();
	    	$("#path2").show();*/
	    });
	    //-------------------->>
	    $(".details").on('click',function(){
	    	$("#floatButton2").hide();
	    	$("#floatButton").show();
	    	$(".detailsCont").show();
	    	$(".passCont").hide();
	    	$("#link").show();
	    	$("#link2").hide();
	    	/*$("#path1").show();
	    	$("#path2").hide();*/
	    });
	    ////////////////////////////////////////
	    //-------------------->>
		$("#nwPassword").keyup(function(){
			var pass=$(this).val(),lowerCase= new RegExp('[a-z]'),upperCase= new RegExp('[A-Z]'),numbers= new RegExp('[0-9]');
			if(pass.length>0){$(".showPassCont").show();}
			else{$(".showPassCont").hide();}
			//----------------------------->>
			$("#shwPass").change(function(){
				if($(this).prop("checked")==true)
				{
					$("#info").html("Hide Password");
					$("#nwPassword").attr('type','text');
				}
				else{
					$("#info").html("Show Password");
					$("#nwPassword").attr('type','password');
				}
			});
			// Validate lowercase letters
			if($(this).val().match(lowerCase))
			{
				$("#letter").removeClass("invalid");
				$("#letter").addClass("valid");
			}
			else{
				$("#letter").addClass("invalid");
				$("#letter").removeClass("valid");
			}
			// Validate uppercase letters
			if($(this).val().match(upperCase))
			{
				$("#capital").removeClass("invalid");
				$("#capital").addClass("valid");
			}
			else{
				$("#capital").addClass("invalid");
				$("#capital").removeClass("valid");
			}
			// Validate numbers
			if($(this).val().match(numbers))
			{
				$("#number").removeClass("invalid");
				$("#number").addClass("valid");
			}
			else{
				$("#number").addClass("invalid");
				$("#number").removeClass("valid");
			}
			// Validate input length
			if($(this).val().length>=8)
			{
				$("#length").removeClass("invalid");
				$("#length").addClass("valid");
			}
			else{
				$("#length").addClass("invalid");
				$("#length").removeClass("valid");
			}
		});
		//------------------------->>
		$("#confPas").keyup(function(){
			var confPass=$(this).val();
			if(confPass.length>0)
			{
				$(".showPassCont2").show();
			}
			else{
				$(".showPassCont2").hide();
			}
			$("#shwPass2").change(function(){
				if($(this).prop("checked")==true)
				{
					$("#info2").html("Hide Password");
					$("#confPas").attr('type','text');
				}
				else{
					$("#info2").html("Show Password");
					$("#confPas").attr('type','password');
				}
			});
		});
		//---------------------------------------->>
		$("#nwPassword").focus(function(){
			$(".passAlertCont").slideDown(700);
			var lowercase=new RegExp('[a-z]'),uppercase=new RegExp('[A-Z]'),numbers=new RegExp('[0-9]');
			if($("#nwPassword").val().match(lowercase) && $("#nwPassword").val().match(uppercase) && $("#nwPassword").val().match(numbers) && $("#nwPassword").val().length>=8)
			{
				$(".changePassBtn").show();
			}
			else{
				$(".changePassBtn").hide();
			}
		});
		$("#nwPassword").blur(function(){
			var lowercase=new RegExp('[a-z]'),uppercase=new RegExp('[A-Z]'),numbers=new RegExp('[0-9]');
			$(".passAlertCont").slideUp(700);
			if($("#nwPassword").val().match(lowercase) && $("#nwPassword").val().match(uppercase) && $("#nwPassword").val().match(numbers) && $("#nwPassword").val().length>=8)
			{
				$(".changePassBtn").show();
			}
			else{
				$(".changePassBtn").hide();
			}
		});
	});
</script>