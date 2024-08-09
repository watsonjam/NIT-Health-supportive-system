<?php 
include("includes/db_connection.php");
include("includes/security2.php");
if(isset($_POST['sendDescriptionBtn']))
{
	$d_id=$_POST['d_id'];
	$description_d=$_POST['description_d'];
	$error="";
	$success="";
	$dId="doctor".$id;
	if(empty($description_d))
	{
		$error='please write a report';
	}
	else
	{
		$select=mysqli_query($conn,"select * from doctors where id='$d_id'");
		$result=mysqli_fetch_array($select);
		$selectId=mysqli_query($conn,"select id from report order by id desc");
		$rslt=mysqli_fetch_array($selectId);
		$id=$rslt[0]+1;
		$name=$result['fullName'];
		$status="New";
		$time=date("h:i a");
		$date=date("d/m/Y");
		$insert=("insert into report(id,doctor_name,doctorId,report,status,time,date) values('$id','$name','$dId','$description_d','$status','$time','$date')");
		$qry=mysqli_query($conn,$insert);
		if($qry)
		{
			$success='successfully';
		}
		else{
			$error='prox error occur';
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include("includes/head.php");
	?>
	<title>NIT Health Supportive System</title>
	<style type="text/css">
		#description_d{height: 500px;}
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
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Generate Report</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="container mainContainer" id="mainContainer" style="margin-top:-12px;padding: 10px;">
                        <div>
							<div id="goTop" title="Go back to Top"><a href=""><i class="fas fa-angle-double-up fa-2x"></i></a></div>
							<div>
								<div class="container sendDescriptionToPhrmacistCont">
									<div style="padding: 10px;border-bottom: 2px solid silver">
										
										<h5>Generate Report</h5>
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
												<label style="font-weight: 500;">Write Report</label>
												<div class="formControlCont controls">
													<textarea class="form-control description_d" name="description_d" id="description_d"></textarea>
												</div>
											</div>
											<input type="text" name="d_id" id="d_id" value="<?php echo $id; ?>" style="display: none;">
											<div class="row" style="margin-top: 10px;">
												<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12"></div>
												<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
													<button type="submit" name="sendDescriptionBtn" class="btn btn-info" style="width: 100%;">Submit</button>
												</div>
											</div>
										</form>
									</div>
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