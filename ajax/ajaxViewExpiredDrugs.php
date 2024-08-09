<?php
//including database connection
include("db_connection/db_connection.php");

if(isset($_POST['expdId']))
{

	$date=date("Y-m-d");
	$selectExpiredDrug=mysqli_query($conn,"select * from drugs where expire_date<='$date'");
	$num_rows2=mysqli_num_rows($selectExpiredDrug);
	?>
	<div>
		<div style="padding: 5px;border-bottom: 1px solid silver">
			<div style="float: right;margin-right: 10px;">
				<label style="cursor: pointer;color: teal" title="print"><i class="fas fa-print" id="printBtn"></i></label>
			</div>
			<h6>Expired Drugs</h6>
		</div>
		<div style="padding: 20px;">
			<?php
			if($num_rows2<=0)
			{
				?>
				<p align="center" class="text-danger">Empty! No expired drugs available</p>
				<?php
			}
			else
			{
				?>
				<div class="expiredDrugContainer">
					<table class="table table-bordered">
						<thead style="font-size: 14px;">
							<th>S/n</th>
							<th>Drug Name</th>
							<th>Quantity</th>
							<th>Expired Date</th>
							<th>Losses</th>
						</thead>
						<tbody>
							<?php
							$i=1;
							while($rowExpDrug=mysqli_fetch_array($selectExpiredDrug))
			 				{
			 					$losse=$rowExpDrug['quantity']*$rowExpDrug['buyingPrice'];
			 					?>
			 					<tr>
			 						<td><?php echo $i; ?></td>
			 						<td><?php echo $rowExpDrug['drug_name']; ?></td>
			 						<td><?php echo $rowExpDrug['quantity']." ".$rowExpDrug['quantity_type']; ?></td>
			 						<td><?php echo $rowExpDrug['expire_date']; ?></td>
			 						<td>Tsh <?php echo number_format($losse); ?></td>
			 					</tr>
			 					<?php
			 					$i++;
			 				}
			 				$date=date("Y-m-d");
							$selectExpiredDrug=mysqli_query($conn,"select * from drugs where expire_date<='$date'");
							$totalLosse=0;
							while($rows=mysqli_fetch_array($selectExpiredDrug))
							{
								$totalLosse +=$rows['quantity'] * $rows['buyingPrice'];
							}
							?>
						</tbody>
					</table>
					<div style="padding: 15px;">
						<div id="totalLosse" style="position: absolute;right: 30px;"><label style="font-weight: 500;">Total losses: &nbsp;Tsh </label> <strong><?php echo number_format($totalLosse); ?></strong></div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}
#################################################################################################
if(isset($_POST['absntId']))
{
	$selectAsbentDrug=mysqli_query($conn,"select * from drugs where quantity='0'");
    $num_rows1=mysqli_num_rows($selectAsbentDrug);
	?>
	<div style="padding: 5px;border-bottom: 1px solid silver">
		<h6>Absent Drugs</h6>
	</div>
	<div style="padding: 20px;">
		<?php
		if($num_rows1<=0)
		{
			?>
			<p align="center" class="text-danger">Empty! No absent drugs available</p>
			<?php
		}
		else
		{
			?>
			<div>
				<table class="table table-bordered">
					<thead style="font-size: 14px;">
						<th>S/n</th>
						<th>Drug Name</th>
					</thead>
					<tbody>
						<?php
						while($rowExpDrug=mysqli_fetch_array($selectAsbentDrug))
	 				{
	 					?>
	 					<tr>
	 						<td><?php echo $rowExpDrug['id']; ?></td>
	 						<td><?php echo $rowExpDrug['drug_name']; ?></td>
	 					</tr>
	 					<?php
	 				}
						?>
					</tbody>
				</table>
			</div>
			<?php
		}
		?>
	</div>
	<?php
}
####################################################################################
if(isset($_POST['drgEndSnId']))
{
	$ftchData=mysqli_query($conn,"select * from drugs where alertAddingDrug > quantity");
	$results=mysqli_fetch_array($ftchData);
	$nm_rows=mysqli_num_rows($ftchData);
	
	
	?>
	<div>
		<div style="padding: 10px;border-bottom: 2px solid silver">
			<h6>Drugs which ending soon</h6>
		</div>
		<div style="padding: 20px;">
			<?php
			if($nm_rows>0)
			{
			?>
			<div>
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
						$queryData=mysqli_query($conn,"select * from drugs where alertAddingDrug > quantity");
						while($row=mysqli_fetch_array($queryData))
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
			<?php
			}
			else{
				?>
				<p align="center" class="text-danger">Empty! No data available</p>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}
######################################################################################
if(isset($_POST['drgSnExpId']))
{
	$date=date("Y-m-d");
	$ftchData=mysqli_query($conn,"select * from drugs");
	$results=mysqli_fetch_array($ftchData);
	$nm_rows=mysqli_num_rows($ftchData);
	$quantity=$results['quantity'];
	$alertAddingDrug=$results['alertAddingDrug'];
	?>
	<div>
		<div style="padding: 10px;border-bottom: 2px solid silver">
			<h6>Drugs which expired soon</h6>
		</div>
		<?php
		if($nm_rows>0)
		{
		?>
		<div style="padding: 20px;">
			<div>
				<table class="table table-bordered">
					<thead style="color: darkslategray">
						<th>S/n</th>
						<th>Drug Name</th>
						<th>Expired Time</th>
						<th>Time Left</th>
					</thead>
					<tbody>
						<?php
						$i=1;
						$fetchData=mysqli_query($conn,"select * from drugs order by id asc");
						while($row_data=mysqli_fetch_array($fetchData))
						{
							$start = strtotime($row_data['expire_date']);
							$end = strtotime(date("Y-m-d"));

							$days_between = ceil(abs($end - $start) / 86400);
							mysqli_query($conn,"update drugs set days_left='$days_between'");
							if($days_between>0 and $days_between<30)
							{
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row_data['drug_name']; ?></td>
									<td><?php echo $row_data['expire_date']; ?></td>
									<td><?php echo $days_between; ?>&nbsp;Days</td>
								</tr>
								<?php
							}
							else if($days_between>=30 and $days_between<=62){
								$ts2 = strtotime($row_data['expire_date']);
								$ts1 = strtotime(date("Y-m-d"));

								$year1 = date('Y', $ts1);
								$year2 = date('Y', $ts2);

								$month1 = date('m', $ts1);
								$month2 = date('m', $ts2);

								$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row_data['drug_name']; ?></td>
									<td><?php echo $row_data['expire_date']; ?></td>
									<td><?php echo $days_between; ?>&nbsp;Days&nbsp;&nbsp;&nbsp;&nbsp;( <?php echo $diff; ?>&nbsp;Month )</td>
								</tr>
								<?php
							}
							else{
								echo"";
							}
							$i++;
					    }
						?>
					</tbody>
				</table>
			</div>
		</div>
		<?php
			}
		else{
			?>
			<p align="center" class="text-danger">Empty! No data available</p>
			<?php
		}
		?>
	</div>
	<?php
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#printBtn").click(function(){
			$(".expiredDrugContainer").printThis({
				debug: false,               // show the iframe for debugging
		        importCSS: true,            // import parent page css
		        importStyle: false,         // import style tags
		        printContainer: true,       // print outer container/$.selector
		        loadCSS: "http://localhost/pharmacy%20system/bootstrap/css/bootstrap.min.css",                // path to additional css file - use an array [] for multiple
		        pageTitle: "Sales Report",              // add title to print page
		        removeInline: true,        // remove inline styles from print elements
		        removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
		        printDelay: 333,            // variable print delay
		        header: "<h5><center>Expired Drugs</center></h5><br>",               // prefix to html
		        footer: null,               // postfix to html
		        base: false,                // preserve the BASE tag or accept a string for the URL
		        formValues: true,           // preserve input/form values
		        canvas: false,              // copy canvas content
		        doctypeString: '<!DOCTYPE html>', // enter a different doctype for older markup
		        removeScripts: false,       // remove script tags from print content
		        copyTagClasses: false,      // copy classes from the html & body tag
		        beforePrintEvent: null,     // callback function for printEvent in iframe
		        beforePrint: null,          // function called before iframe is filled
		        afterPrint: null            // function called before iframe is removed
			});
		});
	});
</script>