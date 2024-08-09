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
		.showContent{display: none;}
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
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Send Comment</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="container mainContainer" id="mainContainer" style="margin-top:-12px;padding: 10px;">
						<div id="goTop" title="Go back to Top"><a href=""><i class="fas fa-angle-double-up fa-2x"></i></a></div>
						 <div>
							<div style="padding: 10px;border-bottom: 2px solid silver;background-color: lavender;" class="viewAppoHd">
								<h5>Send Comment to Doctor</h5>
							</div>
							<div style="margin-top: 20px;">
								<div class="displayRslt"></div>
								<div style="padding: 10px;">
									<form>
										<div>
											<label style="font-weight: 400">Select Doctor Name to send comment:</label>
											<div class="formControlCont">
												<select name="doctorName" id="doctorName" class="form-control">
													<option></option>
													<?php
													$select=mysqli_query($conn,"select * from doctors");
													while($rwDctName=mysqli_fetch_array($select))
													{
														?>
														<option><?php echo $rwDctName['fullName']; ?></option>
														<?php
													}
													?>
												</select>
											</div>
											<input type="text" name="username" id="username" value="<?php echo $row['fullName']; ?>" style="display: none;">
										</div><br>
										<div class="showContent">
											<div>
												<label style="font-weight: 500;">Write your Comment</label>
												<div class="formControlCont controls">
													<textarea class="form-control comment" name="comment" id="comment" style="height: 200px;"></textarea>
													<label class="text-danger d_n_error"></label>
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12"></div>
												<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
													<button type="button" class="btn btn-info sendCommBtn" style="width: 100%;">Submit</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article>
		</div>
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
	    ///////////////////////////////////////
	    $("#doctorName").on('change',function(){
	    	var doctorName=$(this).val();
	    	if(doctorName=="")
	    	{
	    		$(".showContent").slideUp("slow");
	    	}
	    	else
	    	{
	    		$(".showContent").slideDown("slow");
		    }
	    });
	    ///////////////////////////////////////////
	    $(".sendCommBtn").on('click',function(){
	    	var doctorName=$("#doctorName").val();
	    	var comment=$("#comment").val();
	    	var username=$("#username").val();
	    	if(comment=="")
	    	{
	    		$(".d_n_error").html("*please enter your comment");
	    		$("#comment").css("border","1px solid red");
	    	}
	    	else
	    	{
	    		$(".d_n_error").html("");
	    		$("#comment").css("border","1px solid silver");
		    	$.ajax({
		    		url:"ajax/query.php",
		    		method:"post",
		    		data:{doctorName:doctorName,comment:comment,username:username},
		    		success:function(data)
		    		{
		    			$(".displayRslt").html(data);
		    		}
		    	});
		    }
	    });
	});
</script>