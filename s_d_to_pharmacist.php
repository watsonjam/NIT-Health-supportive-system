<?php 
include("includes/db_connection.php");
include("includes/security2.php");
$appoId_d=$_GET['appointment_id'];
$selectDt=mysqli_query($conn,"select * from appointment where id='$appoId_d'");
$rwData=mysqli_fetch_array($selectDt);
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include("includes/head.php");
	?>
	<title>NIT Health Supportive System</title>
	<style type="text/css">
		.btnAction{cursor: pointer;color: #E74C3C}
		.btnAction:active{color: white;}
		.openAppoBtn{color: #3498DB}
		.loadingRecord{position: absolute;margin-top: 100px;z-index: 10;background-color: white;padding: 6px;box-shadow: 0px 0px 20px 0px rgba(0,0,0,.5);border-radius: 3px;border:1px solid silver;font-weight: bold;color: darkslategray}
		.recordBody{display: none;}
		.hoverContainer3{position: fixed;width: 100%;top: 0px;left: 0px;float: none;margin: 0px;height: 100%;background-color: rgba(0,0,0,.6);z-index: 130;display: block;}
		.sendDescriptionToPhrmacistCont{width: 70%;background-color: white;box-sizing: content-box;border:1px solid silver;box-shadow: 0px 0px 50px 0px rgba(0,0,0,.4);border-radius: 4px;margin-top: 1%;}
		#description_d{height: 350px;}
	</style>
</head>
<?php
include("includes/doctor_header.php");
if(isset($_POST['sendDescriptionBtn']))
{
	$approveId=$_POST['approveId'];
	$description_d=$_POST['description_d'];
	$disease_d=$_POST['disease'];
	$error="";
	$success="";
	if(empty($description_d) || empty($disease))
	{
		$error='please write a description and disease';
	}
	else
	{
		$selectdisease=mysqli_query($conn,"select * from diseases where disease_name='$disease'");
		$resultdisease=mysqli_fetch_array($selectdisease);
		if($resultdisease['disease_name'] == $disease){
			
			$datedisease=date("n");
			$q1= $resultdisease['quater1']+1;
			$q2= $resultdisease['quater2']+1;
			$q3= $resultdisease['quater3']+1;
			$q4= $resultdisease['quater4']+1;
			$total = $resultdisease['total_cases']+1;
			if($datedisease == 1 || $datedisease == 2 || $datedisease == 3){
                $l = mysqli_query($conn, "update diseases set quater1 = '$q1', total_cases = '$total' where disease_name ='$disease'");
			}elseif($datedisease == 4 || $datedisease == 5 || $datedisease == 6){
				$l = mysqli_query($conn, "update diseases set quater2 = '$q2', total_cases = '$total' where disease_name='$disease'");
			}elseif($datedisease == 7 || $datedisease == 8 || $datedisease == 9){
				$l = mysqli_query($conn, "update diseases set quater3 = '$q3', total_cases = '$total' where disease_name='$disease'");
			}else{
				$l = mysqli_query($conn, "update diseases set quater4 = '$q4', total_cases = '$total' where disease_name='$disease'");
			}
		}
		//////////////////////////////////////////////////////////////////////////////////////
		if ($l) {
		    $second_id=$approveId+1;
		$select=mysqli_query($conn,"select * from appointment where id='$approveId'");
		$result=mysqli_fetch_array($select);
		$selectId=mysqli_query($conn,"select id from approved_appointment order by id desc");
		$rslt=mysqli_fetch_array($selectId);
		$id=$rslt[0]+1;
		$userId=$result['userId'];
		$name=$result['name'];
		$doctorName=$result['doctorName'];
		$doctorId=$result['doctorId'];
		$status="New";
		$user_email=$result['user_email'];
		$time=date("h:i a");
		$date=date("d/m/Y");
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
	    $mail->addAddress($user_email);
	    $mail->isHTML(true);
	    $mail->Subject = 'No reply';
	    $mail->Body = '<div style="font-size:17px;font-weight:bold;color:green">Token Number</div><br>
	    <div style="font-size:15px;">Dear,&nbsp;<label style="font-weight:bold">'.$name.',</label>
	    <br><br>
	    These tokens will serve as your identity when you get to the Parmacist thank you
	    <br>
	    <div style="margin-top:10px;"><i>NB:Do not delete this Email as the Parmacist will not be able to identify you.</i></div>
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
			$insert=("insert into approved_appointment(id,userId,name,user_email,doctorName,doctorId,description,token_no,status,time,date) values('$id','$userId','$name','$user_email','$doctorName','$doctorId','$description_d','$token_no','$status','$time','$date')");
			$qry=mysqli_query($conn,$insert);
			if($qry)
			{
				mysqli_query($conn,"delete from appointment where id='$approveId'");
				$success='appointment successfully approved';
			}
			else{
				$error='prox error occur';
			}
		}
		else
		{
			$error='<li>There problem on server</li>
					<b>OR</b>
					<li>Check your internet connection</li>
				</ul>';
		    }	
		}
	}
}
?>
<body class="system-body">
	<div class="row">
		<div class="col-md-3">
			<?php
			include("includes/aside_doctor.php");
			?>
		</div>
		<div class="col-md-9">
			<div class="pathMaincont">
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Appointments</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="container mainContainer" id="mainContainer" style="margin-top:-12px;padding: 10px;">
                        <div>
							<div id="goTop" title="Go back to Top"><a href=""><i class="fas fa-angle-double-up fa-2x"></i></a></div>
							<div style="padding: 10px;border-bottom: 2px solid silver;background-color: lavender;cursor: pointer;">
									<h5>Patients Appointments</h5>
							</div>
							<div style="margin-top: 20px;">
								<table class="table table-hover table-striped table-bordered" id="viewAppoTable">
									<thead>
										<th>S/n</th>
										<th>Patient Name</th>
										<th>Date</th>
										<th>Time</th>
										<th>Status</th>
										<th><center>Action</center></th>
									</thead>
									<tbody class="loadBody">
										<div class="loadingRecord"><img src="images/icons/lod.gif" style="height: 20px;">&nbsp;&nbsp;Loading records ........</div>
									</tbody>
									<tbody style="font-size: 16px;" class="recordBody">
										<?php
										$i=1;
										$dId="doctor".$id;
										$selectDt=mysqli_query($conn,"select * from appointment where doctorId='$dId' order by id asc");
										while($rwDt=mysqli_fetch_array($selectDt))
										{
											if($rwDt['status']=="confirmed")
											{
											?>
												<tr style="background-color: #82E0AA">
													<td><?php echo $i; ?></td>
													<td><?php echo $rwDt['name']; ?></td>
													<td><?php echo $rwDt['date']; ?></td>
													<td><?php echo $rwDt['time']; ?></td>
													<td><center><img src="images/icons/loadingIcn.svg" style="height: 25px;">&nbsp;&nbsp;In Action</center></td>
													<td>
														<center>
															<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
														</center>
													</td>
												</tr>
											<?php
											}
											else if($rwDt['status']=="next")
											{
												?>
												<tr style="background-color:#F9E79F">
													<td><?php echo $i; ?></td>
													<td><?php echo $rwDt['name']; ?></td>
													<td><?php echo $rwDt['date']; ?></td>
													<td><?php echo $rwDt['time']; ?></td>
													<td><center><img src="images/icons/facebook_loading.svg" style="height: 30px;">&nbsp;&nbsp;Next</center></td>
													<td>
														<center>
															<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
														</center>
													</td>
												</tr>
												<?php
											}
											else
											{
												?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $rwDt['name']; ?></td>
													<td><?php echo $rwDt['date']; ?></td>
													<td><?php echo $rwDt['time']; ?></td>
													<td><center><img src="images/icons/progress_2.svg" style="height: 30px;"><?php echo $rwDt['status']; ?></center></td>
													<td>
														<center>
															<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
														</center>
													</td>
												</tr>
												<?php
											}
											$i++;
										}
										?>
									</tbody>
								</table>
							</div>
						</div>						
					</div>
				</div>
			</article>
		</div>
	</div>
	<div class="hoverContainer3">
		<div class="container sendDescriptionToPhrmacistCont">
			<div style="padding: 10px;border-bottom: 2px solid silver">
				<div style="float: right;">
					<a href="appointment?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><label style="cursor: pointer;" class="text-danger"><i class="fas fa-times"></i></label></a>
				</div>
				<h5>Send Description about Patient to Pharmacist</h5>
			</div>
			<?php
			if(isset($_POST['sendDescriptionBtn']))
			{
				if($error)
				{
				?>
				<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-top: 10px;border-radius: 4px;margin-bottom: 10px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error; ?>
				</div>
				<?php
				}
				if($success)
				{
				?>
				<div style="color: #2f3a48;padding: 7px;background-color: #A9DFBF;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-top: 10px;border-radius: 4px;margin-bottom: 10px;"><i class="fas fa-check-circle" style="font-size: 18px;color: #229954;"></i>&nbsp;&nbsp;<?php echo $success; ?></div>
				<?php
				}
			}
			?>
			<div style="padding: 20px;">
				<form class="descriptionForm" method="post">
					<div>
						<label style="font-weight: 500;">Patient Name:&nbsp;&nbsp;<b><?php echo $rwData['name']; ?></b></label>
					</div>
					<div>
							<label><b>Disease:</b></label>
							<input type="text" name="disease" id="disease" style="width: 40%; height: 25px;" class="form-control disease" autocomplete="off">
					</div><hr>
					<div>
						<label style="font-weight: 500;">Write Description</label>
						<div class="formControlCont controls">
							<textarea class="form-control description_d" name="description_d" id="description_d"></textarea>
						</div>
					</div>
					<input type="text" name="approveId" id="approveId" value="<?php echo $appoId_d; ?>" style="display: none;">
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12"></div>
						<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
							<button type="submit" name="sendDescriptionBtn" class="btn btn-info" style="width: 100%;">Send Description</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#viewAppoTable").DataTable();
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
	    /////////////////////////////////////////////////
	    $(".openAppoBtn").on('click',function(){
	    	var appoId_d=$(this).attr("id");
	    	$.ajax({
	    		url:"ajax/view_appointment/query.php",
	    		method:"post",
	    		data:{appoId_d:appoId_d},
	    		success:function(data)
	    		{
	    			$(".displayViewAppoRslt").html(data);
	    		}
	    	});
	    });
	    ////////////////////////////////////
		setTimeout(function(){
			$(".loadingRecord").hide();
			$(".loadBody").hide();
			$(".recordBody").show();
		},4000);
		////////////////////////////////////////////////////////////////
	    tinymce.init({
			/* replace textarea having class .tips with tinymce editor */
			selector: ".description_d",
			/* plugin */
			plugins: [
				"advlist autolink link image lists charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				"save table contextmenu directionality emoticons template paste textcolor"
			],

			/* toolbar */
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
			/* style */
			style_formats: [
				{title: "Headers", items: [
					{title: "Header 1", format: "h1"},
					{title: "Header 2", format: "h2"},
					{title: "Header 3", format: "h3"},
					{title: "Header 4", format: "h4"},
					{title: "Header 5", format: "h5"},
					{title: "Header 6", format: "h6"}
				]},
				{title: "Inline", items: [
					{title: "Bold", icon: "bold", format: "bold"},
					{title: "Italic", icon: "italic", format: "italic"},
					{title: "Underline", icon: "underline", format: "underline"},
					{title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},
					{title: "Superscript", icon: "superscript", format: "superscript"},
					{title: "Subscript", icon: "subscript", format: "subscript"},
					{title: "Code", icon: "code", format: "code"}
				]},
				{title: "Blocks", items: [
					{title: "Paragraph", format: "p"},
					{title: "Blockquote", format: "blockquote"},
					{title: "Div", format: "div"},
					{title: "Pre", format: "pre"}
				]},
				{title: "Alignment", items: [
					{title: "Left", icon: "alignleft", format: "alignleft"},
					{title: "Center", icon: "aligncenter", format: "aligncenter"},
					{title: "Right", icon: "alignright", format: "alignright"},
					{title: "Justify", icon: "alignjustify", format: "alignjustify"}
				]}
			]
		});
	});
</script>
