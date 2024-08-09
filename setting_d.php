<?php 
include("includes/db_connection.php");
include("includes/security2.php");
$select_setting=mysqli_query($conn,"select * from setting where doctor_id='$id'");
$rows_q_s=mysqli_fetch_array($select_setting);
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include("includes/head.php");
	?>
	<title>NIT Health Supportive System</title>
	<style type="text/css">
		/*//---------------------------->>*/
.switch {
  position: relative;
  display: inline-block;
  width: 100px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "Off";
  height: 26px;
  width: 26px;
  top:4px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  padding-top:6px;
  font-size:11px;
  padding-left:4px;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(65px);
  -ms-transform: translateX(65px);
  transform: translateX(65px);
  content:"On";
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
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
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Setting</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="container mainContainer" id="mainContainer" style="margin-top:-12px;padding: 10px;">
                        <div>
							<div id="goTop" title="Go back to Top"><a href=""><i class="fas fa-angle-double-up fa-2x"></i></a></div>
							<div>
								<div style="padding: 10px;cursor: pointer;border-bottom: 1px solid silver" class="aboutSystmHd">
									<div style="float: right;">
										<i class="fas fa-chevron-down chevron_abtsystm"></i>
									</div>
									<h6>Appointment</h6>
								</div>
								<div style="padding: 20px">
									<div>Switch On or Off appointment making clicking the switch button</div>
									<div class="switchSystem" style="margin-top: 10px;">
										<label class="switch">
										  <input type="checkbox" <?php echo $rows_q_s['switch_button']; ?>>
										  <span class="slider round"></span>
										</label>
									</div>
									<input type="text" name="doctor_id" id="doctor_id" value="<?php echo $id; ?>" style="display: none;">
									<input type="text" name="doctor_name" id="doctor_name" value="<?php echo $row['fullName']; ?>" style="display: none;">
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
	    $('.switchSystem input[type="checkbox"]').click(function(){
			if($(this).prop("checked")==true){
				var doctor_id=$("#doctor_id").val();
				var doctor_name=$("#doctor_name").val();
				$.ajax({
					url:"ajax/setting/switch_system.php",
					method:"post",
					data:{"switchOn":'',doctor_id:doctor_id,doctor_name:doctor_name},
					success:function(data){}
				});
			}
			else{
				var doctor_id=$("#doctor_id").val();
				var doctor_name=$("#doctor_name").val();
				$.ajax({
					url:"ajax/setting/switch_system.php",
					method:"post",
					data:{"switchOff":'',doctor_id:doctor_id,doctor_name:doctor_name},
					success:function(data){}
				});
			}

		});
	});
</script>