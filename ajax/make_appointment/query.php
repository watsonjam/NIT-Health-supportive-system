<style type="text/css">
	.hoverContainer{
		position: fixed;
		width: 100%;
		top: 0px;
		left: 0px;
		float: none;
		margin: 0px;
		height: 100%;
		background-color: rgba(0,0,0,.1);
		z-index: 100;
	}
	.viewAppoContainer{
		width: 50%;
		background-color: white;
		box-sizing: content-box;
		border:1px solid silver;
		box-shadow: 0px 0px 30px 0px rgba(0,0,0,.4);
		border-radius: 4px;
		margin-top: 3%;
	}
	.deleteConfirmation{
		width: 40%;
		background-color: white;
		box-shadow:0px 30px 15px rgba(0,0,0,.6);
		margin-top: 7%;
		border-radius: 4px;
		box-sizing: content-box;
		position: relative;
		animation: 1s deleteConfirmation
	}
	@keyframes deleteConfirmation{
		from{top:-300px;opacity: 0px;}
		to{top:0px;opacity: 1}
	}
</style>
<?php
//database connection
include("db_connection/db_connection.php");
if(isset($_POST['appoId']))
{
	$appoId=$_POST['appoId'];
	?>
	<div class="hoverContainer">
		<div class="container viewAppoContainer">
			<div id="loadContent">
				<div style="height: 370px;">
					<div style="margin-top: 250px;">
						<center><img src="images/icons/lod.gif" height="100" width="100"></center>
					</div>
				</div>
			</div>
			<div style="display: none;" id="showContent">
				<div style="padding: 10px;border-bottom:1px solid silver">
					<div style="float: right;cursor: pointer" class="text-danger closeViewAppoCont">
						<i class="fas fa-times"></i>
					</div>
					<h5>Appointment</h5>
				</div>
				<div>
					<?php
					$selectDt=mysqli_query($conn,"select * from appointment where id='$appoId'");
					$nm_rw=mysqli_num_rows($selectDt);
						$rwData=mysqli_fetch_array($selectDt);
						?>
						<div  style="padding: 20px;line-height:35px;">
							<div>Doctor Name:&nbsp;&nbsp;<b><?php echo $rwData['doctorName']; ?></b><span style="margin-left: 50px;"><?php echo $rwData['date']; ?>&nbsp;&nbsp; at &nbsp;&nbsp;<?php echo $rwData['time']; ?></span></div><hr>
							<div style="padding: 5px;margin-left: 20px;">
								<div><b>Description:</b>&nbsp;&nbsp;<?php echo $rwData['description']; ?></div>
							</div>
							<hr>
						</div>
						<?php
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
/////////////////////////////////////////////////////////////
if(isset($_POST['appoId_d']))
{
	$appoId_d=$_POST['appoId_d'];
	?>
	<div class="hoverContainer">
		<div class="container deleteConfirmation">
			<div style="padding: 10px;border-bottom:1px solid silver">
				<h5>Confirmation</h5>
			</div>
			<div style="padding: 20px;">
				<p>Are you sure you want to delete this appointment</p>
				<div style="height: 50px;">
					<div style="float: right;">
						<button type="button" class="btn btn-info closeViewAppoCont"><i class="fas fa-times"></i>&nbsp;No</button>
						<button type="button" class="btn btn-danger yesBtn"><i class="fas fa-check"></i>&nbsp;Yes</button>
					</div>
				</div>
			</div>
			<input type="text" name="appoId2" id="appoId2" value="<?php echo $appoId_d; ?>" style="display: none;">
		</div>
	</div>
	<?php
}
//////////////////////////////////////////////
if(isset($_POST['appoId2']))
{
	$appoId2=$_POST['appoId2'];
	$deleteDt=("delete from appointment where id='$appoId2'");
	$rslt=mysqli_query($conn,$deleteDt);
	if($rslt)
	{
		?>
		<script type="text/javascript">
			$(".hoverContainer").slideUp("slow");
		</script>
		<?php
	}
	else{
		echo"prox error occur";
	}
}
////////////////////////////////////////////////////
if(isset($_POST['u_Id']))
{
    $doctorName=$_POST['doctorName'];
    $select=mysqli_query($conn,"select * from setting where doctor_name='$doctorName'");
    $row_query=mysqli_fetch_array($select);
    if($row_query['status']=="Off")
    {
        ?>
        <script type="text/javascript">
            $(".showContentCont").slideUp("slow");
            $("#s_doctor").css("border","1px solid red");
        </script>
        <label class="text-danger">*you can't make an appointment for this doctor because he has an emergency</label>
        <?php
    }
    else if(empty($doctorName))
    {
    	?>
        <script type="text/javascript">
            $(".showContentCont").slideUp("slow");
            $("#s_doctor").css("border","1px solid red");
        </script>
        <label class="text-danger">*please select doctor name</label>
        <?php
    }
    else
    {
        ?>
        <script type="text/javascript">
            $(".showContentCont").slideDown("slow");
            $("#s_doctor").css("border","1px solid silver");
        </script>
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
		$(".yesBtn").on('click',function(){
			var appoId2=$("#appoId2").val();
			$.ajax({
				url:"ajax/make_appointment/query.php",
				method:"post",
				data:{appoId2:appoId2},
				success:function(data)
				{
					updateAppoTable();
					$("#viewAppoTable").html(data);
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
	});
	//javacript
	function showContrDetails()
	{
		document.getElementById('loadContent').style.display="none";
		document.getElementById('showContent').style.display="block";
	}
	setTimeout("showContrDetails()",4000);
</script>