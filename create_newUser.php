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
    <style>
        .loadAjaxcode{display: none;}
        .showPassCont{float: right;margin: 12px 3px;display: none;}
        .showPassCont2{float: right;margin: 12px 3px;display: none;}
        .passAlert{display: none;}
        .passInfo{color: #E74C3C;margin-left: 20px;position: relative;}
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
<body style="overflow-x: hidden;">
	<div class="row">
		<div class="col-md-3">
			<?php
			include("includes/aside_admin.php");
			?>
		</div>
		<div class="col-md-9">
			<div class="pathMaincont">
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Create New User</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="createNewUserMainCont">
						<div>
							<form class="createNewUserForm">
								<div style="padding: 10px;background-color:#1C2833;margin-bottom: 10px;color: white">
									<div>
										<h6><i class="fas fa-user-plus"></i>&nbsp;Create New User</h6>
									</div>
								</div>
								<div style="margin: 10px;" class="displayCreateNewUserResult"></div>
								<div style="padding: 20px;">
									 <div>
				                        <div>Username:</div>
				                        <div class="formControlCont">
				                            <div class="inputIcon"><i class="fas fa-user"></i></div>
				                             <input type="text" name="username" placeholder="enter username" autocomplete="off" id="username">
				                        </div>
				                        <span class="loginError username">*username required</span>
				                    </div><br>
				                    <div>
				                        <div>Password:</div>
				                        <div class="formControlCont">
				                            <div class="inputIcon"><i class="fas fa-key"></i></div>
				                             <input type="password" name="password" placeholder="enter password" autocomplete="off" id="password">
				                        </div>
				                        <div class="showPassCont">
				                        	<label class="checkContainer">
                                                <input type="checkbox" id="showPassword" style="cursor: pointer;" >
                                                <span class="checkmark"></span>
                                            </label>&nbsp;&nbsp; <label id="info">Show Password</label>
				                        </div>
				                        <div class="passAlert" style="border:1px solid silver">
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
				                        <span class="loginError password">*password required</span>
				                    </div><br>
				                    <div style="margin-top: 10px;">
				                        <div>Re-enter Password:</div>
				                        <div class="formControlCont">
				                            <div class="inputIcon"><i class="fas fa-key"></i></div>
				                             <input type="password" name="confPassword" placeholder="re-enter password" autocomplete="off" id="confPassword">
				                        </div>
				                        <div class="showPassCont2">
				                        	<label class="checkContainer">
                                                <input type="checkbox" id="showPassword2" style="cursor: pointer;" >
                                                <span class="checkmark"></span>
                                            </label>&nbsp;&nbsp; <label id="info2">Show Password</label>
				                        </div>
				                        <span class="loginError confPassword">*re-enter password</span>
				                    </div><br>
				                    <div style="margin-top: 10px;">
				                        <div>Select user type:</div>
				                        <div class="formControlCont2">
				                            <div class="inputIcon"><i class="fas fa-user"></i></div>
				                            <select name="userType" id="userType" class="form-control">
				                            	<option value="">select user type</option>
				                            	<option>Doctor</option>
				                            	<option>Pharmacist</option>
				                            </select>
				                        </div>
				                        <span class="loginError userType">*select user type</span>
				                    </div><br>
				                    <div style="height: 40px;">
				                    	<div style="float: right;width: 30%;">
				                    		<button style="outline: none;" type="button" name="addnewUserBtn" id="addnewUserBtn" class="btn btn-info signInBtn"><span class="addIcon"><i class="fas fa-user-plus"></i></span><span class="loadAjaxcode"><img src="images/icons/lod.gif" height="22"></span>&nbsp;&nbsp;Create User</button>
				                    	</div>
				                    </div>
								</div>
							</form>
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
        $("#username").keyup(function(){
            $('#username').val($(this).val().substring(0, 20).toUpperCase());
        });
        $("#username").keypress(function(e){
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
            }
        });
		$("#addnewUserBtn").click(function(){
			$.ajax({
				url:"ajax/ajaxCreateNewUser.php",
				method:"post",
				async:false,
				data:$(".createNewUserForm").serialize(),
				success:function(data)
				{
                    $(".addIcon").hide();
                    $(".loadAjaxcode").show();
                    setTimeout(function(){
                        $(".addIcon").show();
                        $(".loadAjaxcode").hide();
                        $(".displayCreateNewUserResult").html(data);
                    },2000);
				}
			});
		});
		//-------------------->>
		$("#password").keyup(function(){
			var pass=$(this).val(),lowerCase= new RegExp('[a-z]'),upperCase= new RegExp('[A-Z]'),numbers= new RegExp('[0-9]');
			if(pass.length>0){$(".showPassCont").show();}
			else{$(".showPassCont").hide();}
			//----------------------------->>
			$("#showPassword").change(function(){
				if($(this).prop("checked")==true)
				{
					$("#info").html("Hide Password");
					$("#password").attr('type','text');
				}
				else{
					$("#info").html("Show Password");
					$("#password").attr('type','password');
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
		$("#confPassword").keyup(function(){
			var confPass=$(this).val();
			if(confPass.length>0)
			{
				$(".showPassCont2").show();
			}
			else{
				$(".showPassCont2").hide();
			}
			$("#showPassword2").change(function(){
				if($(this).prop("checked")==true)
				{
					$("#info2").html("Hide Password");
					$("#confPassword").attr('type','text');
				}
				else{
					$("#info2").html("Show Password");
					$("#confPassword").attr('type','password');
				}
			});
		});
		//---------------------------------------->>
		$("#password").focus(function(){
			$(".passAlert").slideDown(700);
			var lowercase=new RegExp('[a-z]'),uppercase=new RegExp('[A-Z]'),numbers=new RegExp('[0-9]');
			if($("#password").val().match(lowercase) && $("#password").val().match(uppercase) && $("#password").val().match(numbers) && $("#password").val().length>=8)
			{
				$("#addnewUserBtn").show();
			}
			else{
				$("#addnewUserBtn").hide();
			}
		});
		$("#password").blur(function(){
			var lowercase=new RegExp('[a-z]'),uppercase=new RegExp('[A-Z]'),numbers=new RegExp('[0-9]');
			$(".passAlert").slideUp(700);
			if($("#password").val().match(lowercase) && $("#password").val().match(uppercase) && $("#password").val().match(numbers) && $("#password").val().length>=8)
			{
				$("#addnewUserBtn").show();
			}
			else{
				$("#addnewUserBtn").hide();
			}
		});
	});
</script>