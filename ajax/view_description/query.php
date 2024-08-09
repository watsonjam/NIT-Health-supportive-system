<style type="text/css">
	.hoverContainer{position: fixed;width: 100%;top: 0px;left: 0px;float: none;margin: 0px;height: 100%;background-color: rgba(0,0,0,.1);z-index: 100;}
	.viewAppointmentContainer{width: 70%;background-color: white;box-sizing: content-box;border:1px solid silver;box-shadow: 0px 0px 30px 0px rgba(0,0,0,.4);border-radius: 4px;margin-top: 1%;}
	.hoverContainer2{position: fixed;width: 100%;top: 0px;left: 0px;float: none;margin: 0px;height: 100%;background-color: black;z-index: 120;}
	.viewAppointmentContainer2{width: 35%;background-color: white;box-sizing: content-box;border:1px solid silver;box-shadow: 0px 0px 30px 0px rgba(23, 32, 42);border-radius: 4px;margin-top: 10%;}
</style>
<?php
//database connection
include("db_connection/db_connection.php");
if(isset($_POST['desc_id']))
{
	$desc_id=$_POST['desc_id'];
	?>
	<div class="hoverContainer">
		<div class="container viewAppointmentContainer">
			<div id="loadContent">
				<div style="height: 370px;">
					<div style="margin-top: 250px;">
						<center><img src="images/icons/lod.gif" height="100" width="100"></center>
					</div>
				</div>
			</div>
			<div style="display: none;" id="showContent">
				<?php
				$select=mysqli_query($conn,"select * from approved_appointment where id='$desc_id'");
				$rwData=mysqli_fetch_array($select);
				?>
				<div style="padding: 10px;border-bottom:1px solid silver">
					<div style="float: right;cursor: pointer" class="text-danger closeViewAppoCont">
						<i class="fas fa-times"></i>
					</div>
					<h5>Patient Description from the Doctor</h5>
				</div>
				<div>
					<div  style="padding: 20px;line-height:35px;">
						<div style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,.5);padding: 10px">
							<div>Patient Name:&nbsp;&nbsp;<b><?php echo $rwData['name']; ?></b><span style="margin-left: 50px;"><?php echo $rwData['date']; ?>&nbsp;&nbsp; at &nbsp;&nbsp;<?php echo $rwData['time']; ?></span></div><hr>
							<div style="padding: 10px;margin-left: 20px;">
							<hr>
								<h5>Description and Diagnosis:</h5>
								<div><?php echo $rwData['description']; ?></div>
							</div>							
						</div>
					</div>
				</div>
				<div class="hoverContainer2" <?php if($rwData['status']=="New"){echo 'style="display:block"';}else{echo'style="display:none"';} ?>>
					<div class="container viewAppointmentContainer2">
						<div style="padding: 10px;border-bottom: 2px solid silver">
							<div style="float: right;cursor: pointer;" class="text-danger closeCont">
								<i class="fas fa-times"></i>
							</div>
							<h5>Confirm Patient</h5>
						</div>
						<div style="padding: 20px;">
							Patient Name:&nbsp;&nbsp;<b><?php echo $rwData['name']; ?></b><br>
							<div class="displayConfTknResult"></div>
							<div class="row">
								<div class="col-md-9 col-lg-9 col-sm-9 col-xs-9">
									<div class="formControlCont">
										<input type="number" name="tknNo" id="tknNo" class="form-control" autocomplete="off" placeholder="enter patient token no">
									</div>
									<label class="text-danger error"></label>
								</div>
								<div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
									<button type="button" class="btn btn-success confBtn">Confirm</button>
								</div>
								<input type="text" name="desc_id2" id="desc_id2" value="<?php echo $desc_id; ?>" style="display: none;">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
if(isset($_POST['desc_id2']))
{
	$desc_id2=$_POST['desc_id2'];
	$tknNo=$_POST['tknNo'];
	$select=mysqli_query($conn,"select * from approved_appointment where id='$desc_id2'");
	$rw=mysqli_fetch_array($select);
	if($rw['token_no']==$tknNo)
	{
		mysqli_query($conn,"update approved_appointment set status='' where id='$desc_id2'");
		?>
		<script type="text/javascript">
			$(".hoverContainer2").slideUp("slow");
		</script>
		<?php
	}
	else{
		?>
		<script type="text/javascript">$("#tknNo").css("border","1px solid red");</script>
		<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:10px;margin-top: 10"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;invalid token number</div>
		<?php
	}
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".closeViewAppoCont").on('click',function(){
			$(".hoverContainer").slideUp("slow");
		});
		/////////////////////////////////
		$(".closeCont").on('click',function(){
			$(".hoverContainer").slideUp("slow");
			$(".hoverContainer2").slideUp("slow");
		});
		/////////////////////////////////
		$(".confBtn").on('click',function(){
			var tknNo=$("#tknNo").val();
			var desc_id2=$("#desc_id2").val();
			if(tknNo=="")
			{
				$(".error").html("*please enter patient token no");
				$("#tknNo").css("border","1px solid red");
			}
			else
			{
				$(".error").html("");
				$("#tknNo").css("border","1px solid silver");
				$.ajax({
					url:"ajax/view_description/query.php",
					method:"post",
					data:{tknNo:tknNo,desc_id2:desc_id2},
					success:function(data)
					{
						$(".displayConfTknResult").html(data);
					}
				});
			}
		});
		///////////////////////////////
		setTimeout(function(){
			$("#loadContent").hide(700);
			$("#showContent").show(700);
		},4000);
	});
</script>