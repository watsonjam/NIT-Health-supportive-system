<style type="text/css">
	.alertHoverContainer{position: fixed;top: 0px;left: 0px;margin: 0px;float: none;width: 100%;height: 100%;z-index: 500;background-color: rgba(0,0,0,.7);}
	.alertMainContainer{background-color: white;width: 45%;margin-top: 5%;border-radius: 2px;box-shadow: 0px 0px 20px 0px rgba(0,0,0,.4)}
</style>
<?php
include("db_connection/db_connection.php");
$fetchDt=mysqli_query($conn,"select * from drugs where alertAddingDrug>=quantity");
$result=mysqli_fetch_array($fetchDt);
$nm_rows=mysqli_num_rows($fetchDt);
$quantity=$result['quantity'];
$alertAddingDrug=$result['alertAddingDrug'];
if($nm_rows>0)
{
?>
<div class="alertHoverContainer">
	<div class="container alertMainContainer">
		<div style="padding: 10px;border-bottom: 2px solid silver">
			<div class="closeAlert" style="float: right;cursor: pointer;font-size: 18px;"><i class="fas fa-times"></i></div>
			<h5>Information</h5>
		</div>
		<div style="padding: 10px;">
			<span>Hellow! Admin you have <label style="font-weight: 600;color: green"><?php echo $nm_rows; ?></label> Drugs which ending soon</span>
			<div style="padding: 10px;">
				<div style="float: right;margin-bottom: 5px;">Total Drugs:&nbsp;&nbsp;<?php echo $nm_rows; ?></div>
				<table class="table table-bordered">
					<thead style="color: darkslategray">
						<th>S/n</th>
						<th>Drug Name</th>
						<th>Total Remain</th>
					</thead>
					<tbody>
						<?php
						$i=1;
						$fetchData=mysqli_query($conn,"select * from drugs where alertAddingDrug>=quantity");
						while($row=mysqli_fetch_array($fetchData))
						{
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $row['drug_name']; ?></td>
								<td><?php echo $row['quantity']; ?></td>
							</tr>
							<?php
							$i++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
}
else{echo"";}
?>
<script type="text/javascript">
	$(".closeAlert").on("click",function(){
		$(".alertHoverContainer").slideUp("slow");
	});
</script>