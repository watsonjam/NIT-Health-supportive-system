<?php 
include("includes/db_connection.php");
include("includes/security4.php");
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include("includes/head.php");
	?>
	<style type="text/css">
		.m_aError{display: none;}
		.btnAction{cursor: pointer;color: #E74C3C}
		.btnAction:active{color: white;}
		.openAppoBtn{color: #3498DB}
		.viewAppo{display: none;}
		.loadingRecord{position: absolute;margin-top: 100px;z-index: 10;background-color: white;padding: 6px;box-shadow: 0px 0px 20px 0px rgba(0,0,0,.5);border-radius: 3px;border:1px solid silver;font-weight: bold;color: darkslategray}
		.m_ABtn_ld,
		.showContentCont,
		.recordBody{display: none;}
		.hoverContainer_not{position: fixed;top:0px;left: 0px;margin: 0px;background-color: rgba(0,0,0,.4);width: 100%;height: 100%;z-index: 100;display: none;}
		.notificationContainer{width: 35%;background-color: white;margin-top: 10%;border:1px solid silver;box-shadow: 0px 0px 30px 0px rgba(0,0,0,.4);border-radius: 3px;}
	</style>
</head>
<?php
include("includes/users_header.php");
?>
<body class="system-body">
	<div class="row">
		<div class="col-md-3">
			<?php
			include("includes/aside_users.php");
			?>
		</div>
		<div class="col-md-9">
			<div class="pathMaincont">
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Make Appointment</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="container mainContainer" id="mainContainer" style="margin-top:-12px;padding: 10px;">
                        <div>
							<div id="goTop" title="Go back to Top"><a href=""><i class="fas fa-angle-double-up fa-2x"></i></a></div>
							<div>
								<div style="padding: 10px;border-bottom:2px solid silver;cursor: pointer;background-color: lavender" class="m_appoHd">
									<div style="float: right;cursor: pointer;">
										<i class="fas fa-chevron-down chevron_m_appointment"></i>
									</div>
									<h5>Make Appointment</h5>
								</div>
								<div style="margin-top: 20px;padding: 15px;" class="makeAppo">
									<div class="displayResult_m_Appointment"></div>
									<form class="m_AForm">
										<div class="row">
											<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
												<label>Name</label>
												<div class="form-group formCotrolCont">
													<input type="text" name="name" id="name" class="form-control" value="<?php echo $row['fullName']; ?>" readonly style="background-color: lavender;border:1px solid silver">
												</div>
											</div>
										</div><br />
										<div class="row">
											<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
												<label>Select Doctor *</label>
												<div class="form-group formCotrolCont">
													<select name="s_doctor" id="s_doctor" class="form-control">
														<option></option>
														<?php
														$select=mysqli_query($conn,"select * from doctors where details='added'");
														while($rw=mysqli_fetch_array($select))
														{
															?>
															<option><?php echo $rw['fullName']; ?></option>
															<?php
														}
														?>
													</select>
													<span class="text-danger m_aError s_doctor">*please select doctor</span>
												</div>
												<div class="displayResult_Cnt"></div>
											</div><br />
										</div>
										<div class="showContentCont">
											<div class="row">
												<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
													<label>Description *</label>
													<div class="form-group formCotrolCont">
														<textarea name="text_a" id="text_a" class="form-control" style="height: 70px;"></textarea>
														<span class="text-danger m_aError text_a">*description required</span>
													</div>
													
												</div><br>
											</div>
											<div class="row">
												<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
												</div>
												<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12"> 
													<button type="button" class="btn btn-info m_ABtn" style="width: 100%">Submit Appointment</button>
													<button type="button" class="btn btn-info m_ABtn_ld" style="width: 100%"><img src="images/icons/lod.gif" style="height: 22px;">&nbsp;&nbsp; Please wait......</button>
												</div>
											</div>
										</div>
										<input type="text" name="userId" id="userId" value="<?php echo $id; ?>" style="display: none;">
										<input type="text" name="userEmail" id="userEmail" value="<?php echo $row['email']; ?>" style="display: none;">
									</form>
								</div>
								<br><hr><br>
								<div>
									<div style="padding: 10px;border-bottom: 2px solid silver;background-color: lavender;cursor: pointer;" class="viewAppoHd">
										<div style="float: right;cursor: pointer;">
										<i class="fas fa-chevron-down chevron_v_appointment"></i>
									</div>
										<h5>Appointments</h5>
									</div>
									<div class="viewAppo" style="margin-top: 20px;">
										<table class="table table-hover table-striped table-bordered" id="viewAppoTable">
											<thead>
												<th>S/n</th>
												<th>Doctor Name</th>
												<th>Date</th>
												<th>Time</th>
												<th>Status</th>
												<th>Action</th>
											</thead>
											<tbody class="loadBody">
												<div class="loadingRecord"><img src="images/icons/lod.gif" style="height: 20px;">&nbsp;&nbsp;Loading records ........</div>
											</tbody>
											<tbody style="font-size: 16px;" class="recordBody">
												<?php
												$i=1;
												$uId="user".$id;
												$selectDt=mysqli_query($conn,"select * from appointment where userId='$uId' order by id desc");
												while($rwDt=mysqli_fetch_array($selectDt))
												{
													if($rwDt['status']=="confirmed")
													{
													?>
														<tr style="background-color: #82E0AA">
															<td><?php echo $i; ?></td>
															<td><?php echo $rwDt['doctorName']; ?></td>
															<td><?php echo $rwDt['date']; ?></td>
															<td><?php echo $rwDt['time']; ?></td>
															<td><center><img src="images/icons/loadingIcn.svg" style="height: 25px;">&nbsp;&nbsp;In Action</center></td>
															<td>
																<center>
																	<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
																	<label class="btnAction deleteAppo" id="<?php echo $rwDt['id'] ?>" style="margin-left: 5px;"><i class="fas fa-trash-alt"></i></label>
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
															<td><?php echo $rwDt['doctorName']; ?></td>
															<td><?php echo $rwDt['date']; ?></td>
															<td><?php echo $rwDt['time']; ?></td>
															<td><center><img src="images/icons/facebook_loading.svg" style="height: 30px;">&nbsp;&nbsp;Next</center></td>
															<td>
																<center>
																	<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
																	<label class="btnAction deleteAppo" id="<?php echo $rwDt['id'] ?>" style="margin-left: 5px;"><i class="fas fa-trash-alt"></i></label>
																</center>
															</td>
														</tr>
														<?php
													}
													else if($rwDt['status']=="Declined")
													{
														?>
														<tr style="background-color:#F5B7B1">
															<td><?php echo $i; ?></td>
															<td><?php echo $rwDt['doctorName']; ?></td>
															<td><?php echo $rwDt['date']; ?></td>
															<td><?php echo $rwDt['time']; ?></td>
															<td><center><?php echo $rwDt['status']; ?></center></td>
															<td>
																<center>
																	<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
																	<label class="btnAction deleteAppo" id="<?php echo $rwDt['id'] ?>" style="margin-left: 5px;"><i class="fas fa-trash-alt"></i></label>
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
															<td><?php echo $rwDt['doctorName']; ?></td>
															<td><?php echo $rwDt['date']; ?></td>
															<td><?php echo $rwDt['time']; ?></td>
															<td><center>
																<?php
																if(!empty($rwDt['feedback']))
																{
																	?>
																	<label>Feedback &nbsp;&nbsp;<span class="text-info viewFeedback" id="<?php echo $rwDt['id']; ?>" style="cursor: pointer;"><i class="fas fa-eye"></i></span></label>
																	<?php
																}
																else{
																?>
																	<img src="images/icons/progress_2.svg" style="height: 30px;"><?php echo $rwDt['status']; ?>
																	<?php
																}
																?>
															</center></td>
															<div class="feedbackCont"></div>
															<td>
																<center>
																	<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
																	<label class="btnAction deleteAppo" id="<?php echo $rwDt['id'] ?>" style="margin-left: 5px;"><i class="fas fa-trash-alt"></i></label>
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
										<?php
										$uId="user".$id;
										?>
										<input type="text" name="userId" id="userId" value="<?php echo $uId; ?>" style="display: none;">
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</article>
		</div>
		<div class="displayResult_v_appo"></div>
		<div class="displayDeleteAppoRslt"></div>
		<div class="hoverContainer_not">
			<div class="container notificationContainer">
				<div style="padding: 10px;border-bottom: 2px solid silver">
					<div style="float: right;cursor: pointer;" class="text-danger closeNotContainer">
						<i class="fas fa-times"></i>
					</div>
					<h5>Notification</h5>
				</div>
				<div style="padding: 20px;">
					<p>Dear, <b><?php echo $row['fullName']; ?></b></p>
					<div style="word-wrap: break-word;">Please check Token number sent to your Email address which serve as your identity when you get to the Doctor thank you.</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#viewAppoTable").DataTable();
		////////////////////////////////
		$(".closeNotContainer").on('click',function(){
			$(".hoverContainer_not").slideUp("slow");
		});
		///////////////////////////////
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
	    $("#s_doctor").on('change',function(){
	    	var doctorName=$(this).val();
	    	var u_Id=$("#userId").val();
	    	$.ajax({
	    		url:"ajax/make_appointment/query.php",
	    		method:"post",
	    		data:{doctorName:doctorName,u_Id:u_Id},
	    		success:function(data)
	    		{
	    			$('.displayResult_Cnt').html(data);
	    		}
	    	});
	    });
	    ////////////////////////////////
	    $(".m_ABtn").on('click',function(){
	    	$(".m_ABtn_ld").show();
	    	$(this).hide();
	    	setTimeout(function(){
	    		$(".m_ABtn_ld").hide();
	    		$(".m_ABtn").show();
	    	},4000);
	    	$.ajax({
	    		url:"ajax/make_appointment/m_appntmnt.php",
	    		method:"post",
	    		async:false,
	    		data:$(".m_AForm").serialize(),
	    		success:function(data)
	    		{
	    			$(".displayResult_m_Appointment").html(data);
	    			updateAppoTable();
	    		}
	    	});
	    });
	    function updateAppoTable(){
	    	var userId=$("#userId").val();
	    	$.ajax({
	    		url:"ajax/updateTable/upadateAppoTb.php",
	    		method:"post",
	    		data:{userId:userId},
	    		success:function(data)
	    		{
	    			$("#viewAppoTable").html(data);
	    		}
	    	});
	    }
	    /////////////////////////////////
		$('.m_appoHd').on('click',function(){
			if($('.makeAppo').css("display")=="none")
			{
				$('.makeAppo').slideDown(400);
				$('.chevron_m_appointment').css('transform','rotate(180deg)');
				$('.chevron_v_appointment').css('transform','rotate(0deg)');
				$('.viewAppo').slideUp(400);
			}
			else{
				$('.makeAppo').slideUp(400);
				$('.chevron_m_appointment').css('transform','rotate(0deg)');
			}
		});
		/////////////////////////////////
		$('.viewAppoHd').on('click',function(){
			if($('.viewAppo').css("display")=="none")
			{
				$('.viewAppo').slideDown(400);
				$('.chevron_v_appointment').css('transform','rotate(180deg)');
				$('.chevron_v_appointment').css('transform','rotate(0deg)');
				$('.makeAppo').slideUp(400);
			}
			else{
				$('.viewAppo').slideUp(400);
				$('.chevron_v_appointment').css('transform','rotate(0deg)');
			}
		});
		//////////////////////////////////////////////
		$(".openAppoBtn").on('click',function(){
			var appoId=$(this).attr("id");
			$.ajax({
				url:"ajax/make_appointment/query.php",
				method:"post",
				data:{appoId:appoId},
				success:function(data)
				{
					$(".displayResult_v_appo").html(data);
				}
			});
		});
		////////////////////////////////////
		$(".deleteAppo").on('click',function(){
			var appoId_d=$(this).attr("id");
			$.ajax({
				url:"ajax/make_appointment/query.php",
				method:"post",
				data:{appoId_d:appoId_d},
				success:function(data)
				{
					$(".displayDeleteAppoRslt").html(data);
				}
			});
		});
		////////////////////////////////////
		setTimeout(function(){
			$(".loadingRecord").hide();
			$(".loadBody").hide();
			$(".recordBody").show();
		},2000);
		///////////////////////////////////////
		$(".viewFeedback").click(function(e){
	    	var feedbackId=$(this).attr("id");
	    	$.ajax({
	    		url:"ajax/make_appointment/feedback.php",
	    		method:"POST",
	    		data:{
	    			"feedbackId":feedbackId
	    		},
	    		success:function(data)
	    		{
	    			$(".feedbackCont").html(data);
	    			$(".feedbackCont").offset({left:e.pageX,top:e.pageY});
	    			$(this).attr("tr").css("background-color","yellow");
	    		}
	    	});
	    });
	});
</script>