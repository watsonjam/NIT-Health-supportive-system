<style type="text/css">
	.loadingRecord{position: absolute;margin-top: 40px;z-index: 10;background-color: white;padding: 6px;box-shadow: 0px 0px 20px 0px rgba(0,0,0,.5);border-radius: 3px;border:1px solid silver;font-weight: bold;color: darkslategray}
	.recordBody{display: none;}
</style>
<?php
include("db_connection/db_connection.php");

$doctorId=$_POST['doctorId'];
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
		$selectDt=mysqli_query($conn,"select * from appointment where doctorId='$doctorId' order by id asc");
		while($rwDt=mysqli_fetch_array($selectDt))
		{
			if($rwDt['status']=="confirmed")
			{
			?>
				<tr style="background-color: #82E0AA">
					<td><?php echo $i; ?></td>
					<td><?php echo $rwDt['name']; ?></td>
					<td><?php echo $rwDt['date']; ?></td>
					<td><?php echo $rwDt['time']; ?></td>
					<td><center><img src="images/icons/loadingIcn.svg" style="height: 25px;">&nbsp;&nbsp;In Action</center></td>
					<td>
						<center>
							<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
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
					<td><?php echo $rwDt['name']; ?></td>
					<td><?php echo $rwDt['date']; ?></td>
					<td><?php echo $rwDt['time']; ?></td>
					<td><center><img src="images/icons/facebook_loading.svg" style="height: 30px;">&nbsp;&nbsp;Next</center></td>
					<td>
						<center>
							<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
						</center>
					</td>
				</tr>
				<?php
			}
			else if(empty($rwDt['feedback']))
			{
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $rwDt['name']; ?></td>
					<td><?php echo $rwDt['date']; ?></td>
					<td><?php echo $rwDt['time']; ?></td>
					<td><center><img src="images/icons/progress_2.svg" style="height: 30px;"><?php echo $rwDt['status']; ?></center></td>
					<td>
						<center>
							<label class="btnAction openAppoBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-eye"></i></label>
						</center>
					</td>
				</tr>
				<?php
			}
			else{echo"";}
			$i++;
		}
		?>
	</tbody>
</table>
<div class="displayResult_v_appo"></div>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).ready(function(){
		$("#viewAppoTable").DataTable();
	    ////////////////////////////////////
		setTimeout(function(){
			$(".loadingRecord").hide();
			$(".loadBody").hide();
			$(".recordBody").show();
		},4000);
	    /////////////////////////////////////////////////
	    $(".openAppoBtn").on('click',function(){
	    	var appoId_d=$(this).attr("id");
	    	$.ajax({
	    		url:"ajax/view_appointment/query.php",
	    		method:"post",
	    		data:{appoId_d:appoId_d},
	    		success:function(data)
	    		{
	    			$(".displayResult_v_appo").html(data);
	    		}
	    	});
	    });
	    
	});
</script>