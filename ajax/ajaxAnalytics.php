<style type="text/css">
	.loadingRecord{position: absolute;margin-top: 100px;z-index: 10;background-color: white;padding: 6px;box-shadow: 0px 0px 20px 0px rgba(0,0,0,.5);border-radius: 3px;border:1px solid silver;font-weight: bold;color: darkslategray}
	#resultFound,
	.recordBody{display: none;}
</style>
<?php
include("db_connection/db_connection.php");
$diseaseName=$_POST['diseaseName'];
$i=1;
$l=mysqli_query($conn,"select * from diseases where disease_name ='$diseaseName'");
$num_row=mysqli_num_rows($l);

$cases=mysqli_query($conn,"select total_cases from diseases where disease_name = '$diseaseName'");
$num_cases =mysqli_fetch_array($cases);

$selectusers=mysqli_query($conn,"select * from users");
$num_rows=mysqli_num_rows($selectusers);
$div = $num_rows/2;
?>
<div style="padding: 10px 0px;border-bottom: 2px solid silver;">	
	<div id="resultFound"><div><label style="color: teal;" id="total">Total number of cases observerd for <b><?php echo $diseaseName; ?></b> is <b><?php echo $num_cases['total_cases']; ?></b></label></div>
	<div class="warning" style="display: none;"><b>*Warning</b>, this is more than a half of the population of the entire Campus</div>
	</div>
</div><br>
<?php
if($num_cases['total_cases']>=$div){
	?>
	<table class="table table-hover table-striped table-bordered" id="viewAppoTable">
	<thead>		
		<th>January-March</th>
		<th>April-June</th>
		<th>July-September</th>
		<th>October-December</th>
		<th>Total Cases</th>		
	</thead>
	<tbody class="loadBody">
		<div class="loadingRecord"><img src="images/icons/lod.gif" style="height: 20px;">&nbsp;&nbsp;Loading records ........</div>
	</tbody>	
	<tbody style="font-size: 16px;" class="recordBody">
		<?php
		while($rwDt = mysqli_fetch_array($l))
		{			
			?>
				<tr style="background-color: #F1948A">
					<td><?php echo $rwDt['quater1']; ?></td>
					<td><?php echo $rwDt['quater2']; ?></td>
					<td><?php echo $rwDt['quater3']; ?></td>
					<td><?php echo $rwDt['quater4']; ?></td>
					<td><?php echo $rwDt['total_cases']; ?></td>					
				</tr>
			<?php									
			$i++;
		}
		?>
	</tbody>
    </table>
    <script type="text/javascript">
    	$('#total').css('color','#F1948A');
    	if($('.warning').css('display' ) == 'none')
    	{    		
    		$('.warning').show();
    		$('.warning').css('color','#F1948A');
    	}else{
    		$('.warning').hide();
    	}
    </script>
<?php
}else{
	?>
	<table class="table table-hover table-striped table-bordered" id="viewAppoTable">
	<thead>		
		<th>January-March</th>
		<th>April-June</th>
		<th>July-September</th>
		<th>October-December</th>
		<th>Total Cases</th>		
	</thead>
	<tbody class="loadBody">
		<div class="loadingRecord"><img src="images/icons/lod.gif" style="height: 20px;">&nbsp;&nbsp;Loading records ........</div>
	</tbody>	
	<tbody style="font-size: 16px;" class="recordBody">
		<?php
		while($rwDt = mysqli_fetch_array($l))
		{			
			?>
				<tr>
					<td><?php echo $rwDt['quater1']; ?></td>
					<td><?php echo $rwDt['quater2']; ?></td>
					<td><?php echo $rwDt['quater3']; ?></td>
					<td><?php echo $rwDt['quater4']; ?></td>
					<td><?php echo $rwDt['total_cases']; ?></td>					
				</tr>
			<?php									
			$i++;
		}
		?>
	</tbody>
    </table>
   <?php
}


?>

<input type="text" name="diseaseName" id="diseaseName" value="<?php echo $diseaseName; ?>" style="display: none;">
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