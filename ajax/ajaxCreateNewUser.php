<style type="text/css">
    .loadingContainer_hover{position: fixed;top: 0px;left: 0px;margin: 0px;float: none;width: 100%;height: 100%;background-color: rgba(0,0,0,.5);z-index: 100;}
    .loadingContainer{margin-top: 15%}
</style>
<?php
//including database connection
include("db_connection/db_connection.php");

//declearing variables
$username=($_POST['username']);
$password=($_POST['password']);
$confPassword=($_POST['confPassword']);
$userType=$_POST['userType'];

//form validation
if(empty($username) and empty($password) and empty($confPassword) and empty($userType))
{
	?>
	<style type="text/css">
		.formControlCont input{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
		.formControlCont2 select{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
		.loginError{display: block;}
	</style>
	<?php
}
else
{
	if(empty($username))
	{
		?>
		<style type="text/css">
			#username{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
			.username{display: block;}
		</style>
		<?php
	}
	else
	{
		if(strlen($username)>=5 and strlen($username)<=20)
		{
			if(empty($password))
			{
				?>
				<style type="text/css">
					#password{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
					.password{display: block;}
				</style>
				<?php
			}
			else
			{
				if(strlen($password)>=8 and strlen($password)<=15)
				{
					if(empty($confPassword))
					{
						?>
						<style type="text/css">
							#confPassword{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
							.confPassword{display: block;}
						</style>
						<?php
					}
					if($password==$confPassword)
					{
						if(empty($userType))
						{
							?>
							<style type="text/css">
								#userType{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
								.userType{display: block;}
							</style>
							<?php
						}
						else
						{
							if($userType=="Doctor")
							{
                                $name1=substr($username, 0, 2);
                                $name2=substr($username, -2, 2);
                                $username=$name1.$name2;
								$pass=md5($password);
								$details="not added";
								//-------------------->>
								$randKey=rand(99999,999999);
								$username=$username.$randKey;
								//-------------->>
								$select=mysqli_query($conn,"select id from doctors order by id desc");
								$row=mysqli_fetch_array($select);
								$id=$row[0]+1;

								$insert=("insert into doctors(id,username,password,details,role) values('$id','$username','$pass','$details','doctor')");
								$result=mysqli_query($conn,$insert);
								if($result)
								{
									?>
									<script type="text/javascript">
										$(".createNewUserForm")[0].reset();
                                        setTimeout(function(){
                                            $(".loadingContainer_hover").hide();
                                            $(".result").show();
                                        },4000);
									</script>
                                    <div class="loadingContainer_hover">
                                        <center>
                                            <div class="loadingContainer">
                                                <img src="images/icons/double_loading.svg" height="120">
                                                <div style="color:white">
                                                    <h6>Please Wait.......</h6>
                                                </div>
                                            </div>
                                        </center>
                                    </div>
				                    <div  style="color: #2f3a48;padding: 7px;background-color: #A9DFBF;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);display:none" class="result">
				                    	<i class="fas fa-check-circle" style="font-size: 18px;color: #229954;"></i>&nbsp;&nbsp;Successfully<br><br>
				                    	<div>
				                    		<div style="font-size: 15px;">Doctor Username= <strong><?php echo $username; ?></strong></div><br>
				                    		<div style="font-size: 15px;">Doctor Password= <strong><?php echo $password; ?></strong></div>
				                    	</div>
				                    </div>
				                    <?php
								}
								else
								{
									?>
									<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="prox error occur ! there problem on server"; ?></div>
									<?php
								}
							}
							else if($userType=="Pharmacist")
							{
								$pass=md5($password);
								$details="not added";
								//-------------------->>
                                $name1=substr($username, 0, 2);
                                $name2=substr($username, -2, 2);
                                $username=$name1.$name2;
                                $randKey=rand(99999,999999);
								$username=$username.$randKey;
								//-------------->>
								$select=mysqli_query($conn,"select id from pharmacist order by id desc");
								$row=mysqli_fetch_array($select);
								$id=$row[0]+1;

								$insert=("insert into pharmacist(id,username,password,details,role) values('$id','$username','$pass','$details','pharmacist')");
								$result=mysqli_query($conn,$insert);
								if($result)
								{
									?>
									<script type="text/javascript">
										$(".createNewUserForm")[0].reset();
                                        setTimeout(function(){
                                            $(".loadingContainer_hover").hide();
                                            $(".result").show();
                                        },4000);
									</script>
                                    <div class="loadingContainer_hover">
                                        <center>
                                            <div class="loadingContainer">
                                                <img src="images/icons/double_loading.svg" height="120">
                                                <div style="color:white">
                                                    <h6>Please Wait.......</h6>
                                                </div>
                                            </div>
                                        </center>
                                    </div>
				                    <div  style="color: #2f3a48;padding: 7px;background-color: #A9DFBF;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);display:none" class="result">
                                        <i class="fas fa-check-circle" style="font-size: 18px;color: #229954;"></i>&nbsp;&nbsp;Successfully<br><br>
				                    	<div>
				                    		<div style="font-size: 15px;">Pharmasist Username= <strong><?php echo $username; ?></strong></div><br>
				                    		<div style="font-size: 15px;">Pharmasist Password= <strong><?php echo $password; ?></strong></div>
				                    	</div>
				                    </div>
				                    <?php
								}
								else
								{
									?>
									<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="prox error occur ! there problem on server"; ?></div>
									<?php
								}
							}
							else{}
						}
					}
					else
					{
						?>
						<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="two password does not match"; ?></div>
							 <style type="text/css">#password{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}#confPassword{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}</style>
						<?php
					}
				}
				else
				{
					?>
					<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="password can't be less than 8 character or greater than 15 character of length"; ?></div>
						 <style type="text/css">#password{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}</style>
					<?php
				}
			}
		}
		else
		{
			?>
			<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="username can't be less than 5 character or greater than 20 character of length"; ?></div>
				 <style type="text/css">#username{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}</style>
			<?php
		}
	}
}
?>
