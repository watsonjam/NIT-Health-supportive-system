<?php
include("db_connection/db_connection.php");

if(isset($_POST['month']))
{
	?>
	<script type="text/javascript">
		$("#closeSearch").click(function(){
			window.location.reload();
		});
	</script>
	<?php
	$month=$_POST['month'];
	$year=$_POST['year'];


	if(empty($month) and empty($year))
	{
		?>
		<style type="text/css">
			.formControl{border:1px solid red;}
			.Error{display: block;}
		</style>
		<?php
	}
	else
	{
		if(empty($month))
		{
			?>
			<style type="text/css">
				#month{border:1px solid red;}
				.monthError{display: block;}
			</style>
			<?php
		}
		else
		{
			if(empty($year))
			{
				?>
				<style type="text/css">
					#year{border:1px solid red;}
					.yearError{display: block;}
				</style>
				<?php
			}
			else
			{
				$select=mysqli_query($conn,"select * from sales where month='$month' and year='$year'");
				$num_rows=mysqli_num_rows($select);
				?>
				<div style="height: 420px;" id="lodData">
					<div style="padding-top: 13%;">
						<center><img src="images/icons/lod.gif" height="80" width="80"><label style="margin-left: 20px;font-size: 1.6em;font-weight: bold;color: darkslategray;letter-spacing: 0.4px;">Searching ..........</label></center>
					</div>
				</div>
				<div style="display: none;" id="searchResultContainer">
					<div style="padding: 10px;color: #186A3B;font-weight: 400">
						<span>About <?php echo $num_rows; ?> results found</span>
					</div>
					<?php
					$totalAmount=0;
					$profit=0;
					$select2=mysqli_query($conn,"select * from sales where month='$month' and year='$year'");
					while($row2=mysqli_fetch_array($select2))
					{
						$totalAmount +=$row2['total_price'];
						$profit +=$row2['total_profit'];
					}
					?>
					<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
						<div style="float: right;">
							<label>Total Sale :&nbsp;<?php echo $num_rows; ?></label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label>Amount : &nbsp;Ths <?php echo number_format($totalAmount); ?></label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label>Profit : &nbsp;Ths <?php echo number_format($profit); ?></label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label style="cursor: pointer;" id="printBtn"><i class="fas fa-print"></i></label>
						</div>
						<h6><i class="far fa-file-alt" style="font-size: 22px;"></i>&nbsp;&nbsp;Sale Report In:&nbsp;&nbsp;<label><?php echo $month."&nbsp;".$year; ?></label></h6>
					</div>
					<div style="padding: 20px;" class="searchReportCont">
						<?php
						if($num_rows>0)
						{
							?>
							<table class="table table-striped table-bordered" style="color: darkslategray">
								<thead style="font-size: 14px;">
									<th>S/n</th>
									<th>Seller Name</th>
									<th>Customer Name</th>
									<th>Item Name</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Profit</th>
									<th>Transaction Date</th>
								</thead>
								<tbody>
									<?php
									$count=1;
									while($row=mysqli_fetch_array($select))
									{
										?>
										<tr>
											<td><?php echo $count; ?></td>
											<td><?php echo $row['seller_name']; ?></td>
											<td><?php echo $row['customer_name']; ?></td>
											<td><?php echo $row['item_name']; ?></td>
											<td><?php echo $row['quantity']; ?></td>
											<td><?php echo $row['total_price']; ?></td>
											<td><?php echo $row['total_profit']; ?></td>
											<td><?php echo $row['date_sale']; ?></td>
										</tr>
										<?php
										$count++;
									}
									?>
								</tbody>
							</table>
							<?php
						}
						else
						{
							?>
							<style type="text/css">
								#printBtn{display: none;}
							</style>
							<center>
								<div style="color: red;font-weight: 500;">No Result Found! please try again</div>
							</center>
							<?php
						}
						?>
					</div>
				</div>
				<?php
			}
		}
	}
}
###################################################################################################
if(isset($_POST['saleReportId']))
{
	$select=mysqli_query($conn,"select * from sales");
	$num_rows=mysqli_num_rows($select);
	?>
	<div>
		<?php
		$totalAmount=0;
		$profit=0;
		$select2=mysqli_query($conn,"select * from sales");
		while($row2=mysqli_fetch_array($select2))
		{
			$totalAmount +=$row2['total_price'];
			$profit +=$row2['total_profit'];
		}
		?>
		<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
			<div style="float: right;">
				<label>Total Sale :&nbsp;<?php echo $num_rows; ?></label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>Amount : &nbsp;Ths <?php echo number_format($totalAmount); ?></label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>Profit : &nbsp;Ths <?php echo number_format($profit); ?></label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label style="cursor: pointer;" id="printBtn"><i class="fas fa-print"></i></label>
			</div>
			<h6><i class="far fa-file-alt" style="font-size: 22px;"></i>&nbsp;&nbsp;All Sales Reports</h6>
		</div>
		<div style="padding: 20px;" class="searchReportCont">
			<?php
			if($num_rows>0)
			{
				?>
				<table class="table table-striped table-bordered" style="color: darkslategray">
					<thead style="font-size: 14px;">
						<th>S/n</th>
						<th>Seller Name</th>
						<th>Customer Name</th>
						<th>Item Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Profit</th>
						<th>Transaction Date</th>
					</thead>
					<tbody>
						<?php
						$count=1;
						while($row=mysqli_fetch_array($select))
						{
							?>
							<tr>
								<td><?php echo $count; ?></td>
								<td><?php echo $row['seller_name']; ?></td>
								<td><?php echo $row['customer_name']; ?></td>
								<td><?php echo $row['item_name']; ?></td>
								<td><?php echo $row['quantity']; ?></td>
								<td><?php echo $row['total_price']; ?></td>
								<td><?php echo $row['total_profit']; ?></td>
								<td><?php echo $row['date_sale']; ?></td>
							</tr>
							<?php
							$count++;
						}
						?>
					</tbody>
				</table>
				<?php
			}
			else
			{
				?>
				<style type="text/css">
					#printBtn{display: none;}
				</style>
				<center>
					<div style="color: red;font-weight: 500;">No Result Found! please try again</div>
				</center>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#printBtn").click(function(){
			$("#searchResultContainer").printThis({
				debug: false,               // show the iframe for debugging
		        importCSS: true,            // import parent page css
		        importStyle: true,         // import style tags
		        printContainer: true,       // print outer container/$.selector
		        loadCSS: "http://localhost/pharmacy%20system/bootstrap/css/bootstrap.min.css",                // path to additional css file - use an array [] for multiple
		        pageTitle: "Sales Report",              // add title to print page
		        removeInline: false,        // remove inline styles from print elements
		        removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
		        printDelay: 333,            // variable print delay
		        header: "<h5><center>Sales Report</center></h5><br>",               // prefix to html
		        footer: null,               // postfix to html
		        base: false,                // preserve the BASE tag or accept a string for the URL
		        formValues: true,           // preserve input/form values
		        canvas: false,              // copy canvas content
		        doctypeString: '<!DOCTYPE html>', // enter a different doctype for older markup
		        removeScripts: false,       // remove script tags from print content
		        copyTagClasses: true,      // copy classes from the html & body tag
		        beforePrintEvent: null,     // callback function for printEvent in iframe
		        beforePrint: null,          // function called before iframe is filled
		        afterPrint: null            // function called before iframe is removed
			});
		});
		//------------------>>
	});
	function filterDataByMonth()
	{
		document.getElementById('lodData').style.display="none";
		document.getElementById('searchResultContainer').style.display="block";
	}
	setTimeout("filterDataByMonth()",3000);
</script>