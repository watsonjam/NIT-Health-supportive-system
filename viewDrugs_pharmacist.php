<?php 
include("includes/db_connection.php");
include("includes/security3.php");

$select=mysqli_query($conn,"select * from pharmacist where id='$id'");
$row=mysqli_fetch_array($select);
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
        .searchContainer{float: right;margin-bottom: 20px;}
        .searchContainer input{border:1px solid silver;padding-left: 10px;outline: none;border-radius: 4px;line-height: 30px;margin-left: 5px;width:inherit;}
        .searchContainer input:focus{box-shadow: 0px 0px 7px 0px #2980B9;}
        .searchContainer label{font-weight: 500}
        .searchingDataIcon{position: absolute;margin-top: 5px;right: 24px;display: none;}
        .selling_info_hover_container{position: fixed;left: 20%;top:19%;background-color: rgba(0,0,0,.6);width: 90%;height: 100%;z-index: 300;}
        .selling_info_container{margin-top: 10%;width: 30%;background-color: white;border-radius: 3px;box-shadow: 0px 0px 20px 0px rgba(0,0,0,.5);margin-left: 25%;}
        .highlight{background: #ABEBC6;}
        .addMultipleDrugBtn{display: none;}
        #tr_cart:hover{background-color: #ABEBC6}
        #tr_cart{cursor: pointer;}
        .infoSmry span{display: inline-block;vertical-align: top;padding:16px 18px;background-color: #F5B041;margin-left: -3px;border: 1.5px solid #D4AC0D;border-radius: 1px;}
	</style>
</head>
<?php
include("includes/pharmacist_header.php");
?>
<div class="sellingDrugInfo"></div>
<div class="notificationCont"></div>
<body style="overflow-x: hidden;">
	<div class="row">
		<div class="col-md-3">
			<?php
			include("includes/aside_pharmacist.php");
			?>
		</div>
		<?php
		$selectAsbentDrug=mysqli_query($conn,"select * from drugs where quantity='0'");
		$num_rows1=mysqli_num_rows($selectAsbentDrug);
		//------------------------------->>
		$date=date("Y-m-d");
		$selectExpiredDrug=mysqli_query($conn,"select * from drugs where expire_date<='$date'");
		$num_rows2=mysqli_num_rows($selectExpiredDrug);
		?>
		<div class="col-md-9">
			<div class="pathMaincont" style="height: 55px;">
				<div class="infoSmry" style="float: right;margin-right: 20px;">
					<span></span>
					<label style="font-weight: 500;color:#B7950B; ">Absent Drugs &nbsp;<?php echo $num_rows1; ?></label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span style="background-color: #F1948A;border: 1.5px solid #E74C3C"></span>
					<label style="font-weight: 500;color:#C0392B">Expired Drugs &nbsp;<?php echo $num_rows2; ?></label>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button style="height: 36px;" id="refreshBtn" class="btn btn-success"><i class="fas fa-redo-alt"></i>&nbsp;&nbsp;Refesh Page</button>
				</div>
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Drugs</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="mainContainer">
						<div class="drugs">
							<?php
							$select=mysqli_query($conn,"select * from drugs");
							$num_rows=mysqli_num_rows($select);
							?>
							<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
								<div style="float: right;">
									<label>Total Drugs &nbsp;<?php echo $num_rows; ?></label>
								</div>
								<h6><i class="fas fa-pills" style="font-size: 22px;"></i>&nbsp;&nbsp; Manage Drugs</h6>
							</div>
							<div style="padding: 15px;">
								<div>
	                                <div class="searchContainer">
	                                    <div class="searchingDataIcon"><img src="images/icons/lod.gif" height="20"></div>
	                                    <label>Search:&nbsp;</label><input type="text" name="search" id="search" placeholder="search by drug name..." autocomplete="off">
	                                </div>
	                                <div class="addMultipleDrugCont">
	                                	<button class="btn btn-success addMultipleDrugBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to Cart</button>
	                                	<div style="margin-top: 10px;">
	                                		<label class="totalChacked"></label>
	                                	</div>
	                                </div>
	                            </div>
								<table class="table table-bordered table-hover nowrap drugTable" id="dataTable" style="color: teal">
									<thead style="font-size: 14px;">
										<th>Select</th>
										<th>S/n</th>
										<th>Drug Name</th>
										<th>Manufacture Date</th>
										<th>Expire Date</th>
										<th>Quantity</th>
										<th>Price</th>
										<th>Registration Date</th>
										<th>Status</th>
										<th>Action</th>
									</thead>
									<tbody style="font-size: 15px;">
										<?php
										$i=1;
										while($row=mysqli_fetch_array($select))
										{
											if($row['expire_date']<=date("Y-m-d"))
											{
												?>
												<tr style="background-color:#F1948A;">
													<td>
														<input id="checksBox-<?php echo $i; ?>" class="checkbox-custom" name="chckbox[]" type="checkbox" value="<?php echo $row['id']; ?>" style="cursor: no-drop;" disabled> 
                                                        <label for="checksBox-<?php echo $i; ?>" class="checkbox-custom-label" style="cursor: no-drop;"></label>
													</td>
													<td><?php echo $i; ?></td>
													<td><?php echo $row['drug_name']; ?></td>
													<td><?php echo $row['manufacture_date']; ?></td>
													<td><?php echo $row['expire_date']; ?></td>
													<td><?php echo $row['quantity']." ".$row['quantity_type']; ?></td>
													<td>Ths <?php echo number_format($row['price']); ?></td>
													<td><?php echo $row['registration_date']; ?></td>
													<td>Expired</td>
													<td style="text-align: center;">
														<label id="<?php echo $row['id'] ?>" class="labelAction" style="cursor: no-drop;"><i class="fas fa-cart-plus"></i></label>
													</td>
												</tr>
												<?php
											}
											else if($row['quantity']<=0)
											{
												?>
													<tr style="background-color:#F5B041;">
														<td>
															<input id="checksBox-<?php echo $i; ?>" class="checkbox-custom" name="chckbox[]" type="checkbox" value="<?php echo $row['id']; ?>" style="cursor: no-drop;" disabled> 
                                                        <label for="checksBox-<?php echo $i; ?>" class="checkbox-custom-label" style="cursor: no-drop;"></label>
														</td>
														<td><?php echo $i; ?></td>
														<td><?php echo $row['drug_name']; ?></td>
														<td><?php echo $row['manufacture_date']; ?></td>
														<td><?php echo $row['expire_date']; ?></td>
														<td><?php echo $row['quantity']; ?></td>
														<td>Ths <?php echo number_format(0); ?></td>
														<td><?php echo $row['registration_date']; ?></td>
														<td>Absent</td>
														<td style="text-align: center;">
															<label id="<?php echo $row['id'] ?>" class="labelAction" style="cursor: no-drop;"><i class="fas fa-cart-plus"></i></label>
														</td>
													</tr>
													<?php
											}
											else
											{
												?>
												<tr id="tr_cart">
													<td id="td">
														<input id="checksBox-<?php echo $i; ?>" class="checkbox-custom checkItems" name="chckbox[]" type="checkbox" value="<?php echo $row['id']; ?>"> 
                                                        <label for="checksBox-<?php echo $i; ?>" class="checkbox-custom-label"></label>
													</td>
													<td id="td"><?php echo $i; ?></td>
													<td id="td"><?php echo $row['drug_name']; ?></td>
													<td id="td"><?php echo $row['manufacture_date']; ?></td>
													<td id="td"><?php echo $row['expire_date']; ?></td>
													<td id="td"><?php 
													if($row['updated_quantity']<=0)
													{
														echo $row['quantity']." ".$row['quantity_type']; 
												    }
												    else
												    {
												    	echo $row['updated_quantity']." ".$row['quantity_type'];
												    }
													?></td>
													<td id="td">Ths <?php echo number_format($row['price']); ?></td>
													<td id="td"><?php echo $row['registration_date']; ?></td>
													<td id="td"><?php echo $row['status']; ?></td>
													<td id="td" style="text-align: center;">
														<label id="<?php echo $row['id'] ?>" class="labelAction addToCart"><i class="fas fa-cart-plus"></i></label>
													</td>
												</tr>
												<?php
											}
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
	<div class="displaAddProductToCartResult"></div>
	<input type="text" id="employeeId" name="employeeId" value="<?php echo $id; ?>" style="display:none">
    <input type="text" id="token" name="token" value="<?php echo $token; ?>" style="display:none">
</body>
</html>
<script type="text/javascript">
	$(document).ready(function () {
		//---------------------->>
		$('#refreshBtn').click(function(){window.location.reload();});
		//----------------------->>
		$("#viewDrugs").on('click',function(){
			$(".drugs").slideDown("slow");
			$(".equipments").hide();
		});
		//---------------------->>
		$(".addToCart").click(function(){
			var drugId=$(this).attr("id");
			var employeeId=$("#employeeId").val();
            var token=$("#token").val();
			$.ajax({
				url:"ajax/ajaxAddProductToCart.php",
				method:"post",
				async:false,
				data:{
					"drugId":drugId,
					"employeeId":employeeId,
                    "token":token
				},
				success:function(data)
				{
					$(".displaAddProductToCartResult").html(data);
				}
			});
		});
        //-------------------------->>
        $("#search").keyup(function(){
            var search=$(this).val();
            var employeeId=$("#employeeId").val();
            var token=$("#token").val();
            $.ajax({
                url:"ajax/search/searchingDrug.php",
                type:"post",
                data:{search:search,employeeId:employeeId,token:token},
                success:function(data)
                {
                    $(".searchingDataIcon").show();
                    setTimeout(function(){
                        $(".searchingDataIcon").hide();
                        $("#dataTable").html(data);
                    },1000);
                }
            });
        });
        //---------------------------------->>
        setInterval(function(){
        	$.ajax({
        		url:"ajax/load/switched_sellingDrugs.php",
        		method:"post",
        		success:function(data)
        		{
        			$(".sellingDrugInfo").html(data);
        		}
        	});
        },100);
        //---------------------------------->>
        setInterval(function(){
        	$.ajax({
        		url:"ajax/load/updates.php",
        		method:"post",
        		success:function(data)
        		{
        			$(".notificationCont").html(data);
        		}
        	});
        },1000);
        //------------------------>>
      $('.checkItems').change(function() {
        $(this).closest('#tr_cart').toggleClass("highlight", this.checked);
        //--------------------------->>
        var total=$(".checkItems:checked").length;
        if(total==0){
            $(".totalChacked").html("");
            $(".addMultipleDrugBtn").hide();
        }
        else if(total==1){
            $(".totalChacked").html(total+"&nbsp;&nbsp;Item Selected");
            $(".addMultipleDrugBtn").show();
        }
        else{
            $(".totalChacked").html(total+"&nbsp;&nbsp;Items Selected");
            $(".addMultipleDrugBtn").show();
        }

      });
      //------------------------------>>
      $(".drugTable tr").click(function(event){
      	$(this).toggleClass("highlight", this.checked);
      	if(event.target.type !=='checkbox')
      	{
      		$(':checkbox',this).trigger('click');
      	}
      });
      //---------------------------->>
      $(".addMultipleDrugBtn").click(function(){
            var id=[];
            var employeeId=$("#employeeId").val();
            var token=$("#token").val();
            $('.checkItems:checked').each(function(i){
                id[i] = $(this).val();
            });
            $.ajax({
                url:"ajax/addMultipleDrug.php",
                method:"post",
                async:false,
                data:{checkedId:id,employeeId:employeeId,token:token},
                success:function(data)
                {
                    
                    $(".displaAddProductToCartResult").html(data);
                }
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
	});
</script>





