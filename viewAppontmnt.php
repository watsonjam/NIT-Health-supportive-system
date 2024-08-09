<?php 
include("includes/db_connection.php");
include("includes/security2.php");
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
	</style>
</head>
<?php
include("includes/doctor_header.php");
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
										$selectDt=mysqli_query($conn,"select * from appointment where doctorId='$dId' and status !='Declined' order by id asc");
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
											else if(empty($rwDt['feedback']))
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
											else{echo"";}
											$i++;
										}
										?>
									</tbody>
								</table>
							</div>
							<input type="text" name="id" id="id" value="<?php echo $id; ?>" style="display: none;">
							<input type="text" name="token" id="token" value="<?php echo $token; ?>" style="display: none;">
						</div>						
					</div>
				</div>
			</article>
		</div>
	</div>
	<div class="displayViewAppoRslt"></div>
	<div class="displayResultCont"></div>
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
	    	var id=$("#id").val();
	    	var token=$("#token").val();
	    	$.ajax({
	    		url:"ajax/view_appointment/query.php",
	    		method:"post",
	    		data:{appoId_d:appoId_d,id:id,token:token},
	    		success:function(data)
	    		{
	    			$(".displayViewAppoRslt").html(data);
	    		}
	    	});
	    });
	    ////////////////////////////////////
	    setInterval(function(){
	    	$.ajax({
	    		url:"ajax/load/appointment.php",
	    		method:"post",
	    		success:function(data)
	    		{
	    			$(".displayResultCont").html(data);
	    		}
	    	});
	    });
	    ////////////////////////////////////
		setTimeout(function(){
			$(".loadingRecord").hide();
			$(".loadBody").hide();
			$(".recordBody").show();
		},4000);
	});
</script>