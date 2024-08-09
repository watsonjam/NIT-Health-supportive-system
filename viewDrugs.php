<?php 
include("includes/db_connection.php");
include("includes/security2.php");
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include("includes/head.php");
	?>
	<title>NIT Health Supportive System</title>
	<style type="text/css">
		.labelAction{color: #3498DB;cursor: pointer;}
		.labelAction:active{color: transparent;}
		.deleteEqu{color: #E74C3C;}
		.delete{color: #E74C3C;}
		.salesProductBtn{line-height: 35px;margin-top: -10px;background-color: #3498DB;border:1px solid #1A5276;color: white;cursor: pointer;border-radius: 4px;font-size: 16px;width: 20%;}
		.salesProductBtn:active{border:1px solid #1A5276;background:linear-gradient(#3498DB,#D6EAF8);}
		.inputIcon{position: absolute;margin:8px;margin-top: 11px;color: gray;}
		.addNewEquipmentsMainCont{display: none;position: absolute;width: 70%;z-index: 20;top: 5%;margin-left: 10%;background-color: white;box-shadow: 0px 10px 30px rgba(0,0,0,.9);border-radius: 4px;}
		.AddNewDrugsMainCont{display: none;position: absolute;width: 70%;z-index: 100;top: -70%;margin-left: 10%;background-color: white;box-shadow: 0px 10px 30px rgba(0,0,0,.9);border-radius: 4px;}
		.viewExpiredDrugCont{box-sizing: border-box;border: 1px solid silver;padding: 5px;position: absolute;width: 75%;margin-top: 3px;border-radius: 3px;box-shadow: 0px 4px 2px rgba(0,0,0,.2), 0px 3px 6px rgba(0,0,0,.4);padding-left: 12px;display: none;right: 179px;background-color: white;}
		.viewExpiredDrugCont:before{content: "";float: right;border:11.5px solid transparent;border-bottom-color: silver;width: 0px;height: 0px;margin-top: -16px;border-top: 0px;margin-right: 8px;}
		.viewExpiredDrugCont:after{content: "";border:9.5px solid transparent;border-bottom-color: white;width: 0px;height: 0px;position: absolute;border-top: 0px;right: 14.5px;top: -9px;}
		.addMultipleDrugMainContainer{position: absolute;top: 0px;left: 0px;width: 100%;height: inherit;background-color: white;z-index: 200;}
		.addNewMultipleDrugsCont{position: relative;width: 60%;margin-top: 5%;background-color: white;box-shadow: 0px 10px 30px rgba(0,0,0,.9);border-radius: 4px;margin-bottom: 5%;}
		.addMultipleDrugHeader{padding: 14px;background-color: lavender;border-bottom: 2px solid silver;color:darkslategray;position: fixed;top: 0px;left: 0px;width: 100%;z-index: 100;}
		.infoSmry span{display: inline-block;vertical-align: top;padding:16px 18px;background-color: #F5B041;margin-left: -5px;border: 1.5px solid #D4AC0D;border-radius: 1px;margin-top: -5px;}
		.highlight{background: #ABEBC6;}
		#tr_cart:hover{background-color: #D5F5E3}
        #tr_cart{cursor: pointer;}
        .totalChackedCont{position: absolute;left: 170px;display: none;}
        .confirmDeleteContainer{position: fixed;top: 0px;left: 0px;float: none;background-color: rgba(0,0,0,.6);
		    width: 100%;height: 100%;z-index: 14;display: none;
		}
		.deleteMainCont{width: 35%;margin-left:35%;margin-top: 10%;background-color: white;border-radius: 3px;
		    box-shadow: 0px 20px 10px rgba(0,0,0,.4);animation: 1s deleteCont;position: relative;
		}
		@keyframes deleteCont{from{top: -300px;opacity: 0}to{top: 0px;opacity: 1}
	</style>
</head>
<?php
include("includes/doctor_header.php");
?>
<body style="overflow-x: hidden;">
	<div class="row">
		<div class="col-md-3">
			<?php
			include("includes/aside_doctor.php");
			?>
		</div>
		<div class="col-md-9 drugCont">
			<div class="pathMaincont" id="pathCont">
				<div style="float: right;margin-right: 20px;" id="notifContainer">
					<label style="font-weight: 500;color:#B7950B;cursor: pointer; " id="endingSoon">Drugs Ending Soon &nbsp;<span class="totalEndgSoon"></span></label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label style="font-weight: 500;color:#B7950B;cursor: pointer; " id="absentDrug">Absent Drugs &nbsp;<span class="totalAbsntDrg"></span></label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label style="font-weight: 500;color:#C0392B;cursor: pointer;" id="expiredDrug">Expired Drugs &nbsp;<span class="totalExpDrg"></span></label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label style="font-weight: 500;color:#C0392B;cursor: pointer;" id="snExpiredDrug">Expire Soon &nbsp;</label>
					<div class="viewExpiredDrugCont" id="drugEndgSoonCont" style="width: 55%;right:528px;display: none;">
						<div class="displayDrugEndgSoonCont"></div>
					</div>
					<div class="viewExpiredDrugCont" id="ExpiredDrugCont">
						<div class="displayExpiredDrugsCont"></div>
					</div>
		 			<div class="viewExpiredDrugCont" id="absentDrugCont" style="width: 30%;right:355px;display: none;">
		 				<div class="displayAbsentDrugsCont"></div>
		 			</div>
		 			<div class="viewExpiredDrugCont" id="soonExpDrugCont" style="width: 65%;right:10px;display: none;">
		 				<div class="displayDrugSoonExpCont"></div>
		 			</div>
				</div>
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Drugs</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="infoSmry" style="width: 100%;">
						<div style="float: right;"><button style="height: 36px;margin-top: -8px;" id="refreshBtn" class="btn btn-success"><i class="fas fa-redo-alt"></i>&nbsp;&nbsp;Refesh Page</button></div>
						<span></span>
						<label>Absent Drugs</label>
						&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
						<span style="background-color: #F1948A;border: 1.5px solid #E74C3C"></span>
						<label>Expired Drugs</label>
					</div><br>
					<div class="mainContainer">
						<div class="drugs">
							<?php
							$select=mysqli_query($conn,"select * from drugs");
							$num_rows=mysqli_num_rows($select);
							?>
							<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
								<div style="float: right;">
									&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
									<label>Total Drugs &nbsp;<?php echo $num_rows; ?></label>
								</div>
								<div class="totalChackedCont">
									&nbsp;&nbsp;|&nbsp;
									<label style="font-weight:500;font-size:16px;letter-spacing:0.5px;margin-left:20px;display: inline-block;margin-top: 5px;" id="totalChacked"></label>
								</div>
								<h6><i class="fas fa-pills" style="font-size: 22px;"></i>&nbsp;&nbsp;Drugs</h6>
							</div>
							<?php
							if($num_rows<=0)
							{
								?>
								<div style="padding: 60px;color: gray">
									<center>
										<i class="fas fa-exclamation-triangle" style="font-size:115px;position:absolute;opacity:0.2;margin-top: -40px;margin-left:20px;"></i>
										<label style="font-weight: 500;font-size: 16px;letter-spacing: 0.7px">Empty! No data available</label>
									</center>
								</div>
								<?php
							}
							else
							{
								?>
								<div style="padding: 20px;">
									<label id="deleteError" style="color: red;margin-left: 18px;"></label>
									<table class="table table-bordered table-hover nowrap drugTable" id="dataTables" style="color: teal">
										<thead style="font-size: 14px;">
											<th>S/n</th>
											<th>Drug Name</th>
											<th>Manufacture Date</th>
											<th>Expire Date</th>
											<th>Quantity</th>
											<th>Buying Price</th>
											<th>Sale Price</th>
											<th>Status</th>
										</thead>
										<tbody style="font-size: 15px;" id="tbody_drugs">
											<?php
											$x=1;
											while($row=mysqli_fetch_array($select))
											{
												$exDate=strtotime($row['expire_date']);
												$dateNow=strtotime(date("Y-m-d"));
												if($exDate<=$dateNow)
												{
													?>
													<tr id="tr_cart" style="background-color:#F1948A;">
														<td><?php echo $x; ?></td>
														<td><?php echo $row['drug_name']; ?></td>
														<td><?php echo $row['manufacture_date']; ?></td>
														<td><?php echo $row['expire_date']; ?></td>
														<td><?php echo $row['quantity']." ".$row['quantity_type']; ?></td>
														<td>Ths <?php echo number_format($row['buyingPrice']); ?></td>
														<td>Ths <?php echo number_format($row['price']); ?></td>
														<td>Expired</td>
													</tr>
													<?php
												}
												else if($row['quantity']<=0)
												{
													?>
														<tr style="background-color:#F5B041;" id="tr_cart">
															<td><?php echo $x; ?></td>
															<td><?php echo $row['drug_name']; ?></td>
															<td><?php echo $row['manufacture_date']; ?></td>
															<td><?php echo $row['expire_date']; ?></td>
															<td><?php echo $row['quantity']; ?></td>
															<td>Ths <?php echo number_format(0); ?></td>
															<td>Ths <?php echo number_format(0); ?></td>
															<td>Absent</td>
														</tr>
														<?php
												}
												else
												{
													?>
													<tr id="tr_cart">
														<td><?php echo $x; ?></td>
														<td><?php echo $row['drug_name']; ?></td>
														<td><?php echo $row['manufacture_date']; ?></td>
														<td><?php echo $row['expire_date']; ?></td>
														<td><?php 
														if($row['updated_quantity']<=0)
														{
															echo $row['quantity']." ".$row['quantity_type']; 
													    }
													    else
													    {
													    	echo $row['updated_quantity']." ".$row['quantity_type'];
													    }
														?></td>
														<td>Ths <?php echo number_format($row['buyingPrice']); ?></td>
														<td>Ths <?php echo number_format($row['price']); ?></td>
														<td></td>
													</tr>
													<?php
												}
												$x++;
											}
											?>
										</tbody>
									</table>
								</div>
								<?php
							}
							?>
						</div>
				</div>
			</article>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function () {
		//-------------------------->>
		$('#dataTables').DataTable();
		//----------------------------->>
		$(".addNewDrugBtn").click(function(){
			$(".AddNewDrugsMainCont").slideDown("slow");
		});
		//-------------------------->>
		$("#closeAddNewDrugCont").click(function(){
			$(".AddNewDrugsMainCont").slideUp("slow");
		});
		//---------------------->>
		$("#viewDrugs").on('click',function(){
			$(".drugs").slideDown("slow");
		});
		//------------------------>>
		$("#expiredDrug").on('click',function(){
	    	if($("#ExpiredDrugCont").css("display")=="none")
	    	{
	    		$("#ExpiredDrugCont").slideDown('slow');
	    		$("#absentDrugCont").slideUp('slow');
	    		$("#drugEndgSoonCont").slideUp('slow');
	    		$("#soonExpDrugCont").slideUp('slow');
	    		setInterval(function(){
	    			$.ajax({
		    			url:"ajax/ajaxViewExpiredDrugs.php",
		    			method:"post",
		    			async:false,
		    			data:{expdId:''},
		    			success:function(data)
		    			{
		    				$(".displayExpiredDrugsCont").html(data);
		    			}
		    		});
	    		},1000);
	    	}
	    	else
	    	{
	    		$("#ExpiredDrugCont").slideUp('slow');
	    	}
	    });
	    //------------------------>>
		$("#absentDrug").on('click',function(){
	    	if($("#absentDrugCont").css("display")=="none")
	    	{
	    		$("#absentDrugCont").slideDown('slow');
	    		$("#ExpiredDrugCont").slideUp('slow');
	    		$("#drugEndgSoonCont").slideUp('slow');
	    		$("#soonExpDrugCont").slideUp('slow');
	    		$.ajax({
	    			url:"ajax/ajaxViewExpiredDrugs.php",
	    			method:"post",
	    			async:false,
	    			data:{absntId:''},
	    			success:function(data)
	    			{
	    				$(".displayAbsentDrugsCont").html(data);
	    			}
	    		});
	    	}
	    	else
	    	{
	    		$("#absentDrugCont").slideUp('slow');
	    	}
	    });
	    //------------------------>>
		$("#endingSoon").on('click',function(){
	    	if($("#drugEndgSoonCont").css("display")=="none")
	    	{
	    		$("#absentDrugCont").slideUp('slow');
	    		$("#ExpiredDrugCont").slideUp('slow');
	    		$("#drugEndgSoonCont").slideDown('slow');
	    		$("#soonExpDrugCont").slideUp('slow');
	    		$.ajax({
	    			url:"ajax/ajaxViewExpiredDrugs.php",
	    			method:"post",
	    			async:false,
	    			data:{drgEndSnId:''},
	    			success:function(data)
	    			{
	    				$(".displayDrugEndgSoonCont").html(data);
	    			}
	    		});
	    	}
	    	else
	    	{
	    		$("#drugEndgSoonCont").slideUp('slow');
	    	}
	    });
	    //------------------------>>
		$("#snExpiredDrug").on('click',function(){
	    	if($("#soonExpDrugCont").css("display")=="none")
	    	{
	    		$("#absentDrugCont").slideUp('slow');
	    		$("#ExpiredDrugCont").slideUp('slow');
	    		$("#drugEndgSoonCont").slideUp('slow');
	    		$("#soonExpDrugCont").slideDown("slow");
	    		setInterval(function(){
	    			$.ajax({
		    			url:"ajax/ajaxViewExpiredDrugs.php",
		    			method:"post",
		    			async:false,
		    			data:{drgSnExpId:''},
		    			success:function(data)
		    			{
		    				$(".displayDrugSoonExpCont").html(data);
		    			}
		    		});
	    		});
	    	}
	    	else
	    	{
	    		$("#soonExpDrugCont").slideUp('slow');
	    	}
	    });
		//------------------------------>>
		//--------------------->>
	    $("#refreshBtn").click(function(){
	    	window.location.reload();
	    });
		//----------------------------------->>
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
		///////////////////////////////////
		setInterval(function(){
			$.ajax({
				url:"ajax/load/loadInfo.php",
				method:"post",
				data:{contentId:''},
				success:function(data)
				{
					$(".totalAbsntDrg").html(data);
				}
			});
		},200);
		///////////////////////////////////
		setInterval(function(){
			$.ajax({
				url:"ajax/load/loadInfo.php",
				method:"post",
				data:{contentId2:''},
				success:function(data)
				{
					$(".totalExpDrg").html(data);
				}
			});
		},200);
		///////////////////////////////////
		setInterval(function(){
			$.ajax({
				url:"ajax/load/loadInfo.php",
				method:"post",
				data:{contentId3:''},
				success:function(data)
				{
					$(".totalEndgSoon").html(data);
				}
			});
		},200);
	});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////----------------------------->>
	var buyingPrice=document.getElementById('buyingPrice');
	var salePrice=document.getElementsByClassName('salePrice')[0];
	var profit=document.getElementsByClassName('proft')[0];

	function displayProfit()
	{
		if(buyingPrice.value=="" && salePrice.value=="")
		{
			profit.value="";
		}
		else
		{
			var totalProf;
			totalProf=salePrice.value - buyingPrice.value;
			profit.value=totalProf;
		}
	}
	
</script>