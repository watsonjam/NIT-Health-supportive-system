<?php 
include("includes/db_connection.php");
include("includes/security3.php");
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include("includes/head.php");
	?>
	<title>Manager || Darshbord</title>
	<style type="text/css">
		.form-control{border:1px solid silver;padding-left:8px;outline: none;font-size: 14px;}
		.form-control:focus{border-color:#2980B9;box-shadow: 0px 0px 8px 0px #2980B9;}
		.searchButton{line-height: 34px;background-color: #3498DB;border:1px solid #1A5276;color: white;cursor: pointer;border-radius: 4px;font-size: 16px;padding:5px;padding-top:0px;padding-bottom:0px;}
		.searchButton:active{border:1px solid #1A5276;background:linear-gradient(#3498DB,#D6EAF8);}
		.dateError{color: red;display: none;}
		#refreshBtn{display: none;}
		.ui-datepicker .ui-datepicker-header {background-color: #2E4053;color: white;font-size: 14px;}
		.ui-datepicker .ui-datepicker-prev {background-color: lavender;cursor: pointer;width: 20%;font-weight: 400;padding: 12px;padding-top: 2px;font-size: 13px;}
		.ui-datepicker .ui-datepicker-prev:before{content: 'Prev';color: darkslategray;}
		.ui-datepicker .ui-datepicker-next {background-color: lavender;cursor: pointer;width: 20%;font-weight: 400;padding: 12px;padding-top: 2px;font-size: 13px;}
		.ui-datepicker .ui-datepicker-next:before{content: 'Next';color: darkslategray;}
		.ui-datepicker table {font-size: .7em;}
		.Error{color: red;display: none;}
		.salesReportHeader{padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white;position: sticky;top: 20%;}
		#showSalesReport{display: none;}
	</style>
</head>
<?php
include("includes/pharmacist_header.php");
?>
<body style="overflow-x: hidden;">
	<div class="row">
		<div class="col-md-3">
			<?php
			include("includes/aside_pharmacist.php");
			?>
		</div>
		<div class="col-md-9">
			<div class="pathMaincont" style="padding-bottom: 7px;">
				<div style="float: right;width: 40%;">
					<div style="float: right;" id="searchInfo"><button class="btn btn-success searchInfoBtn"><i class="fas fa-search"></i>&nbsp;Search by Months</button></div>
					<div style="display: none;" id="searchCont">
						<div style="display: inline-block;">
							<select class="form-control formControl" name="month" id="month">
								<option value="" disabled selected>---select month---</option>
								<option value="January">January</option>
								<option value="February">February</option>
								<option value="March">March</option>
								<option value="April">April</option>
								<option value="May">May</option>
								<option value="June">June</option>
								<option value="July">July</option>
								<option value="August">August</option>
								<option value="September">September</option>
								<option value="October">October</option>
								<option value="November">November</option>
								<option value="December">December</option>
							</select>
							<div class="Error monthError">*please select month</div>
							<?php
							?>
						</div>
						<div style="display: inline-block;">
							<select class="form-control formControl" name="year" id="year">
								<option value="" disabled selected>---select year----</option>
								<?php
								$dt=date("Y");
								for($i=2019;$i<=$dt;$i++)
								{
									?>
									<option><?php echo $i; ?></option>
									<?php
								}
								?>
							</select>
							<div class="Error yearError">*please select year</div>
						</div>
						<div style="display: inline-block;">
							<button title="search" class="btn btn-info searchByMonthBtn" style="height: 37px;margin-top: -4px;"><i class="fas fa-search"></i></button>
							<button id="closeSearch" class="btn btn-danger" title="close search" style="height: 37px;margin-top: -4px;margin-left: 8px;"><i class="fas fa-times"></i> Close Search</button>
							<div class="Error" style="visibility: hidden;">-----</div>
						</div>
					</div>
				</div>
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Reports</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div>
						<p style="font-weight: 500;color:tomato">Search data between date one and two</p>
					</div>
					<div class="row" style="margin-bottom: 30px;">
						<div class="col-md-4">
							<input type="text" name="from_date" id="from_date" placeholder="From Date   dd--mm--yyyy" class="form-control" autocomplete="off">
							<div class="dateError fromError">*please select date</div>
						</div>
						<div class="col-md-4">
							<input type="text" name="to_date" id="to_date" placeholder="To Date   dd--mm--yyyy" class="form-control" autocomplete="off">
							<div class="dateError toError">*please select date</div>
						</div>
						<div class="col-md-4">
							<button type="button" name="searchBtn" id="searchBtn" class="searchButton" style="outline: none;"><i class="fas fa-search"></i>&nbsp;Search</button>
							<div style="float: right;">
								<button style="height: 38px;cursor: pointer;" class="btn btn-danger" id="refreshBtn"><i class="fas fa-times"></i>&nbsp;&nbsp;Cancel Search</button>
								<button style="height: 38px;cursor: pointer;" class="btn btn-success" title="show all sales reports" id="showAllSalesReport"><i class="fas fa-eye"></i>&nbsp;&nbsp;Show All</button>
								<button style="height: 38px;cursor: pointer;" class="btn btn-info" id="showSalesReport"><i class="fas fa-eye"></i>&nbsp;&nbsp;Today Sales report</button>
							</div>
						</div>
					</div>
					<div class="mainContainer">
						<div class="salesContainer">
							<?php
							$date=date("Y-m-d");
							$select=mysqli_query($conn,"select * from sales where date_sale='$date'");
							$num_rows=mysqli_num_rows($select);
							$totalAmount=0;
							$profit=0;
							$select2=mysqli_query($conn,"select * from sales where date_sale='$date'");
							while($row2=mysqli_fetch_array($select2))
							{
								$totalAmount +=$row2['total_price'];
								$profit +=$row2['total_profit'];
							}
							?>
							<div class="salesReportHeader">
								<div style="float: right;">
									<label>Total Sale :&nbsp;<?php echo $num_rows; ?></label>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label>Amount : &nbsp;Ths <?php echo number_format($totalAmount); ?></label>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label>Profit : &nbsp;Ths <?php echo number_format($profit); ?></label>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label style="cursor: pointer;" id="printBtn"><i class="fas fa-print"></i></label>
								</div>
								<h6><i class="far fa-file-alt" style="font-size: 22px;"></i>&nbsp;&nbsp;Today Sale Report &nbsp;&nbsp;<label><?php echo date("d/M/Y"); ?></label></h6>
							</div>
							<div style="padding: 20px;">
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
											$i=1;
											while($row=mysqli_fetch_array($select))
											{
												?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $row['seller_name']; ?></td>
													<td><?php echo $row['customer_name']; ?></td>
													<td><?php echo $row['item_name']; ?></td>
													<td><?php echo $row['quantity']; ?></td>
													<td><?php echo $row['total_price']; ?></td>
													<td><?php echo $row['total_profit']; ?></td>
													<td><?php echo $row['date_sale']; ?></td>
												</tr>
												<?php
												$i++;
											}
											?>
										</tbody>
									</table>
									<?php
								}
								else
								{
									?>
									<center>
										<div>No data available in table</div>
									</center>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</article>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#refreshBtn,#showSalesReport").click(function(){
			window.location.reload();
		});
		//---------------------------->>
		$.datepicker.setDefaults({
			dateFormat: 'yy-mm-dd'
		});
		$("#from_date").datepicker();
		$("#to_date").datepicker();
		//---------------------------->>
		$(".searchButton").click(function(){
			var from_date=$("#from_date").val();
			var to_date=$("#to_date").val();
			$("#showSalesReport").hide();
			$("#showAllSalesReport").hide();
			$.ajax({
				url:"ajax/ajaxSearchSaleReport.php",
				method:"post",
				data:{
					"from_date":from_date,
					"to_date":to_date
				},
				success:function(data)
				{
					$(".salesContainer").html(data);
				}
			});
		});
		//----------------------------------------->>
		$(".searchInfoBtn").click(function(){
			$("#searchInfo").hide();
			$("#searchCont").show();
		});
		$("#closeSearch").click(function(){
			$("#searchInfo").show();
			$("#searchCont").hide();
		});
		//----------------------------------->>
		$("#printBtn").click(function(){
			$(".salesContainer").printThis({
				debug: false,               // show the iframe for debugging
		        importCSS: true,            // import parent page css
		        importStyle: true,         // import style tags
		        printContainer: true,       // print outer container/$.selector
		        loadCSS: "http://localhost/Nit%20Health%20Supportive%20System/bootstrap/css/bootstrap.min.css",                // path to additional css file - use an array [] for multiple
		        pageTitle: "Sales Report",              // add title to print page
		        removeInline: false,        // remove inline styles from print elements
		        removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
		        printDelay: 333,            // variable print delay
		        header: "<h3><center>Sales Report</center></h3><br>",               // prefix to html
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
		$(".searchByMonthBtn").click(function(){
			var month=$("#month").val();
			var year=$("#year").val();
			$.ajax({
				url:"ajax/ajaxSearchSaleByMonth.php",
				method:"post",
				async:false,
				data:{month:month,year:year},
				success:function(data)
				{
					$(".salesContainer").html(data);
				}
			});
		});
		//------------------>>
		$("#showAllSalesReport").click(function(){
			$("#showSalesReport").show();
			$(this).hide();
			$.ajax({
				url:"ajax/ajaxSearchSaleByMonth.php",
				method:"post",
				async:false,
				data:{saleReportId:''},
				success:function(data)
				{
					$(".salesContainer").html(data);
				}
			});
		});
	});
</script>