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
	<style type="text/css">
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
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Analytics</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="container mainContainer" id="mainContainer" style="margin-top:-12px;padding: 10px;">
                        <div>
							<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white" class="viewAppoHd">
								<h5>Analytics</h5>
							</div>
							<div style="margin-top: 20px;">
								<div style="padding: 10px;">
									<form>
										<div class="row">
											<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
												<label style="font-weight: 400">Select Disease to view its analytics:</label>
											</div>
											<div class="col-md-7 col-lg-7 col-sm-7 col-xs-12">
												<select name="diseaseName" id="diseaseName" class="form-control">
													<option></option>
													<?php
													$select=mysqli_query($conn,"select * from diseases");
													while($rwDiseaseName=mysqli_fetch_array($select))
													{
														?>
														<option><?php echo $rwDiseaseName['disease_name']; ?></option>
														<?php
													}
													?>
												</select>
												<label class="text-danger d_n_error"></label>
											</div>
											<div class="col-md-2 col-lg-2 col-sm-2 col-xs-12">
												<button type="button" class="btn btn-info searchQueueBtn"><i class="fas fa-eye"></i>&nbsp;&nbsp;View</button>
											</div>
										</div>
									</form>
								</div>
								
								<div class="displayViewQueueRslt"></div>
								<?php
								$uId="user".$id;
								?>
								<input type="text" name="userId" id="userId" value="<?php echo $uId; ?>" style="display: none;">
							</div>
						</div>
						</div>
						
					</div>
				</div>
			</article>
		</div>
		<div class="displayResult_v_appo"></div>
		<div class="displayDeleteAppoRslt"></div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
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
	    $(".searchQueueBtn").on('click',function(){
	    	var diseaseName=$("#diseaseName").val();
	    	if(diseaseName=="")
	    	{
	    		$(".d_n_error").html("*please select disease from the list");
	    		$("#doctorName").css("border","1px solid red");
	    	}
	    	else
	    	{
	    		$(".d_n_error").html("");
	    		$("#diseaseName").css("border","1px solid silver");
		    	$.ajax({
		    		url:"ajax/ajaxAnalytics.php",
		    		method:"post",
		    		data:{diseaseName:diseaseName},
		    		success:function(data)
		    		{
		    			$(".displayViewQueueRslt").html(data);
		    		}
		    	});
		    }
	    });
	});
</script>