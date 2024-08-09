<style type="text/css">
	.loadingRecord{position: absolute;margin-top: 40px;z-index: 10;background-color: white;padding: 6px;box-shadow: 0px 0px 20px 0px rgba(0,0,0,.5);border-radius: 3px;border:1px solid silver;font-weight: bold;color: darkslategray}
	.recordBody{display: none;}
</style>
<?php
include("db_connection/db_connection.php");

$userId=$_POST['userId'];
$userId="user".$userId;
?>
<table class="table table-hover table-striped table-bordered" id="viewAppoTable">
	<thead>
		<th>S/n</th>
		<th>Doctor Name</th>
		<th>Date</th>
		<th>Time</th>
		<th>Status</th>
		<th>Action</th>
	</thead>
	<tbody class="loadBody">
		<div class="loadingRecord"><img src="images/icons/lod.gif" style="height: 20px;">&nbsp;&nbsp;Loading records ........</div>
	</tbody>
	<tbody style="font-size: 16px;" class="recordBody">
		<?php
		$i=1;
		$selectDt=mysqli_query($conn,"select * from appointment where userId='$userId' order by id desc");
		while($rwDt=mysqli_fetch_array($selectDt))
		{
			if($rwDt['status']=="confirmed")
			{
			?>
				<tr style="background-color: #82E0AA">
					<td><?php echo $i; ?></td>
					<td><?php echo $rwDt['doctorName']; ?></td>
					<td><?php echo $rwDt['date']; ?></td>
					<td><?php echo $rwDt['time']; ?></td>
					<td><center><img src="images/icons/loadingIcn.svg" style="height: 25px;">&nbsp;&nbsp;In Action</center></td>
					<td>
						<center>
							<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
							<label class="btnAction deleteAppo" id="<?php echo $rwDt['id'] ?>" style="margin-left: 5px;"><i class="fas fa-trash-alt"></i></label>
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
					<td><?php echo $rwDt['doctorName']; ?></td>
					<td><?php echo $rwDt['date']; ?></td>
					<td><?php echo $rwDt['time']; ?></td>
					<td><center><img src="images/icons/facebook_loading.svg" style="height: 30px;">&nbsp;&nbsp;Next</center></td>
					<td>
						<center>
							<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
							<label class="btnAction deleteAppo" id="<?php echo $rwDt['id'] ?>" style="margin-left: 5px;"><i class="fas fa-trash-alt"></i></label>
						</center>
					</td>
				</tr>
				<?php
			}
			else
			{
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $rwDt['doctorName']; ?></td>
					<td><?php echo $rwDt['date']; ?></td>
					<td><?php echo $rwDt['time']; ?></td>
					<td><center>
						<?php
						if(!empty($rwDt['feedback']))
						{
							?>
							<label>Feedback &nbsp;&nbsp;<span class="text-info viewFeedback" id="<?php echo $rwDt['id']; ?>" style="cursor: pointer;"><i class="fas fa-eye"></i></span></label>
							<?php
						}
						else{
						?>
							<img src="images/icons/progress_2.svg" style="height: 30px;"><?php echo $rwDt['status']; ?>
							<?php
						}
						?>
						</center></td>
						<div class="feedbackCont"></div>
					<td>
						<center>
							<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
							<label class="btnAction deleteAppo" id="<?php echo $rwDt['id'] ?>" style="margin-left: 5px;"><i class="fas fa-trash-alt"></i></label>
						</center>
					</td>
				</tr>
				<?php
			}
			$i++;
		}
		?>
												
	</tbody>
</table>
<input type="text" name="userId" id="userId" value="<?php echo $userId; ?>" style="display: none;">
<div class="displayResult_v_appo"></div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#viewAppoTable").DataTable();
	    //////////////////////////////////////////////
		$(".openAppoBtn").on('click',function(){
			var appoId=$(this).attr("id");
			$.ajax({
				url:"ajax/make_appointment/query.php",
				method:"post",
				data:{appoId:appoId},
				success:function(data)
				{
					$(".displayResult_v_appo").html(data);
				}
			});
		});
		////////////////////////////////////
		$(".deleteAppo").on('click',function(){
			var appoId_d=$(this).attr("id");
			$.ajax({
				url:"ajax/make_appointment/query.php",
				method:"post",
				data:{appoId_d:appoId_d},
				success:function(data)
				{
					$(".displayDeleteAppoRslt").html(data);
				}
			});
		});
		////////////////////////////////////
		setTimeout(function(){
			$(".loadingRecord").hide();
			$(".loadBody").hide();
			$(".recordBody").show();
		},4000);
		///////////////////////////////////////
		$(".viewFeedback").click(function(e){
	    	var feedbackId=$(this).attr("id");
	    	$.ajax({
	    		url:"ajax/make_appointment/feedback.php",
	    		method:"POST",
	    		data:{
	    			"feedbackId":feedbackId
	    		},
	    		success:function(data)
	    		{
	    			$(".feedbackCont").html(data);
	    			$(".feedbackCont").offset({left:e.pageX,top:e.pageY});
	    			$(this).attr("tr").css("background-color","yellow");
	    		}
	    	});
	    });
	});
</script>