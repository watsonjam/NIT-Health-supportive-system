<?php
//------------------------------->>
if(isset($_POST['editProfPicture']))
{
    $picture=$_FILES['picture']['name'];
    $tmp_file=$_FILES['picture']['tmp_name'];
    if(empty($picture))
    {
        echo'<script> alert("please select picture") </script>';
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
            $update=mysqli_query($conn,"update admin set picture='$fileDestination' where id='$id'");
        }
    }
}
?>
<html>
    <style>
        .logOutBtn{background-color: transparent;border:1px solid transparent;cursor: pointer;}
        .showPasswordCont{float: right;margin: 12px 3px;display: none;}
	    .showPasswordCont2{float: right;margin: 12px 3px;display: none;}
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
	    .loginError{
	    	color: red;display:none;
	    }
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
			                        <a href="profile_admin?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-user"></i>&nbsp;<span>My Profile</span></a>
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
                    <input type="password" name="newPass" id="newPass" placeholder="enter new password" class="form-control" autocomplete="off">
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
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#changePassBtn").click(function(){
			var oldPass=$("#oldPass").val();
			var newPass=$("#newPass").val();
			var confPass=$("#confPass").val();
			var adminId=$("#adminId").val();
			$.ajax({
				url:"ajax/query.php",
				method:"post",
				async:false,
				data:{
					"oldPass":oldPass,
					"newPass":newPass,
					"confPass":confPass,
					"adminId":adminId
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
	});
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//------------------------------>>
	function showMoreCont(){
        document.getElementById('lodMore').style.display="none";
        document.getElementById('moreMainCont').style.display="block";
    }
    setTimeout("showMoreCont()",5000);
</script>