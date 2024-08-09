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
	<title>NIT Health Supportive System</title>
	<style type="text/css">
		.loadingRecord{position: absolute;margin-top: 100px;z-index: 10;background-color: white;padding: 6px;box-shadow: 0px 0px 20px 0px rgba(0,0,0,.5);border-radius: 3px;border:1px solid silver;font-weight: bold;color: darkslategray}
		.recordBody{display: none;}
		.btnAction{cursor: pointer;color:#5DADE2;}
		.btnAction:active{color: white;}
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
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Report</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="container mainContainer" id="mainContainer" style="margin-top:-12px;padding: 10px;">
                        <div>
							<div id="goTop" title="Go back to Top"><a href=""><i class="fas fa-angle-double-up fa-2x"></i></a></div>
							<div>
								<div style="padding: 10px;border-bottom: 2px solid silver;background-color: lavender;cursor: pointer;">
									<h5>Report</h5>
								</div>
								<div style="margin-top: 20px;">
									<table class="table table-hover table-striped table-bordered" id="viewAppoTable">
										<thead>
											<th>S/n</th>
											<th>Doctor Name</th>
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
											$selectDt=mysqli_query($conn,"select * from report order by id desc");
											while($rwDt=mysqli_fetch_array($selectDt))
											{
												?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><?php echo $rwDt['doctor_name']; ?></td>
														<td><?php echo $rwDt['date']; ?></td>
														<td><?php echo $rwDt['time']; ?></td>
														<td><?php echo $rwDt['status']; ?></td>
														<td>
															<center>
																<label class="btnAction reportBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
															</center>
														</td>
													</tr>
												<?php
												$i++;
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</article>
		</div>
	</div>
	<div class="displayReportContainer"></div>
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
	    ////////////////////////////////////
		setTimeout(function(){
			$(".loadingRecord").hide();
			$(".loadBody").hide();
			$(".recordBody").show();
		},4000);
		/////////////////////////////////////
		$(".reportBtn").on('click',function(){
			var reportId=$(this).attr("id");
			$.ajax({
				url:"ajax/query.php",
				method:"post",
				data:{reportId:reportId},
				success:function(data)
				{
					$(".displayReportContainer").html(data);
				}
			});
		});
	});
</script>