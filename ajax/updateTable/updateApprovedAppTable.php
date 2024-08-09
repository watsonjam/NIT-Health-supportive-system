<style type="text/css">
	.loadingRecord{position: absolute;margin-top: 40px;z-index: 10;background-color: white;padding: 6px;box-shadow: 0px 0px 20px 0px rgba(0,0,0,.5);border-radius: 3px;border:1px solid silver;font-weight: bold;color: darkslategray}
	.recordBody{display: none;}
</style>
<?php
include("db_connection/db_connection.php");

$doctorId=$_POST['doctorId'];
?>
<table class="table table-hover table-striped table-bordered" id="dataTables">
	<thead>
		<th>S/n</th>
		<th>Patient Name</th>
		<th>Date</th>
		<th>Time</th>
		<th><center>Action</center></th>
	</thead>
	<tbody class="loadBody">
		<div class="loadingRecord"><img src="images/icons/lod.gif" style="height: 20px;">&nbsp;&nbsp;Loading records ........</div>
	</tbody>
	<tbody style="font-size: 16px;" class="recordBody">
		<?php
		$i=1;
		$selectDt=mysqli_query($conn,"select * from approved_appointment where doctorId='$doctorId' order by id asc");
		while($rwDt=mysqli_fetch_array($selectDt))
		{
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rwDt['name']; ?></td>
				<td><?php echo $rwDt['date']; ?></td>
				<td><?php echo $rwDt['time']; ?></td>
				<td>
					<center>
						<label class="btnAction deleteAppBtn" id="<?php echo $rwDt['id'] ?>"><i class="fas fa-trash-alt"></i></label>
					</center>
				</td>
			</tr>
			<?php
			$i++;
		}
		?>
	</tbody>
</table>
<input type="text" name="doctorId" id="doctorId" value="<?php echo $doctorId; ?>" style="display: none;">
<script type="text/javascript">
	$(document).ready(function(){
		////////////////////////
		$(".deleteAppBtn").on('click',function(){
			$deletId=$(this).attr("id");
			$.ajax({
				url:"ajax/view_appointment/query.php",
				method:"post",
				data:{deletId:deletId},
				success:function(data)
				{
					updateApprovedAppoTable();
				}
			});
		});
		function updateApprovedAppoTable(){
	    	var doctorId=$("#doctorId").val();
	    	$.ajax({
	    		url:"ajax/updateTable/updateApprovedAppTable.php",
	    		method:"post",
	    		data:{doctorId:doctorId},
	    		success:function(data)
	    		{
	    			$("#viewAppoTable").html(data);
	    		}
	    	});
	    }
	});
</script>