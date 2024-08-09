<?php
include("db_connection/db_connection.php");

$username=stripcslashes($_POST['username']);
$password=stripcslashes($_POST['password']);

if(empty($username) and empty($password))
{
	?>
	<style type="text/css">.form-input-container input{border-color:red;box-shadow: 0px 0px 2px 0px red;}.error{display: block;}</style>
	<?php
}
else{
	if(empty($username))
	{
		?>
		<style type="text/css">#username{border-color:red;box-shadow: 0px 0px 2px 0px red;}.usernameError{display: block;}</style>
		<?php
	}
	else{
		if(empty($password))
		{
			?>
			<style type="text/css">#password{border-color:red;box-shadow: 0px 0px 2px 0px red;}.passwordError{display: block;}</style>
			<?php
		}
		else{
			//password decryption
			$password=md5($password);
            //--------------------->>
			$selectAdminData=("select * from admin where username='$username' and password='$password'");
			$query=mysqli_query($conn,$selectAdminData);
			$result=mysqli_fetch_array($query);
			if($result)
			{
				//--------------------->>
				$token=rand(9999999,99999999);
            	$token=md5($token);
				$id=$result['id'];
				$update_adminTb=("update admin set token='$token'");
			    $result1=mysqli_query($conn,$update_adminTb);
			    if($result1)
			    {
			    	if(!empty($_POST['rememberMe']))
                    {
                        $setCok=setcookie("username",$_POST['username'],time()+(10*365*24*60*60));
                        if($setCok)
                        {
                            mysqli_query($conn,"update admin set status='Online'");
                        ?>
                         <script>
                             window.location.href=("darshbord?id=<?php echo $id; ?>&token=<?php echo $token; ?>");
                        </script>
                        <?php
                        }
                    }
                    else
                    {
                        $unsetCok=setcookie("username","");
                        if($unsetCok)
                        {
                            mysqli_query($conn,"update admin set status='Online'");
                            ?>
                             <script type="text/javascript">
                                  window.location.href=("darshbord?id=<?php echo $id; ?>&token=<?php echo $token; ?>");
                             </script>
                            <?php
                        }
                    }
			    }
			}
			else
			{
				
				$selectDoctorData=("select * from doctors where username='$username' and password='$password'");
				$query2=mysqli_query($conn,$selectDoctorData);
				$result2=mysqli_fetch_array($query2);
				if($result2)
				{
					$token=rand(9999999,99999999);
	            	$token=md5($token);
	            	//--------------------->>
					$id=$result2['id'];
					$update_doctorTb=("update doctors set token='$token'");
				    $result1=mysqli_query($conn,$update_doctorTb);
				    if($result1)
				    {
				    	if(!empty($_POST['rememberMe']))
	                    {
	                        $setCok=setcookie("username",$_POST['username'],time()+(10*365*24*60*60));
	                        if($setCok)
	                        {
	                            mysqli_query($conn,"update doctors set status='Online'");
	                        ?>
	                         <script>
	                             window.location.href=("doctor_darshbord?id=<?php echo $id; ?>&token=<?php echo $token; ?>");
	                        </script>
	                        <?php
	                        }
	                    }
	                    else
	                    {
	                        $unsetCok=setcookie("username","");
	                        if($unsetCok)
	                        {
	                            mysqli_query($conn,"update doctors set status='Online'");
	                            ?>
	                             <script type="text/javascript">
	                                  window.location.href=("doctor_darshbord?id=<?php echo $id; ?>&token=<?php echo $token; ?>");
	                             </script>
	                            <?php
	                        }
	                    }
				    }
				}
				else{
					$selectDoctorData=("select * from pharmacist where username='$username' and password='$password'");
					$query2=mysqli_query($conn,$selectDoctorData);
					$result2=mysqli_fetch_array($query2);
					if($result2)
					{
						$token=rand(9999999,99999999);
		            	$token=md5($token);
		            	//--------------------->>
						$id=$result2['id'];
						$update_doctorTb=("update pharmacist set token='$token'");
					    $result1=mysqli_query($conn,$update_doctorTb);
					    if($result1)
					    {
					    	if(!empty($_POST['rememberMe']))
		                    {
		                        $setCok=setcookie("username",$_POST['username'],time()+(10*365*24*60*60));
		                        if($setCok)
		                        {
		                            mysqli_query($conn,"update pharmacist set status='Online'");
		                        ?>
		                         <script>
		                             window.location.href=("pharmacist_darshbord?id=<?php echo $id; ?>&token=<?php echo $token; ?>");
		                        </script>
		                        <?php
		                        }
		                    }
		                    else
		                    {
		                        $unsetCok=setcookie("username","");
		                        if($unsetCok)
		                        {
		                            mysqli_query($conn,"update pharmacist set status='Online'");
		                            ?>
		                             <script type="text/javascript">
		                                  window.location.href=("pharmacist_darshbord?id=<?php echo $id; ?>&token=<?php echo $token; ?>");
		                             </script>
		                            <?php
		                        }
		                    }
					    }
					}
					else{
						$selectDoctorData=("select * from users where username='$username' and password='$password'");
						$query2=mysqli_query($conn,$selectDoctorData);
						$result2=mysqli_fetch_array($query2);
						if($result2)
						{
							$token=rand(9999999,99999999);
			            	$token=md5($token);
			            	//--------------------->>
							$id=$result2['id'];
							$update_doctorTb=("update users set token='$token'");
						    $result1=mysqli_query($conn,$update_doctorTb);
						    if($result1)
						    {
						    	if(!empty($_POST['rememberMe']))
			                    {
			                        $setCok=setcookie("username",$_POST['username'],time()+(10*365*24*60*60));
			                        if($setCok)
			                        {
			                            mysqli_query($conn,"update users set status='Online'");
			                        ?>
			                         <script>
			                             window.location.href=("user_darshbord?id=<?php echo $id; ?>&token=<?php echo $token; ?>");
			                        </script>
			                        <?php
			                        }
			                    }
			                    else
			                    {
			                        $unsetCok=setcookie("username","");
			                        if($unsetCok)
			                        {
			                            mysqli_query($conn,"update users set status='Online'");
			                            ?>
			                             <script type="text/javascript">
			                                  window.location.href=("user_darshbord?id=<?php echo $id; ?>&token=<?php echo $token; ?>");
			                             </script>
			                            <?php
			                        }
			                    }
						    }
						}
						else{
							?>
							<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="Invalid Username , email address or Password"; ?></div>
								 <style type="text/css">.formControlCont input{border-color:red;box-shadow: 0px 0px 2px 0px red;}#fEmailPass{display: block;}</style>
							<?php
						}
					}
				}
			}
		}
	}
}
?>
