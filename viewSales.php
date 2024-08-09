<?php 
include("includes/db_connection.php");
include("includes/security3.php");
//updating sales table 
mysqli_query($conn,"update sales set status='' where pharmacistId='$id'");
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include("includes/head.php");
	?>
	<title>Manager || Darshbord</title>
	<style type="text/css">
		.labelAction{color: #3498DB;cursor: pointer;}
		.labelAction:active{color: transparent;}
		.deleteSale{color: #E74C3C;}
		.delete{color: #E74C3C;}
		.viewMonthlySaleCont{box-sizing: border-box;border: 1px solid rgba(0,0,0,.1);padding: 5px;position: absolute;width: 75%;margin-top: 10px;border-radius: 3px;box-shadow: 0px 0px 50px 0px rgba(0,0,0,.7);padding-left: 12px;display: block;right: 40px;background-color: white;}
		.viewMonthlySaleCont:before{content: "";float: right;border:11.5px solid transparent;border-bottom-color: rgba(0,0,0,.1);width: 0px;height: 0px;margin-top: -16px;border-top: 0px;margin-right: 8px;}
		.viewMonthlySaleCont:after{content: "";border:9.5px solid transparent;border-bottom-color: white;width: 0px;height: 0px;position: absolute;border-top: 0px;right: 14.5px;top: -9px;}
		.viewMonthlySaleSubCont{overflow-y: scroll;height: 420px;}
		.viewMonthlySaleSubCont::-webkit-scrollbar{width: 7px;margin: 10px;}
	    .viewMonthlySaleSubCont::-webkit-scrollbar-track{background:transparent; }
	    .viewMonthlySaleSubCont::-webkit-scrollbar-thumb{background:silver;border-radius: 10px;}
	    .viewMonthlySaleSubCont::-webkit-scrollbar-thumb:hover{background:gray; }
	    #mainContainer{margin-bottom: 60px;}
	    #goTop{position: fixed;right: 20px;background-color: white;padding: 15px;box-shadow: 0px 0px 30px 0px rgba(0,0,0,.9);box-sizing: border-box;cursor: pointer;border-radius: 2px;bottom: 20px;z-index: 100;display: none;transition: background-color .3s;}
	    #goTop:hover{
	    	box-shadow: 0px 0px 50px 0px rgba(0,0,0,.9);
	    }
	    .hover-container{position: fixed;top: 0px;float: none;left: 0px;margin: 0px;background: rgba(0,0,0,.4);width: 100%;height: 100%;z-index: 200;display: none;}
	    .confirmation-main-container{width: 35%;background-color: white;border-radius: 2px;box-shadow: 0px 0px 30px 0px rgba(0,0,0,.6);position: relative;animation: 1s confirmation-container;margin-top: 10%;}
	    @keyframes confirmation-container{from{top:-300px;opacity: 0;}to{top: 0px;opacity: 1}}
	    .receiptsContainer{display: none;}
	    .viewSalesContBtn{display: none;}
	    .loadingHoverContainer{position: fixed;top: 0px;left: 0px;float: none;margin: 0px;width: 100%;height: 100%;background-color: rgba(0,0,0,.4);z-index: 100;display: none;}
		.loadingContainer{margin-left: 45%;margin-top: 15%;}
		.newSale{position: absolute;color: white;font-family: sans-serif;font-weight: 600;margin-left:45px;display: inline-block;padding:3px 5px;background-color: rgba(69,171,35);font-size: 13px;border-radius: 0px;
		}
		.newSale:after{position: inherit;width: 10;height: 13px;content: ' ';border:11px  solid;border-color: transparent transparent green transparent;transform:rotate(-40deg);right: 3.7px;margin-top: 5px;z-index: -10;
		}
		.newReceipt{position: absolute;color: white;font-family: sans-serif;font-weight: 600;margin-left:23px;display: inline-block;padding:3px 5px;background-color: rgba(69,171,35);font-size: 13px;border-radius: 0px;
		}
		.newReceipt:after{position: inherit;width: 10;height: 13px;content: ' ';border:11px  solid;border-color: transparent transparent green transparent;transform:rotate(-40deg);right: 4px;margin-top: 5px;z-index: -20;}
		.newReceipt:before{position: inherit;width: 10;height: 13px;content: ' ';border:11px  solid;border-color: transparent transparent white transparent;transform:rotate(-86deg);right: 11px;margin-top: 12px;z-index: -10;}
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
			<div class="pathMaincont">
				<div style="float: right;">
					<div style="color: gray">
						<?php
						$selectSales=mysqli_query($conn,"select * from sales where pharmacistId='$id'");
						$num_row=mysqli_num_rows($selectSales);
						if($num_row>0)
						{
							?>
							<label class="dlt_allSalesCont">
								<button class="btn btn-danger" id="deleteAllSalesBtn"><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Delete All Sales</button>
								&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
							</label>
							<?php
						}
						else{echo"";}
						?>
						<button class="btn btn-success viewReceiptContBtn"><i class="fas fa-eye"></i>&nbsp;&nbsp;View Receipts</button>
						<button class="btn btn-success viewSalesContBtn"><i class="fas fa-eye"></i>&nbsp;&nbsp;View Sales</button>
					</div>
				</div>
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Sales</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="mainContainer" id="mainContainer">
						<div>
							<div id="goTop" title="Go back to Top"><a href=""><i class="fas fa-angle-double-up fa-2x"></i></a></div>
						</div>
						<div class="salesContents salesContainer">
							<?php
							$selectSales=mysqli_query($conn,"select * from sales where pharmacistId='$id'");
							$num_rows=mysqli_num_rows($selectSales);
							?>
							<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
								<div style="float: right;">
									<label>Total sales &nbsp;<?php echo $num_rows; ?></label>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label style="cursor: pointer;color: lavender"><i class="fas fa-print" id="printBtn"></i></label>
								</div>
								<h6><i class="fas fa-stethoscope" style="font-size: 22px;"></i>&nbsp;&nbsp;  Product Sales</h6>
							</div>
							<div style="padding: 20px;" id="container">
								<table class="table table-bordered" id="dataTables" style="color: teal;border:1.5px solid black">
									<thead style="font-size: 14px;">
										<th>S/n</th>
										<th>Seller Name</th>
										<th>Client Name</th>
										<th>Item Name</th>
										<th>Quantity</th>
										<th>Price</th>
										<th>Transaction Date</th>
										<th>Action</th>
									</thead>
									<tbody style="font-size: 15px;" id="tbody_sales">
										<?php
										$c_date=date("Y-m-d");
										while($row=mysqli_fetch_array($selectSales))
										{
											echo'<tr>';
												echo'<td>'.$row['id'].'</td>';
												echo'<td>'.$row['seller_name'].'</td>';
												echo'<td>'.$row['customer_name'].'</td>';
												echo'<td>'.$row['item_name'].'</td>';
												echo'<td>'.$row['quantity'].'</td>';
												echo'<td>Ths'.number_format($row['total_price']).'</td>';
												echo'<td>'.$row['date_sale'].'</td>';
												echo'<td>
													<label id="'.$row['id'].'" class="labelAction deleteSale" style="margin-left: 10px;"><i class="fas fa-trash-alt"></i></label>
													';
													if($row['date_sale']==$c_date)
													{
														echo'<label class="newSale"><i>New</i></label>';
													}
													else{}
													'
												</td>';
											echo'</tr>';
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- ---------------------------------------- -->
						<div class="salesContents receiptsContainer">
							<?php
							$select=mysqli_query($conn,"select * from sales where pharmacistId='$id' GROUP BY timestamp order by id desc");
							$num_rows=mysqli_num_rows($select);
							?>
							<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
								<div style="float: right;">
									<label>Total Receipts &nbsp;<?php echo $num_rows; ?></label>
								</div>
								<h6>Sales Receipts</h6>
							</div>
							<div style="padding: 20px;" id="container">
								<table class="table table-bordered" style="color: teal;border:1.5px solid black">
									<thead style="font-size: 14px;">
										<th>S/n</th>
										<th>Seller Name</th>
										<th>Client Name</th>
										<th>Transaction Date</th>
										<th>Action</th>
									</thead>
									<tbody style="font-size: 15px;" id="tbody_sales">
										<?php
										$i=1;
										while($row=mysqli_fetch_array($select))
										{
											echo'<tr>';
												echo'<td>'.$i.'</td>';
												echo'<td>'.$row['seller_name'].'</td>';
												echo'<td>'.$row['customer_name'].'</td>';
												echo'<td>'.$row['date_sale'].'</td>';
												echo'<td>
													<label id="'.$row['timestamp'].'" class="labelAction viewReceiptBtn" style="margin-left: 10px;"><i class="fas fa-eye"></i>&nbsp; View</label>
													';
													if($row['date_sale']==$c_date)
													{
														echo'<label class="newReceipt"><i>New</i></label>';
													}
													else{}
													'
												</td>';
											echo'</tr>';
											$i++;
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</article>
		</div>
	</div>
	<div class="loadingHoverContainer">
		<div class="loadingContainer">
			<img src="images/icons/double_loading.svg" height="150">
		</div>
	</div>
</body>
<div class="hover-container">
	<div class="container confirmation-main-container">
		<div style="padding: 10px;border-bottom: 1px solid silver;color: darkslategray;font-weight: 500px;">
			<label><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Delete Confirmation</label>
		</div>
		<div style="padding: 20px;">
			Are you sure you want to delete all Sales
			<br><br>
			<div style="height: 40px;">
				<div style="float: right;">
					<button class="btn btn-info noBtn"><i class="fas fa-times"></i>&nbsp;&nbsp;No</button>&nbsp;
					<button class="btn btn-danger yesBtn"><i class="fas fa-check"></i>&nbsp;&nbsp;Yes</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="displayDeleteSaleResult"></div>
<div class="displayMonthlySaleResult"></div>
<div class="displayReceiptContainer"></div>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#dataTables').DataTable();
		//-------------------------->>
		$(".deleteSale").click(function(){
			var saleId=$(this).attr("id");
			$.ajax({
				url:"ajax/ajaxQueryManager3.php",
				method:"post",
				async:false,
				data:{"saleId":saleId},
				success:function(data)
				{
					$(".displayDeleteSaleResult").html(data);
				}
			});
		});
		//----------------------------------->>
		$("#monthlySalesBtn").on('click',function(){
	    	if($("#monthlySaleCont").css("display")=="none")
	    	{
	    		$("#monthlySaleCont").slideDown('slow');
	    	}
	    	else
	    	{
	    		$("#monthlySaleCont").slideUp('slow');
	    	}
	    });
	    //------------------------>>
		$("#printBtn").click(function(){
			$("#dataTables").printThis({
				debug: false,               // show the iframe for debugging
		        importCSS: true,            // import parent page css
		        importStyle: false,         // import style tags
		        printContainer: true,       // print outer container/$.selector
		        loadCSS: "http://localhost/pharmacy%20system/bootstrap/css/bootstrap.min.css",                // path to additional css file - use an array [] for multiple
		        pageTitle: "Sales Report",              // add title to print page
		        removeInline: true,        // remove inline styles from print elements
		        removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
		        printDelay: 333,            // variable print delay
		        header: "<h4><center>Sales Report</center></h4><br>",               // prefix to html
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
		//--------------------------------------->>
		$(".viewBtn").click(function(){
			var monthId=$(this).attr("id");
			$.ajax({
				url:"ajax/ajaxQueryManager3.php",
				method:"post",
				async:false,
				data:{monthId:monthId},
				success:function(data)
				{
					$(".displayMonthlySaleResult").html(data);
				}
			});
		});
		$(window).scroll(function() {
		    if($(this).scrollTop()>800)
		    {
		       $('#goTop').show(1000);
		    }
		    else
		    {
		       $('#goTop').hide(1000);
		    }
		});
		$("#goTop").on('click', function(e) {
		   e.preventDefault();
		   $('html, body').animate({scrollTop:0}, '800');
		});
		//--------------------------->>
		$("#deleteAllSalesBtn").click(function(){$(".hover-container").slideDown();});
		$(".noBtn").click(function(){$(".hover-container").slideUp();});
		$(".yesBtn").click(function(){
			$.ajax({
				url:"ajax/deleteAllSales.php",
				method:"post",
				async:false,
				success:function(){
					UpdateSalesTable();
					$(".hover-container").slideUp();
				}
			});
		});
		function UpdateSalesTable()
		{
			$.ajax({
				url:"ajax/updateTable/ajaxUpdateSalesTable.php",
				method:"post",
				success:function(data)
				{
					$(".salesContents").html(data);
				}
			});
		}
		//---------------------------->>
		$(".viewReceiptContBtn").click(function(){
			$(".salesContainer").hide(700);
			$(".receiptsContainer").show(700);
			$(".viewSalesContBtn").show();
			$(".viewReceiptContBtn").hide();
			$(".dlt_allSalesCont").hide();
		});
		//---------------------------->>
		$(".viewSalesContBtn").click(function(){
			$(".salesContainer").show(700);
			$(".receiptsContainer").hide(700);
			$(".viewSalesContBtn").hide();
			$(".viewReceiptContBtn").show();
			$(".dlt_allSalesCont").show();
		});
		//-------------------------------->>
		$(".viewReceiptBtn").click(function(){
			var timestamp=$(this).attr("id");
			$.ajax({
				url:"ajax/query.php",
				method:"post",
				async:false,
				data:{saleId2:timestamp},
				success:function(data){
					$(".loadingHoverContainer").show();
					setTimeout(function(){
						$(".loadingHoverContainer").hide();
						$(".displayReceiptContainer").html(data);
					},3000);
				}
			});
		});
	});
</script>