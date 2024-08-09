<style type="text/css">
	.hoverContainer{
		position: fixed;
		width: 100%;
		top: 0px;
		left: 0px;
		float: none;
		margin: 0px;
		height: 100%;
		background-color: rgba(0,0,0,.4);
		z-index: 11;
	}
	.hoverContainerViewFdBack{
		position: fixed;
		width: 100%;
		top: 0px;
		left: 0px;
		float: none;
		margin: 0px;
		height: 100%;
		background-color: rgba(0,0,0,.4);
		z-index:200;
	}
	.blockAccountCont{
		width: 35%;
		margin-left:35%;
		background-color: white;
		box-sizing: content-box;
		border:1px solid silver;
		box-shadow: 0px 30px 15px rgba(0,0,0,.4);
		margin-top: 1%;
		border-radius: 4px;
		margin-top: 10%;
	}
	.closeCont{
		float: right;
		background-color: white;
	    box-shadow: 0px 12px 6px rgba(0,0,0,.4);
	    border:1px solid silver;
	    padding: 3px;
	    width:5.2%;
	    text-align: center;
	    border-radius: 40px;
	    cursor: pointer;
	    margin-top: -10px;
	    margin-right:-8px;
	}
	.successCont{margin-bottom: 5px;padding: 7px;background-color: #ABEBC6;border-radius: 3px;box-shadow: 0px 0px 5px 0px #16A085 inset;color: #148F77}
	.errorCont{margin-bottom: 5px;padding: 7px;background-color: #E6B0AA;border-radius: 3px;box-shadow: 0px 0px 5px 0px #B03A2E inset;color: #943126}
	.ContainerViewFdBack{background-color: white;box-shadow: 0px 0px 30px 0px rgba(0,0,0,.4);padding: 10px;margin-top: 20px;}
</style>
<?php
//database connection
include("db_connection/db_connection.php");

if(isset($_POST['adminId']))
{
	$adminId=$_POST['adminId'];
	$oldPass=$_POST['oldPass'];
	$newPass=$_POST['newPass'];
	$confPass=$_POST['confPass'];
	//------------------>>
	$select=mysqli_query($conn,"select * from pharmacist where id='$adminId'");
	$row=mysqli_fetch_array($select);

	if(empty($oldPass) and empty($newPass) and empty($confPass))
	{
		?>
		<style type="text/css">
			.formControlCont input{border-color:red;box-shadow: 0px 0px 2px 0px red;}
			.loginError{display: block;}
		</style>
		<?php
	}
	else
	{
		if(empty($oldPass))
		{
			?>
			<style type="text/css">
				#oldPass{border-color:red;box-shadow: 0px 0px 2px 0px red;}
				.oldPass{display: block;}
			</style>
			<?php
		}
		else
		{
			$oldPass=md5($oldPass);
			if($oldPass==$row['password'])
			{
				if(empty($newPass))
				{
					?>
					<style type="text/css">
						#newPass{border-color:red;box-shadow: 0px 0px 2px 0px red;}
						.newPass{display: block;}
					</style>
					<?php
				}
				else
				{
					if(strlen($newPass)>=8 and strlen($newPass)<=15)
					{
						if(empty($confPass))
						{
							?>
							<style type="text/css">
								#confPass{border-color:red;box-shadow: 0px 0px 2px 0px red;}
								.confPass{display: block;}
							</style>
							<?php
						}
						else
						{
							if($newPass==$confPass)
							{
								$newPass=md5($newPass);
								$update=("update pharmacist set password='$newPass' where id='$adminId'");
								$result=mysqli_query($conn,$update);
								if($result)
								{
									?>
									<div style="color: #2f3a48;padding: 7px;background-color: #A9DFBF;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);"><i class="fas fa-check-circle" style="font-size: 18px;color: #229954;"></i>&nbsp;&nbsp;Successffully</div>
									<style type="text/css">
										.formControlCont input{border-color:green;box-shadow: 0px 0px 2px 0px green;}
									</style>
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
								<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;two password does not match</div>
								<style type="text/css">#newPass{border-color:red;box-shadow: 0px 0px 2px 0px red;}#confPass{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
								<?php
							}
						}
					}
					else
					{
						?>
						<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;new password can not be less than 8 or greater than 15 characters of length</div>
						<style type="text/css">#newPass{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
						<?php
					}
				}
			}
			else
			{
				?>
				<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;old password does not exist</div>
				<style type="text/css">#oldPass{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
				<?php
			}
		}
	}
}
//------------------------------------------------->>
if(isset($_POST['adminIdChangePass']))
{
	$adminId=$_POST['adminIdChangePass'];
	$oldPass=$_POST['oldPas'];
	$newPass=$_POST['newPas'];
	$confPass=$_POST['confPas'];
	//------------------>>
	$select=mysqli_query($conn,"select * from pharmacist where id='$adminId'");
	$row=mysqli_fetch_array($select);

	if(empty($oldPass) and empty($newPass) and empty($confPass))
	{
		?>
		<style type="text/css">
			.formControlCont input{border-color:red;box-shadow: 0px 0px 2px 0px red;}
			.loginError{display: block;}
		</style>
		<?php
	}
	else
	{
		if(empty($oldPass))
		{
			?>
			<style type="text/css">
				#oldPas{border-color:red;box-shadow: 0px 0px 2px 0px red;}
				.oldPas{display: block;}
			</style>
			<?php
		}
		else
		{
			$oldPass=md5($oldPass);
			if($oldPass==$row['password'])
			{
				if(empty($newPass))
				{
					?>
					<style type="text/css">
						#newPas{border-color:red;box-shadow: 0px 0px 2px 0px red;}
						.newPas{display: block;}
					</style>
					<?php
				}
				else
				{
					if(strlen($newPass)>=8 and strlen($newPass)<=15)
					{
						if(empty($confPass))
						{
							?>
							<style type="text/css">
								#confPas{border-color:red;box-shadow: 0px 0px 2px 0px red;}
								.confPas{display: block;}
							</style>
							<?php
						}
						else
						{
							if($newPass==$confPass)
							{
								$newPass=md5($newPass);
								$update=("update pharmacist set password='$newPass'");
								$result=mysqli_query($conn,$update);
								if($result)
								{
									?>
									<div style="color: #2f3a48;padding: 7px;background-color: #A9DFBF;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);"><i class="fas fa-check-circle" style="font-size: 18px;color: #229954;"></i>&nbsp;&nbsp;Successffully</div>
									<style type="text/css">
										.formControlCont input{border-color:green;box-shadow: 0px 0px 2px 0px green;}
									</style>
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
								<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;two password does not match</div>
								<style type="text/css">#newPas{border-color:red;box-shadow: 0px 0px 2px 0px red;}#confPas{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
								<?php
							}
						}
					}
					else
					{
						?>
						<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;new password can not be less than 8 or greater than 15 characters of length</div>
						<style type="text/css">#newPas{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
						<?php
					}
				}
			}
			else
			{
				?>
				<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;old password does not exist</div>
				<style type="text/css">#oldPas{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
				<?php
			}
		}
	}
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		//------------------------->>
		$(".closeCont").on('click',function(){
			$(".hoverContainer").hide();
		});
		//------------------------->>
		$(".closeVw").on('click',function(){
			$(".hoverContainerViewFdBack").hide();
		});
		
	});
</script>