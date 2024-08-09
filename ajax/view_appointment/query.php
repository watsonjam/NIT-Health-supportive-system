<style type="text/css">
	.hoverContainer{position: fixed;width: 100%;top: 0px;left: 0px;float: none;margin: 0px;height: 100%;background-color: rgba(0,0,0,.1);z-index: 100;}
	.hoverContainer2{position: fixed;width: 100%;top: 0px;left: 0px;float: none;margin: 0px;height: 100%;background-color: rgba(0,0,0,.4);z-index: 120;}
	.viewAppointmentContainer{width: 50%;background-color: white;box-sizing: content-box;border:1px solid silver;box-shadow: 0px 0px 30px 0px rgba(0,0,0,.4);border-radius: 4px;margin-top: 3%;}
	.viewAppointmentContainer2{width: 35%;background-color: white;box-sizing: content-box;border:1px solid silver;box-shadow: 0px 0px 50px 0px rgba(0,0,0,.4);border-radius: 4px;margin-top: 10%;}
	.sndFdback{color: #3498DB;cursor: pointer;}
	.sndFdback:active{color: transparent;}
	.feedbackError{display: none;}
	.confirmBtn_ld,
	.declineBtn_ld,
	.sendFeedbackCont{display: none;}
	.deleteConfirmation{width: 40%;background-color: white;box-shadow:0px 30px 15px rgba(0,0,0,.6);margin-top: 7%;border-radius: 4px;box-sizing: content-box;position: relative;animation: 1s deleteConfirmation}
	@keyframes deleteConfirmation{from{top:-300px;opacity: 0px;}to{top:0px;opacity: 1}}
</style>
<?php
//database connection
include("db_connection/db_connection.php");
if(isset($_POST['appoId_d']))
{
	$appoId_d=$_POST['appoId_d'];
	$token=$_POST['token'];
	$id=$_POST['id'];
	$selectDt=mysqli_query($conn,"select * from appointment where id='$appoId_d'");
	$nm_rw=mysqli_num_rows($selectDt);
	$rwData=mysqli_fetch_array($selectDt);
	?>
	<div class="hoverContainer">
		<div class="container viewAppointmentContainer">
			<div id="loadContent">
				<div style="height: 370px;">
					<div style="margin-top: 250px;">
						<center><img src="images/icons/lod.gif" height="100" width="100"></center>
					</div>
				</div>
			</div>
			<div style="display: none;" id="showContent">
				<?php
				$doctorName=$rwData['doctorName'];
				$select=mysqli_query($conn,"select * from appointment where doctorName='$doctorName'");
				$queryDm=mysqli_fetch_array($select);
				$id1=$queryDm['id']."<br>";
				if($appoId_d>$id1 and $queryDm['status'] !=="Declined")
				{
					?>
					<div class="hoverContainer2">
						<div class="container viewAppointmentContainer2">
							<div style="padding: 10px;border-bottom:1px solid silver">
								<div style="float: right;cursor: pointer" class="text-danger closeViewAppoCont">
									<i class="fas fa-times"></i>
								</div>
								<h5><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;Error</h5>
							</div>
							<div style="padding: 20px">
								<p>Please finish appointment for <b><?php echo $queryDm['name']; ?></b> first</p>
							</div>
						</div>
					</div>
					<?php
				}
				else{echo"";}
				?>
				<div style="padding: 10px;border-bottom:1px solid silver">
					<div style="float: right;cursor: pointer" class="text-danger closeViewAppoCont">
						<i class="fas fa-times"></i>
					</div>
					<h5>Patient Appointment</h5>
				</div>
				<div>
					<div  style="padding: 20px;line-height:35px;">
						<div style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,.5);padding: 10px">
							<div>Patient Name:&nbsp;&nbsp;<b><?php echo $rwData['name']; ?></b><span style="margin-left: 50px;"><?php echo $rwData['date']; ?>&nbsp;&nbsp; at &nbsp;&nbsp;<?php echo $rwData['time']; ?></span></div><hr>
							<div style="padding: 10px;margin-left: 20px;">
								<div style="word-wrap: break-word;"><b>Description:</b>&nbsp;&nbsp;<?php echo $rwData['description']; ?></div>
							</div>
						</div>
						<hr>
						<div style="margin-top: 20px;">
							<div>
								<label class="sndFdback">Send Feedback<span style="margin-left: 10px;"><i class="fas fa-chevron-down chevron_s_appointment"></i></span></label>
								<div style="margin-top: 10px;box-shadow: 0px 0px 5px 0px rgba(0,0,0,.5)" class="sendFeedbackCont">
									<div style="padding: 10px;border-bottom: 2px solid silver;background-color: lavender">
										<h6>Send Feedback to Patient</h6>
									</div>
									<div style="padding: 20px;">
										<div class="displaySendFdBackRslt"></div>
										<form class="m_AForm">
											<div class="formControlCont">
												<label>Feedback:</label>
												<div>
													<textarea name="feedback" id="feedback" class="form-control" style="height: 120px;"></textarea>
													<label class="text-danger feedbackError feedback">*feeback required</label>
												</div>
											</div>
											<div style="height: 50px;margin-top: 20px;">
												<div style="float: right;">
													<button type="button" class="btn btn-info sendFeedbackBtn" id="<?php echo $appoId_d; ?>">Send Feedback</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<hr>
							<?php
							if($rwData['status']=="Pending" || $rwData['status']=="next")
							{
							?>
								<div style="padding: 10px;">
									<div class="displayResult"></div>
									<div>
										<label>Enter Token No:</label>
										<div class="formControlCont">
											<input type="number" name="tokenNo" id="tokenNo" class="form-control" autocomplete="off">
											<label class="text-danger error_t_n"></label>
										</div>
									</div><br>
									<center>
										<button type="button" class="btn btn-info confirmAppoBtn" id="<?php echo $appoId_d; ?>"><i class="fas fa-check"></i>&nbsp;&nbsp;Confirm Appointment</button>
										<button type="button" class="btn btn-info confirmBtn_ld"><img src="images/icons/lod.gif" style="height: 20px;">&nbsp;&nbsp;Please wait....</button>
										<button type="button" class="btn btn-danger declineBtn" id="<?php echo $appoId_d; ?>"><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Decline</button>
										<button type="button" class="btn btn-danger declineBtn_ld"><img src="images/icons/lod.gif" style="height: 20px;">&nbsp;&nbsp;Please wait....</button>
									</center>
								</div>
							<?php
							}
							else if($rwData['status']=="confirmed")
							{
								?>
								<center>
									<button type="button" class="btn btn-success approveBtn" id="<?php echo $appoId_d; ?>"><i class="fas fa-check"></i>&nbsp;&nbsp;Approve</button>
								</center>
								<?php
							}
							else{echo"";}

							?>
						</div>
					</div>
				</div>
				<input type="text" name="doctorId" id="doctorId" value="<?php echo $rwData['doctorId']; ?>" style="display: none;">
				<input type="text" name="appoId_d" id="appoId_d" value="<?php echo $appoId_d; ?>" style="display: none;">
				<input type="text" name="id" id="id" value="<?php echo $id; ?>" style="display: none;">
				<input type="text" name="token" id="token" value="<?php echo $token; ?>" style="display: none;">
			</div>
		</div>
	</div>
	<div class="resultCont"></div>
	<?php
}
if(isset($_POST['fdBackId']))
{
	$fdBackId=$_POST['fdBackId'];
	$feedback=$_POST['feedback'];
	$select_Ap=mysqli_query($conn,"select * from appointment where id='$fdBackId'");
	$row_Ap=mysqli_fetch_array($select_Ap);
	$doctorName=$row_Ap['doctorName'];
	$select_Ap2=mysqli_query($conn,"select * from appointment where id !='$fdBackId' and doctorName='$doctorName' order by id asc");
	$row_Ap2=mysqli_fetch_array($select_Ap2);
	$second_id=$row_Ap2['id'];
	///////////////////////////////////
	mysqli_query($conn,"update appointment set status='next' where id='$second_id'");
	$error="";
	if(empty($feedback))
	{
		?>
		<style type="text/css">
			.formControlCont textarea{border:1px solid red;}
			.feedbackError{display: block;}
		</style>
		<?php
	}
	else{
		$update=("update appointment set feedback='$feedback' where id='$fdBackId'");
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
			<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="prox error occur ! there problem on server"; ?></div>
			<?php
		}
	}
}
//////////////////////////////////////////////////////////////
if(isset($_POST['confId']))
{
	$confId=$_POST['confId'];
	$tokenNo=$_POST['tokenNo'];
	$error="";
	/////////////////////////////////////////////////
	$select_Ap=mysqli_query($conn,"select * from appointment");
	$row_Ap=mysqli_fetch_array($select_Ap);
	////////////////////////////////////////////////
	if($row_Ap['token_no']==$tokenNo)
	{
		$update=("update appointment set status='confirmed' where id='$confId'");
		$result=mysqli_query($conn,$update);
		if($result)
		{
			$doctorName=$row_Ap['doctorName'];
			$select_Ap2=mysqli_query($conn,"select * from appointment where id !='$confId' and doctorName='$doctorName' order by id asc");
			$row_Ap2=mysqli_fetch_array($select_Ap2);
			$user_email=$row_Ap2['user_email'];
			$second_id=$row_Ap2['id'];
			///////////////////////////////////
			mysqli_query($conn,"update appointment set status='next' where id='$second_id'");
			$selects=mysqli_query($conn,"select * from admin");
			$row=mysqli_fetch_array($selects);
			$systmEmail=$row['systemEmail'];
			$emalPassword=$row['emailPassword'];
			//--------------------------------------------->>
			require 'require/PHPMailer.php';
			require 'require/SMTP.php';
			require 'require/Exception.php';
			$mail = new PHPMailer\PHPMailer\PHPMailer();
			$mail->isSMTP();
			$mail->Host ='smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->SMTPSecure="tls";
			$mail->Username = $systmEmail;
			$mail->Password = $emalPassword;
			$mail->Port = "587";
			$mail->setFrom($systmEmail,"NIT Health Supportive System");
			$mail->addAddress($user_email);
			$mail->isHTML(true);
			$mail->Subject = 'No reply';
			$mail->Body = '<div style="font-size:15px;">Dear,&nbsp;<label style="font-size:16px;color:green;font-weight:bold">'.$row_Ap2['name'].'</label></div><br>
			<div style="font-size:15px;">You are reminded that your queue is approaching so move to the hospital area please..
			<div><br>
			If you did not make any appointment, please ignore this email.
			</div>
			<br>
			<br>
			<div style="font-size:15px;color:#283747">Thank you for using our system</div></div>';
			if($mail->send())
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
			<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;prox error occur ! there problem on server</div>
			<?php
		}
	}
	else
	{
		?>
		<style type="text/css">
			#tokenNo{border:1px solid red;}
		</style>
		<div style="color: #2f3a48;padding: 4px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:5px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;invalid token number</div>
		<?php
	}
}
//////////////////////////////////////////////////////////////
if(isset($_POST['declineId']))
{
	$declineId=$_POST['declineId'];
	$error="";
	$select_Ap=mysqli_query($conn,"select * from appointment where id='$declineId'");
	$row_Ap=mysqli_fetch_array($select_Ap);
	$update=("update appointment set status='Declined' where id='$declineId'");
	$result=mysqli_query($conn,$update);
	if($result)
	{
		$doctorName=$row_Ap['doctorName'];
		$select_Ap2=mysqli_query($conn,"select * from appointment where id !='$declineId' and doctorName='$doctorName' order by id asc");
		$row_Ap2=mysqli_fetch_array($select_Ap2);
		$user_email=$row_Ap2['user_email'];
		$second_id=$row_Ap2['id'];
		///////////////////////////////////
		mysqli_query($conn,"update appointment set status='next' where id='$second_id'");
		$selects=mysqli_query($conn,"select * from admin");
		$row=mysqli_fetch_array($selects);
		$systmEmail=$row['systemEmail'];
		$emalPassword=$row['emailPassword'];
		//--------------------------------------------->>
		require 'require/PHPMailer.php';
		require 'require/SMTP.php';
		require 'require/Exception.php';
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		$mail->isSMTP();
		$mail->Host ='smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure="tls";
		$mail->Username = $systmEmail;
		$mail->Password = $emalPassword;
		$mail->Port = "587";
		$mail->setFrom($systmEmail,"NIT Health Supportive System");
		$mail->addAddress($user_email);
		$mail->isHTML(true);
		$mail->Subject = 'No reply';
		$mail->Body = '<div style="font-size:15px;">Dear,&nbsp;<label style="font-size:16px;color:green;font-weight:bold">'.$row_Ap2['name'].'</label></div><br>
		<div style="font-size:15px;">You are reminded that your queue is approaching so move to the hospital area please..
		<div><br>
		If you did not make any appointment, please ignore this email.
		</div>
		<br>
		<br>
		<div style="font-size:15px;color:#283747">Thank you for using our system</div></div>';
		if($mail->send())
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
		<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="prox error occur ! there problem on server"; ?></div>
		<?php
	}
}
/////////////////////////////////////////////////////////
if(isset($_POST['deletId']))
{
	$deletId=$_POST['deletId'];
	?>
	<div class="hoverContainer">
		<div class="container deleteConfirmation">
			<div style="padding: 10px;border-bottom:1px solid silver">
				<h5>Confirmation</h5>
			</div>
			<div style="padding: 20px;">
				<p>Are you sure you want to delete this appointment</p>
				<div style="height: 50px;">
					<div style="float: right;">
						<button type="button" class="btn btn-info closeViewAppoCont"><i class="fas fa-times"></i>&nbsp;No</button>
						<button type="button" class="btn btn-danger yesBtn"><i class="fas fa-check"></i>&nbsp;Yes</button>
					</div>
				</div>
			</div>
			<input type="text" name="deletId2" id="deletId2" value="<?php echo $deletId; ?>" style="display: none;">
		</div>
	</div>
	<?php
}
//////////////////////////////////////
if(isset($_POST['deletId2']))
{
	$deletId2=$_POST['deletId2'];
	mysqli_query($conn,"delete from approved_appointment where id='$deletId2'");
}
////////////////////////////////////////
if(isset($_POST['uId']))
{
	$uId=$_POST['uId'];
	$token=$_POST['token'];
	$appoId_d=$_POST['appoId_d'];
	?>
	<script type="text/javascript">
		window.location.href=("send_description_to_pharmacist?id=<?php echo $uId; ?>&token=<?php echo $token; ?>&appointment_id=<?php echo $appoId_d; ?>");
	</script>
	<?php
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".closeViewAppoCont").on('click',function(){
			$(".hoverContainer").slideUp("slow");
		});
		/////////////////////////////////
		$(".closeContainer").on('click',function(){
			$(".hoverContainer3").slideUp("slow");
		});
		/////////////////////////////////
		setTimeout(function(){
			$("#loadContent").hide(700);
			$("#showContent").show(700);
		},4000);
		//////////////////////////////////
		$(".sndFdback").on('click',function(){
			if($(".sendFeedbackCont").css("display")=="none")
			{
				$(".sendFeedbackCont").slideDown("slow");
				$(".chevron_s_appointment").css("transform",'rotate(180deg)');
			}
			else{
				$(".sendFeedbackCont").slideUp("slow");
				$('.chevron_s_appointment').css('transform','rotate(0deg)');
			}
		});
		////////////////////////////////////////
		$(".sendFeedbackBtn").click(function(){
			var fdBackId=$(this).attr("id");
			var feedback=$("#feedback").val();
			$.ajax({
				url:"ajax/view_appointment/query.php",
				method:"post",
				data:{fdBackId:fdBackId,feedback:feedback},
				success:function(data)
				{
					$(".displaySendFdBackRslt").html(data);
				}
			});
		});
		////////////////////////////////////////
		$(".approveBtn").click(function(){
			var id=$("#id").val();
	    	var token=$("#token").val();
	    	var appoId_d=$("#appoId_d").val();
	    	$.ajax({
				url:"ajax/view_appointment/query.php",
				method:"post",
				data:{uId:id,token:token,appoId_d:appoId_d},
				success:function(data)
				{
					$(".resultCont").html(data);
				}
			});
		});
		////////////////////////////////////////
		$(".confirmAppoBtn").click(function(){
			var confId=$(this).attr("id");
			var tokenNo=$("#tokenNo").val();
			$(".confirmBtn_ld").show();
			$(this).hide();
			setTimeout(function(){
				$(".confirmBtn_ld").hide();
			    $(".confirmAppoBtn").show();
			},4000);
			if(tokenNo=="")
			{
				$(".error_t_n").html("*token number required");
				$("#tokenNo").css("border","1px solid red");
			}
			else{
				$(".error_t_n").html("");
				$("#tokenNo").css("border","1px solid silver");
				$.ajax({
					url:"ajax/view_appointment/query.php",
					method:"post",
					data:{confId:confId,tokenNo:tokenNo},
					success:function(data)
					{
						$(".displayResult").html(data);
					}
				});
			}
		});
		////////////////////////////////////////
		$(".declineBtn").click(function(){
			var declineId=$(this).attr("id");
			$(".declineBtn_ld").show();
			$(this).hide();
			setTimeout(function(){
				$(".declineBtn_ld").hide();
			    $(".declineBtn").show();
			},4000);
			$.ajax({
				url:"ajax/view_appointment/query.php",
				method:"post",
				data:{declineId:declineId},
				success:function(data)
				{
					$(".displayResult").html(data);
				}
			});
		});
	    $(".yesBtn").on('click',function(){
	    	var deletId2=$("#deletId2").val();
	    	$.ajax({
	    		url:"ajax/view_appointment/query.php",
	    		method:"post",
	    		data:{deletId2:deletId2},
	    		success:function()
	    		{
	    			window.location.reload();
	    			updateApprovedAppoTable();
	    		}
	    	});
	    });
	    function updateApprovedAppoTable(){
	    	var doctorId=$("#doctorId").val();
	    	$.ajax({
	    		url:"ajax/updateTable/updateApprovedAppTable.php",
	    		method:"post",
	    		data:{doctorId:doctorId},
	    		success:function(data)
	    		{
	    			$("#viewAppoTable2").html(data);
	    		}
	    	});
	    }
	});
</script>
