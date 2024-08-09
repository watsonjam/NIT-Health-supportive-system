<?php
include("db_connection/db_connection.php");

$name=mysqli_real_escape_string($conn,$_POST['name']);
$s_doctor=mysqli_real_escape_string($conn,$_POST['s_doctor']);
$text_a=mysqli_real_escape_string($conn,$_POST['text_a']);
$date=date("d/m/Y");
$time=date("h:i a");
$status="Pending";
$error="";
$success="";
$userId=$_POST['userId'];
$userEmail=$_POST['userEmail'];

if(empty($s_doctor) and empty($text_a))
{
	?>
	<style type="text/css">
	.formCotrolCont select{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
	#text_a{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
	.m_aError{display: block;}
	</style>
	<?php
}
else
{
	if(empty($s_doctor))
	{
		?>
		<style type="text/css">
		#s_doctor{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
		.s_doctor{display: block;}
		</style>
		<?php
	}
	else
	{
		if(empty($text_a))
		{
			?>
			<style type="text/css">
			#text_a{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
			.text_a{display: block;}
			</style>
			<?php
		}
		else
		{
			if(strlen($text_a)<20)
			{
				?>
				<div style="color: #2f3a48;padding: 7px;background-color: #F1948A;font-size: 14px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="description can't be less than 20 character of length"; ?></div>
				 <style type="text/css">#email{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}</style>
				<?php
			}
			else
			{
				$selects=mysqli_query($conn,"select * from doctors where fullName='$s_doctor'");
				$rws=mysqli_fetch_array($selects);
				$doctorId="doctor".$rws['id'];
				$userId="user".$userId;
				$selectAppoInfo=mysqli_query($conn,"select * from appointment");
				$rwRslt=mysqli_fetch_array($selectAppoInfo);	
				if($rwRslt['doctorName']== $s_doctor && $rwRslt['name']== $name)
				{
					?>
					<div style="color: #2f3a48;padding: 7px;background-color: #F1948A;font-size: 14px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="you have already make an appointment with this doctor "; ?>(Doctor Name:&nbsp;<b style="font-size: 16px;"><?php echo $s_doctor; ?></b>)</div>
					<?php
				}
				elseif($rwRslt['time']==$time)
				{
					?>
					<div style="color: #2f3a48;padding: 7px;background-color: #F1948A;font-size: 14px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="time error"; ?></div>
					<?php
				}
				else
				{
					$select_stng=mysqli_query($conn,"select * from setting where doctor_name='$s_doctor'");
					$rslt_query=mysqli_fetch_array($select_stng);
					if($rslt_query['status']=="Off")
					{
						?>
				        <script type="text/javascript">
				            $(".showContentCont").slideUp("slow");
				            $("#s_doctor").css("border","1px solid red");
				        </script>
				        <div style="color: #2f3a48;padding: 7px;background-color: #F1948A;font-size: 14px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;*you can't make an appointment for this doctor because he has an emergency</div>
				        <?php
					}
					else{
						$time1 = strtotime('08:00 am');
						$time2  = strtotime('04:00 pm');
						if(strtotime(date('h:i a'))>=$time1 && strtotime(date('h:i a'))<=$time2)
						{
							$current_date = date('Y-m-d');
							$timestamp = strtotime($current_date);
							$wkday= date("l", $timestamp );
							$determine_weekday = strtolower($wkday);
							if (($determine_weekday == "saturday") || ($determine_weekday == "sunday")) 
							{
							   ?>
								<div style="color: #2f3a48;padding: 7px;background-color: #F1948A;font-size: 14px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;you can't make an appointment on <?php echo $determine_weekday ; ?>  ( you can make an appointment from <b>Monday</b> to <b>Friday</b> ) only</div>
								<?php
							} 
							else 
							{
								$selects=mysqli_query($conn,"select * from admin");
						        $rowDt=mysqli_fetch_array($selects);
						        $systmEmail=$rowDt['systemEmail'];
						        $emalPassword=$rowDt['emailPassword'];
						        $token_no=rand(9999,99999);
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
						        $mail->addAddress($userEmail);
						        $mail->isHTML(true);
						        $mail->Subject = 'No reply';
						        $mail->Body = '<div style="font-size:17px;font-weight:bold;color:green">Token Number</div><br>
						        <div style="font-size:15px;">Dear,&nbsp;<label style="font-weight:bold">'.$name.',</label>
						        <br><br>
						        These tokens will serve as your identity when you get to the relevant Doctor thank you
						        <br>
						        <div style="margin-top:10px;"><i>NB:Do not delete this Email as the Doctor will not be able to identify you.</i></div>
						        <div><br>
						        If you did not make any appointment please ignore this email.
						        </div>
						        <br>
						        <div style="padding:15px;">
						        Token No: <label style="font-size:16px;"><b>'.$token_no.'</b></label>
						        </div>
						        <br>
						        <div style="font-size:15px;color:#283747">Thank you for using our system</div></div>';
						        if($mail->send())
						        {
								    $insert=("insert into appointment (id,userId,name,user_email,doctorName,doctorId,description,token_no,status,about_appo,time,date) values('','$userId','$name','$userEmail','$s_doctor','$doctorId','$text_a','$token_no','$status','New','$time','$date')");
									$query=mysqli_query($conn,$insert);
									if($query)
									{
										?>
										<script type="text/javascript">
											$(".m_AForm")[0].reset();
											$('.viewAppo').slideDown(400);
											$('.chevron_v_appointment').css('transform','rotate(180deg)');
											$('.chevron_v_appointment').css('transform','rotate(0deg)');
											$('.makeAppo').slideUp(400);
											$(".hoverContainer").slideDown("slow");
										</script>
										<div  style="color: #2f3a48;padding: 7px;background-color: #A9DFBF;font-size: 14px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);">
					                    	<i class="fas fa-check-circle" style="font-size: 18px;color: #229954;"></i>&nbsp;&nbsp;Successfully
					                    </div>
					                    <?php
									}
									else{
										?>
										<div style="color: #2f3a48;padding: 7px;background-color: #F1948A;font-size: 14px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="prox error occur ! there problem on server"; ?></div>
										<?php
									}
								}else{
									?>
                                     <div style="color: #2f3a48;padding: 7px;background-color: #F1948A;font-size: 14px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo "Couldn't contact the server ! Must be a problem on server or check your internet connection."; ?></div>
									<?php
								}
							}
							
						}
						else{
							?>
							<div style="color: #2f3a48;padding: 7px;background-color: #F1948A;font-size: 14px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="you can't make an appointment in this time ( you can make an appointment from <b>08:00 am</b> to <b>04:00 pm</b> ) only"; ?></div>
							<?php
						}
					}
				}
			}
		}
	}
}
?>