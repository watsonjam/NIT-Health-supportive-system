<!DOCTYPE html>
<html>
<head>
	<?php
		include("includes/head.php");
	?>
	<title>NIT Health Supportive System</title>
	<style type="text/css">
		.label3,
		.label1{display: none;}
		.bottom-div label{cursor: pointer;}
		.bottom-div button{line-height: 15px;width: 100%}
		.error{ display: none; }
		.error label{font-size: 14px;display: inline-block;width: 99.7%;background-color:#F5B7B1;margin-top: -1.3px;vertical-align: top;margin-left: 1px;border: 1px  solid #E59866;border-top: 1px solid silver;padding: 5px; }
		.forgotAccount{font-weight: 500;color:#283747;display: none;}
		.error_reg{ display: none; }
		.error_reg label{font-size: 14px;display: inline-block;width: 99.7%;background-color:#F5B7B1;margin-top: -1.3px;vertical-align: top;margin-left: 1px;border: 1px  solid #E59866;border-top: 1px solid silver;padding: 5px; }
		.forgotAccount{font-weight: 500;color:#283747;display: none;}
		.forgotAccount a{color: #0A577B}
		.forgotAccount a:hover{text-decoration: none;}
		rembr{position: absolute;margin-left: 12px;margin-top: -12px;}
		.toggler_menue_main_cont{position: fixed;background-color: lavender;top: 90px;z-index: 10;left:0px;width: 100%;display: none;}
		.login-bottom-main-cont{padding: 10px;background-color: rgba(0,0,0,0.5);color: white}
		.login-bottom-main-cont span{margin-left: 20px;color: #85C1E9;cursor: pointer;}
		.login-bottom-main-cont span:hover{color: lavender}
		.login-bottom-main-cont span:active{color: transparent;}
		.signUpfom{display: none;}
		.showPassCont{float: right;margin: 12px 5px;display: none;font-size: 14px;}
        .showPassCont2{float: right;margin: 12px 3px;display: none;font-size: 14px;}
        .passAlert{display: none;border: 1px solid #A6ACAF;border-top: 1px solid white}
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
<body class="index_body">
	<nav class="navbar navbar-expand-md navigationBar">
      	<a class="navbar-brand" href="#"><label style="position: absolute;margin-top: -10px;margin-left: 25px;"><img src="images/icons/company_logo.png" height="80"></label><h4 style="margin-left: 100px;margin-top: 5px;">NIT HEALTH SUPPORTIVE SYSTEM </h4><br><h6 style="position: absolute;margin-top: -30px;margin-left: 101px;color: #CD0E02">Good Treatment for Good Health</h6></a>
      	<button style="outline: none;background-color: silver;z-index: 12" class="navbar-toggler navbar-dark togglerBtn" type="button" data-toggle="collapse" data-target="#main-navigation">
        	<span class="navbar-toggler-icon"></span>
      	</button>
       <div class="collapse navbar-collapse" id="main-navigation">
         <ul class="navbar-nav">
           <li class="nav-item">
             <a class="nav-link" href="index.php"><i class="fas fa-home"></i>&nbsp;Home</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="#"><i class="fas fa-phone" style="font-size: 14px"></i>&nbsp;Contact</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="#"><i class="fas fa-question-circle"></i>&nbsp;Help</a>
           </li>
         </ul>
       </div>
       <div class="toggler_menue_main_cont">
       	<div>
       		<center>
       			<span><a class="nav-link" href="index.php"><i class="fas fa-home"></i>&nbsp;Home</a></span>
       			<br>
       			<span><a class="nav-link" href="#"><i class="fas fa-phone" style="font-size: 14px"></i>&nbsp;Contact</a></span>
       			<br>
       			<span><a class="nav-link" href="#"><i class="fas fa-question-circle"></i>&nbsp;Help</a></span>
       		</center>
       	</div>
       </div>
    </nav>
	<div class="container py-3 py-md-5">
		<div class="row justify-content-center">
			<!-- LOGIN FORM START -->
			<div class="col-md-8 col-lg-6 offset-md-2 offset-lg-0 signin-main-container signInfom">
				<div style="padding: 10px;border-bottom: 1.4px solid lavender;color: white;background-color: rgba(0,0,0,0.4);">
					<center><h5><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Login to your Account</h5></center>
				</div>
				<div class="displayResultContainer"></div>
				<div style="padding: 30px;">
					<form class="form-container login-form">
						<div class="form-group">
							<div style="font-weight: 500;color: darkslategrey">Username:</div>
							<div class="form-input-container">
								<i class="fas fa-user"></i>
								<input type="text" name="username" id="username" placeholder="enter username" value="<?php if(isset($_COOKIE['username'])){ echo($_COOKIE['username']); } ?>" class="form-control" autocomplete="off">
								<div class="text-danger error usernameError"><label>*username required</label></div>
							</div>
						</div>
						<div class="form-group">
							<span class="showHidePassword">
								<label class="showPassword"><i class="fas fa-eye"></i></label>
								<label class="hidePassword"><i class="fas fa-eye-slash"></i></label>
							</span>
							<div style="font-weight: 500;color:darkslategrey">Password:</div>
							<div class="form-input-container">
								<i class="fas fa-lock"></i>
								<input type="password" name="password" id="password" placeholder="enter password" class="form-control" autocomplete="off">
								<div class="text-danger error passwordError"><label>*password required</label></div>
							</div>
						</div>
						<div class="forgotAccount">
							Forgot <a href="#">Username</a>&nbsp;or&nbsp;<a href="#">Password?</a>
						</div>
						<div class="form-group bottom-div">
							<div style="color: white;font-weight: 500;margin-left: 10px">
								<label class="checkContainer" style="display: inline-block;">
                                    <input type="checkbox" name="rememberMe" id="rememberMe" <?php if(isset($_COOKIE['username'])) {?> chacked <?php }  ?> style="cursor: pointer;" >
                                    <span class="checkmark"></span><rembr>Remember Me</rembr>
                                </label>
							</div>
							<div style="margin-top: 15px;">
								<button style="cursor: pointer;" type="button" class="btn btn-info signInBtn"><label class="label1"><img src="images/icons/lod.gif" height="20" style="margin-right: 10px;">please wait....</label><label class="label2">Sign In</label></button>
							</div>
						</div>
						<br><br>
						<div class="login-bottom-main-cont">
							<div>
								<center>I don't have an Account <span class="signUpLink">Sign Up</span></center>
							</div>
							<div style="color: silver;margin-top: 20px;">
								<center>&copy; <?php echo date("Y"); ?>&nbsp;&nbsp;|&nbsp;&nbsp;Terms of Use &nbsp;&nbsp;|&nbsp;&nbsp;Need Help?</center>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- END OF LOGIN FORM -->
			<!-- SIGNUP FORM START -->
			<div class="col-md-8 col-lg-6 offset-md-2 offset-lg-0 signin-main-container signUpfom">
				<div style="padding: 10px;border-bottom: 1.4px solid lavender;color: white;background-color: rgba(0,0,0,0.4);">
					<center><h5><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Create New Account</h5></center>
				</div>
				<div class="displayResultContainer2"></div>
				<div style="padding: 30px;">
					<form class="form-container register-form">
						<div class="form-group">
							<div style="font-weight: 500;color: darkslategrey">Fullname:</div>
							<div class="form-input-container">
								<i class="fas fa-user"></i>
								<input type="text" name="flname" id="flname" placeholder="enter your fullname" class="form-control" autocomplete="off">
								<div class="text-danger error_reg flnameError"><label>*name required</label></div>
							</div>
						</div>
						<div class="form-group">
							<div style="font-weight: 500;color:darkslategrey">Password:</div>
							<div class="form-input-container">
								<i class="fas fa-lock"></i>
								<input type="password" name="pass" id="pass" placeholder="enter password" class="form-control" autocomplete="off">
								<div class="text-danger error_reg passError"><label>*password required</label></div>
							</div>
							<div class="showPassCont">
	                        	<label class="checkContainer">
                                    <input type="checkbox" id="showPasswrd" style="cursor: pointer;" >
                                    <span class="checkmark"></span>
                                </label>&nbsp;&nbsp; <label id="info">Show Password</label>
	                        </div>
	                        <div class="passAlert">
							   <div style="padding: 8px;background-color:#E5E7E9;border-bottom:2px solid silver">
							  	<label style="font-size: 14px;font-weight: 500">Password must contain the following:</label style="font-size: 16px;">
							   </div>
							   <div style="padding: 20px;" class="passInfo">
								  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
								  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
								  <p id="number" class="invalid">A <b>number</b></p>
								  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
							   </div>
							</div>
						</div>
						<div class="form-group">
							<div style="font-weight: 500;color:darkslategrey">Re-enter Password:</div>
							<div class="form-input-container">
								<i class="fas fa-lock" id="re-enterpassIcn"></i>
								<input type="password" name="confPass" id="confPass" placeholder="enter password" class="form-control" autocomplete="off">
								<div class="text-danger error_reg confPassError"><label>*confirm password</label></div>
							</div>
							<div class="showPassCont2">
	                        	<label class="checkContainer">
                                    <input type="checkbox" id="showPassword2" style="cursor: pointer;" >
                                    <span class="checkmark"></span>
                                </label>&nbsp;&nbsp; <label id="info2">Show Password</label>
	                        </div>
						</div>
						<div class="form-group bottom-div">
							<div style="margin-top: 15px;">
								<button style="cursor: pointer;" type="button" class="btn btn-info creatAccBtn"><label class="label3"><img src="images/icons/lod.gif" height="20" style="margin-right: 10px;">please wait....</label><label class="label4">Create Account</label></button>
							</div>
						</div>
						<br><br>
						<div class="login-bottom-main-cont">
							<div>
								<center>Already have an Account <span class="signInLink">LogIn</span></center>
							</div>
							<div style="color: silver;margin-top: 20px;">
								<center>&copy; <?php echo date("Y"); ?>&nbsp;&nbsp;|&nbsp;&nbsp;Terms of Use &nbsp;&nbsp;|&nbsp;&nbsp;Need Help?</center>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- END OF SIGNUP FORM -->
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#password").keyup(function(){
			var password=$(this).val();
			if(password.length>0)
			{
				if($(this).attr('type')=='text')
				{
					$(".showPassword").css("display","none");
					$(".hidePassword").css("display","block");
				}
				else{
					$(".showPassword").css("display","block");
					$(".hidePassword").css("display","none");
				}
				//------------------------------->>
				$(".showPassword").click(function(){
					$("#password").attr('type', 'text');
					$(this).css("display","none");
					$(".hidePassword").css("display","block");
				});
				//-------------------------------->>
				$(".hidePassword").click(function(){
					$("#password").attr('type', 'password');
					$(this).css("display","none");
					$(".showPassword").css("display","block");
				});
			}
			else{
				$(".showPassword").css("display","none");
				$(".hidePassword").css("display","none");
			}
		});
		//--------------------------------->>
		$(".signInBtn").click(function(){
			$(".label1").show();
			$(".label2").hide();
			$.ajax({
				method:"POST",
				url:"ajax/login/login.php",
				async:false,
				data:$(".login-form").serialize(),
				success:function(data)
				{
					setTimeout(function(){
						$(".label1").hide();
						$(".label2").show();
						$(".displayResultContainer").html(data);
					},3000);
				}
			});
		});
		//###########################################
		$(".togglerBtn").on('click',function(){
			if($(".toggler_menue_main_cont").css("display")=="none")
			{
				$(".toggler_menue_main_cont").slideDown("slow");
			}
			else{
				$(".toggler_menue_main_cont").slideUp('slow');
			}
		});
		//////////////////////////////////////////
		$('.signInLink').on('click',function(){
			$('.signUpfom').hide(1000);
			$('.signInfom').show(1000);
		});
		//////////////////////////////////////////
		$('.signUpLink').on('click',function(){
			$('.signUpfom').show(1000);
			$('.signInfom').hide(1000);
		});
		//-------------------->>
		$("#pass").keyup(function(){
			var pass=$(this).val(),lowerCase= new RegExp('[a-z]'),upperCase= new RegExp('[A-Z]'),numbers= new RegExp('[0-9]');
			if(pass.length>0){
				$(".showPassCont").show();
			}
			else{$(".showPassCont").hide();}
			//----------------------------->>
			$("#showPasswrd").change(function(){
				if($(this).prop("checked")==true)
				{
					$("#info").html("Hide Password");
					$("#pass").attr('type','text');
				}
				else{
					$("#info").html("Show Password");
					$("#pass").attr('type','password');
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
		$("#confPass").keyup(function(){
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
					$("#confPass").attr('type','text');
				}
				else{
					$("#info2").html("Show Password");
					$("#confPass").attr('type','password');
				}
			});
		});
		//---------------------------------------->>
		$("#pass").focus(function(){
			$(".passAlert").slideDown(700);
			$("#re-enterpassIcn").css("margin-top","1px");
			var lowercase=new RegExp('[a-z]'),uppercase=new RegExp('[A-Z]'),numbers=new RegExp('[0-9]');
			if($("#pass").val().match(lowercase) && $("#pass").val().match(uppercase) && $("#pass").val().match(numbers) && $("#pass").val().length>=8)
			{
				$(".creatAccBtn").show();
			}
			else{
				$(".creatAccBtn").hide();
			}
		});
		$("#pass").blur(function(){
			var lowercase=new RegExp('[a-z]'),uppercase=new RegExp('[A-Z]'),numbers=new RegExp('[0-9]');
			$(".passAlert").slideUp(700);
			if($("#pass").val().match(lowercase) && $("#pass").val().match(uppercase) && $("#pass").val().match(numbers) && $("#pass").val().length>=8)
			{
				$(".creatAccBtn").show();
			}
			else{
				$(".creatAccBtn").hide();
			}
			/////////////////////////////////////
			if($(".showPassCont").css("display")=="none")
			{
				$("#re-enterpassIcn").css("margin-top","1px");
			}
			else{
				$("#re-enterpassIcn").css("margin-top","14px");
			}
		});
		///////////////////////////////////////
		$(".creatAccBtn").on("click",function(){
			$(".label3").show();
			$(".label4").hide();
			$.ajax({
				method:"post",
				url:"ajax/register/register.php",
				data:$(".register-form").serialize(),
				success:function(data){
					setTimeout(function(){
						$(".label3").hide();
						$(".label4").show();
						$(".displayResultContainer2").html(data);
					},3000);
				}
			});
		});
		$("#flname").keyup(function(){
            $('#flname').val($(this).val().substring(0, 20).toUpperCase());
        });
        $("#flname").keypress(function(e){
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
            }
        });
	});
</script>