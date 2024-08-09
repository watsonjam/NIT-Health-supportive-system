<?php 
include("includes/db_connection.php");
include("includes/security3.php");
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
		.btnAction{cursor: pointer;color: #E74C3C}
		.btnAction:active{color: white;}
		.openAppoBtn{color: #3498DB}
		.newSale{position: absolute;color: white;font-family: sans-serif;font-weight: 600;margin-left:180px;display: inline-block;padding:3px 5px;background-color: rgba(69,171,35);font-size: 13px;border-radius: 0px;margin-top: -30px;
		}
		.newSale:after{position: inherit;width: 10;height: 13px;content: ' ';border:11px  solid;border-color: transparent transparent green transparent;transform:rotate(-40deg);right: 4.7px;margin-top: 5px;z-index: -10;
		}
	</style>
</head>
<?php
include("includes/pharmacist_header.php");
?>
<body class="system-body">
	<div class="row">
		<div class="col-md-3">
			<?php
			include("includes/aside_pharmacist.php");
			?>
		</div>
		<div class="col-md-9">
			<div class="pathMaincont">
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Description from the Doctor</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="container mainContainer" id="mainContainer" style="margin-top:-12px;padding: 10px;">
                        <div>
							<div id="goTop" title="Go back to Top"><a href=""><i class="fas fa-angle-double-up fa-2x"></i></a></div>
							<div style="padding: 20px;">
								<table class="table table-bordered" id="viewAppoTable">
									<thead>
										<th>S/n</th>
										<th>Patient Name</th>
										<th>Date</th>
										<th>Time</th>
										<th><center>Action</center></th>
									</thead>
									<tbody class="loadBody">
										<div class="loadingRecord"><img src="images/icons/lod.gif" style="height: 20px;">&nbsp;&nbsp;Loading records ........</div>
									</tbody>
									<tbody style="font-size: 16px;" class="recordBody">
										<?php
										$i=1;
										$selectDt=mysqli_query($conn,"select * from approved_appointment order by id desc");
										while($rwDt=mysqli_fetch_array($selectDt))
										{
											?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $rwDt['name']; ?></td>
													<td><?php echo $rwDt['date']; ?></td>
													<td><?php echo $rwDt['time']; ?></td>
													<td>
														<center>
															<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
														</center>
														<?php
														if($rwDt['status']=="New")
														{
															echo'<label class="newSale"><i>New</i></label>';
														}
														else{}
														?>
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
			</article>
		</div>
	</div>
	<div class="displayViewAppoRslt"></div>
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
	    ////////////////////////////////////////
	     $(".openAppoBtn").on('click',function(){
	    	var desc_id=$(this).attr("id");
	    	$.ajax({
	    		url:"ajax/view_description/query.php",
	    		method:"post",
	    		data:{desc_id:desc_id},
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
		},2000);
	});
</script>