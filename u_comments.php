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
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Users Comments</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="container mainContainer" id="mainContainer" style="margin-top:-12px;padding: 10px;">
                        <div>
							<div id="goTop" title="Go back to Top"><a href=""><i class="fas fa-angle-double-up fa-2x"></i></a></div>
							<div>
								<?php
								$doctor_name=$row['fullName'];
								$select_c=mysqli_query($conn,"select * from users_comment where doctor_name='$doctor_name' order by id desc");
								$num_rws=mysqli_num_rows($select_c);
								?>
								<div style="padding: 10px;border-bottom:1px solid silver">
									<div style="float: right;" class="closeViewAppoCont">
										<b>Total Comments &nbsp;<?php echo $num_rws; ?></b>
									</div>
									<h5>Users Comments</h5>
								</div>
								<div>
									<?php
									while($row_c=mysqli_fetch_array($select_c))
									{
										?>
										<div  style="padding: 20px;line-height:35px;border-bottom: 10px;">
											<div style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,.5);padding: 10px">
												<div>Patient Name:&nbsp;&nbsp;<b><?php echo $row_c['user_name']; ?></b><span style="margin-left: 50px;"><time class="timeAgo" datetime="<?php echo $row_c['timestamp']; ?>"></span></div><hr>
												<div style="padding: 10px;margin-left: 20px;">
													<div style="word-wrap: break-word;"><b>Message:</b>&nbsp;&nbsp;<?php echo $row_c['comment']; ?></div>
												</div>
												<hr>
												<div style="height: 50px;">
													<div style="float: right;"><button type="button" class="btn btn-danger deleteCommBtn" id="<?php echo $row_c['id']; ?>"><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Delete</button></div>
												</div>
											</div>
										</div>
										<?php
									}
									?>
								</div>
							</div>						
						</div>
					</div>
				</div>
			</article>
		</div>
	</div>
	<div class="showDeleteResult"></div>
</body>
</html>
<script type="text/javascript">
	$("time.timeAgo").timeago();
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
	    ///////////////////////////////////////////
	    $(".deleteCommBtn").on('click',function(){
	    	var commentId=$(this).attr("id");
	    	$.ajax({
	    		url:"ajax/query.php",
	    		method:"post",
	    		data:{commentId:commentId},
	    		success:function(data)
	    		{
	    			$(".showDeleteResult").html(data);
	    		}
	    	});
	    });
	});
</script>