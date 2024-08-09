<style type="text/css">
	.loadingRecord{position: absolute;margin-top: 100px;z-index: 10;background-color: white;padding: 6px;box-shadow: 0px 0px 20px 0px rgba(0,0,0,.5);border-radius: 3px;border:1px solid silver;font-weight: bold;color: darkslategray}
	#resultFound,
	.recordBody{display: none;}
</style>
<?php
include("db_connection/db_connection.php");
$doctorName=$_POST['doctorName'];
$i=1;
$selectDt=mysqli_query($conn,"select * from appointment where doctorName='$doctorName' and status !='Declined' order by id asc");
$num_row=mysqli_num_rows($selectDt);
?>
<div style="padding: 10px 0px;border-bottom: 2px solid silver;">
	<div id="loadResultFound"><img src="images/icons/progress_2.svg" style="height: 30px;">&nbsp;Loading.....</div>
	<div id="resultFound"><label style="color: #D35400">Total Queue for Doctor <b><?php echo $doctorName; ?></b> is <b><?php echo $num_row; ?></b></label></div>
</div><br>
<table class="table table-hover table-striped table-bordered" id="viewAppoTable">
	<thead>
		<th>S/n</th>
		<th>Doctor Name</th>
		<th>Date</th>
		<th>Time</th>
		<th>Status</th>
	</thead>
	<tbody class="loadBody">
		<div class="loadingRecord"><img src="images/icons/lod.gif" style="height: 20px;">&nbsp;&nbsp;Loading records ........</div>
	</tbody>
	<tbody style="font-size: 16px;" class="recordBody">
		<?php
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
					<td><center><img src="images/icons/progress_2.svg" style="height: 30px;"><?php echo $rwDt['status']; ?></center></td>
				</tr>
				<?php
			}
			$i++;
		}
		?>
	</tbody>
</table>
<input type="text" name="doctorName" id="doctorName" value="<?php echo $doctorName; ?>" style="display: none;">
<script type="text/javascript">
	$(document).ready(function(){
		$("#viewAppoTable").DataTable();
		////////////////////////////////////
		setTimeout(function(){
			$(".loadingRecord").hide();
			$(".loadBody").hide();
			$(".recordBody").show();
			$("#loadResultFound").hide();
			$("#resultFound").show();
			$()
		},2000);
	});
</script>