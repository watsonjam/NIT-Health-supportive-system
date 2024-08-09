<?php 
include("includes/db_connection.php");
include("includes/security3.php");

//------------------------------>>

?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include("includes/head.php");
	?>
	<title>NIT Health Supportive System</title>
	<link rel="stylesheet" type="text/css" href="css/cart.css">
    <style>
        .expiredNotif label{
            color: #CD6155;
            letter-spacing: 0.5px;
        }
        .shopLoadingContainer{position: fixed;top: 0px;float: none;width: 100%;height: 100%;left: 0px;background-color: rgba(0,0,0,.6);z-index: 100;margin: 0px;display: none;}
        #tr_cart:hover{background-color: #ABEBC6;}
        .searchTxtBox{width: 300px;display: inline-block;padding: 4px;outline: none;border-radius: 3px;
            border:1px solid silver;color: darkslategray;padding-left: 35px;
        }
        .inputIcon{margin-top: 9px;font-size: 18px;}
        .closeSearch{font-size: 22px;margin-left: 25px;cursor: pointer;background-color: transparent;
            border:1px solid transparent;color:grey;
        }
        .closeSearch:active{color: transparent;}
        .loadData{position: absolute;right: 80px;margin-top: 6px;display: none;}
        #timerContainer{font-size: 20px;color: #CB4335}

    </style>
</head>
<?php
include("includes/pharmacist_header.php");

$select=mysqli_query($conn,"select * from pharmacist where id='$id'");
$row=mysqli_fetch_array($select);

if(isset($_POST['updateQuantityBtn']))
{
    $prd_id=$_POST['prd_id'];
    $drugId=$_POST['drugId'];
    $quantity=$_POST['quantity'];
    $error="";
    if(empty($quantity))
    {
        $error="quantity can't be empty";
    }
    else
    {
        if($quantity<0)
        {
            $error="quantity can't be less than 1";
        }
        else
        {
            
            if(preg_match_all('/^[0-9]+$/',$quantity))
            {
            	$select2=mysqli_query($conn,"select * from drugs where id=$drugId");
                $row2=mysqli_fetch_array($select2);
                $qnty=$row2['quantity'];

                if($quantity>$qnty)
                {
                	$error="quantity can't be greater than ".$qnty;
                }
                else if($qnty>$quantity)
                {
                	$update=("update cart set quantity='$quantity' where id='$prd_id'");
                    $result=mysqli_query($conn,$update);
                    if($result)
                    {
                        //update quantity
                        $select=mysqli_query($conn,"select * from cart where id=$prd_id");
                        $row=mysqli_fetch_array($select);
                        $price=$row['price'];
                        $profit=$row['profit'];
                        //----------------->>
                        //----------------->>
                        //update price when quanity change
                        for($i=0;$i<$quantity;$i++)
                        {
                            $total=$quantity*$price;
                        }
                        $profit=$quantity*$profit;
                        $total_quantity=$qnty-$quantity;
                        $update2=mysqli_query($conn,"update cart set total_price='$total',total_profit='$profit' where id=$prd_id and pharmacistId='$id'");
                        $update=mysqli_query($conn,"update drugs set updated_quantity='$total_quantity' where id='$drugId'");
                    }
                }
                else{
                	$update=("update cart set quantity='$quantity' where id='$prd_id'");
                    $result=mysqli_query($conn,$update);
                    if($result)
                    {
                        //update quantity
                        $select=mysqli_query($conn,"select * from cart where id=$prd_id");
                        $row=mysqli_fetch_array($select);
                        $price=$row['price'];
                        $profit=$row['profit'];
                        //----------------->>
                        //----------------->>
                        //update price when quanity change
                        for($i=0;$i<$quantity;$i++)
                        {
                            $total=$quantity*$price;
                        }
                        $profit=$quantity*$profit;
                        $total_quantity=$qnty-$quantity;
                        $update2=mysqli_query($conn,"update cart set total_price='$total',total_profit='$profit' where id=$prd_id and pharmacistId='$id'");
                        $update=mysqli_query($conn,"update drugs set updated_quantity='$total_quantity' where id='$drugId'");
                    }
                }
            }
            else{
                $error="quantity accept only numbers";
            }
        }
    }
}
?>
<body style="overflow-x: hidden;background-color:lavender">
    <div class="shopLoadingContainer">
        <center>
            <div style="color:white;margin-top:17%;">
                <img src="images/icons/double_loading.svg" height="130">
                <h5>Please Wait.....</h5>
            </div>
        </center>
    </div>
	<div class="row">
		<div class="col-md-3">
            <div class="goBack">
                <label title="click to go back" class="text-info"><a href="p_drugs?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-arrow-left"></i><span>Go Back</span></a></label>
            </div>
		</div>
		<div class="col-md-9">
			<div class="pathMaincont" style="padding-bottom: 10px;">
				<div style="float: right;margin-right:12px;">
                    <div id="searchCont" style="display: none;">
                        <i class="fas fa-search inputIcon"></i>
                        <div class="loadData"><img src="images/icons/lod.gif" height="20"></div>
                        <input type="text" name="searchTxtBox" id="searchTxtBox" class="searchTxtBox" placeholder="search.........">
                        <button class="closeSearch" style="outline: none;" title="close search"><i class="fas fa-times"></i></button>
                    </div>
                    <div id="mainCnt">
                        <button class="btn btn-success search" title="search"><i class="fas fa-search"></i>&nbsp;Search</button>
                    </div>
					<div class="container snoozedCartMainCont">
						<div class="displaySnoozeCartCont"></div>
					</div>
				</div>
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Cart</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
                    <div>
                        <div id="goTop" title="Go back to Top"><a href=""><i class="fas fa-angle-double-up fa-2x"></i></a></div>
                    </div>
                    <?php
                    $selectProduct=mysqli_query($conn,"select * from cart where pharmacistId='$id'");
                    $num_rows=mysqli_num_rows($selectProduct);
                    if($num_rows<=0)
                    {
                        echo"";
                    }
                    else
                    {
                    ?>
                    <center>
                        <div id="timerContainer">
                        <label style="margin-right:15px"><i class="fas fa-info-circle"></i>&nbsp;Note: &nbsp;&nbsp;This cart will expire after </label>
                          <label id="minutes"></label>&nbsp;&nbsp;
                          <label id="seconds"></label>
                        </div>
                        <div class="expiredCart"></div>
                    </center>
                    <?php
                    }
                    ?>
					<div class="displayProductMainCont" style="margin-top:3px;">
						<div id="cartContainer">
							<div style="padding: 10px ;background:linear-gradient(silver,white);border-bottom: 1px solid silver">
								<div style="float: right;">
									<label>Total Items In Cart : &nbsp;<?php echo $num_rows; ?></label>
								</div>
								<h6 style="color: darkslategray"><i class="fab fa-product-hunt"></i>&nbsp;&nbsp;Order Details</h6>
							</div>
							<div style="padding: 20px;">
								<?php
				                if($num_rows>=1)
				                {
				                	?>
                                <style>
                                    .highlight{
                                        background: #ABEBC6;
                                    }
                                </style>
				                	<form method="post" enctype="multipart/form-data">
                                        <div class="cartCont">
                                            <table class="display_cart_products" style="margin-top:3%;">
                                                <thead>
                                                    <th id="th"></th>
                                                    <th style="text-align: center;" id="th">S/n</th>
                                                    <th id="th" style="text-align:left;">ITEMS</th>
                                                    <th id="th">QUANTITY</th>
                                                    <th id="th">PRICE</th>
                                                    <th id="th">Total</th>
                                                    <th id="th" style="text-align: center;">Action</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i=1;
                                                    $select=mysqli_query($conn,"select * from cart where pharmacistId='$id'");
                                                    while($roows=mysqli_fetch_array($select))
                                                    {
                                                    ?>
                                                    <tr id="tr_cart">
                                                        <td id="td" style="padding-right:5px;">
                                                            <input id="checksBox-<?php echo $i; ?>" class="checkbox-custom checkItems" name="chckbox[]" type="checkbox" value="<?php echo $roows['drugId']; ?>"> 
                                                            <label for="checksBox-<?php echo $i; ?>" class="checkbox-custom-label"></label>
                                                        </td>
                                                        <td style="text-align: center;" id="td"><?php echo $i; ?></td>
                                                        <td id="td" style="width:50%;"><?php echo $roows['drug_name'] ?></td>
                                                        <td id="td" style="width:15%;">
                                                        <?php
                                                        if(isset($_POST['updateQuantityBtn']))
                                                        {
                                                            $prd_id=$_POST['prd_id'];
                                                            if($error and $roows['id']==$prd_id)
                                                            {
                                                            ?>
                                                            <div style="color:red;margin-bottom:10px;width:180%;" id="errorContainer">
                                                                <span><label style="font-size:15px;">*</label>&nbsp;<?php echo $error; ?></span><span style="font-size:20px;font-weight:bold;margin-left:15px;cursor:pointer;" onclick="closeErrorContainer()" title="Close Error">&times;</span>
                                                            </div>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                            <form method="post" enctype="multipart/form-data">
                                                                <input type="text" value="<?php echo $roows['quantity']; ?>" class="quantity" name="quantity" autocomplete="off" style="background-color:transparent;border:1px solid gray">
                                                                <br>
                                                                <input type="text" name="prd_id" value="<?php echo $roows['id']; ?>" style="display:none;">
                                                                <input type="text" name="drugId" value="<?php echo $roows['drugId']; ?>" style="display:none;">
                                                               <input type="submit" class="update_quantity" name="updateQuantityBtn" value="Update" style="outline: none;margin-left:1px;">
                                                            </form>
                                                        </td>
                                                        <div>
                                                            <td id="td">Tsh <?php echo number_format($roows['price']); ?> </td>
                                                            <td id="td">Tsh <?php echo number_format($roows['total_price']); ?></td>
                                                        </div>
                                                        <td id="td" style="text-align: center;">
                                                         <button style="outline: none;" class="delete_button_cart" type="button" name="delete_cart" id="<?php echo $roows['id']; ?>" value="<?php echo $roows['drugId']; ?>" title="remove from cart"><i class="fas fa-times"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <?php
                                            $totalAmnt=0;
                                            $select=mysqli_query($conn,"select * from cart where pharmacistId='$id'");
                                            while($rws=mysqli_fetch_array($select))
                                            {
                                                $totalAmnt +=$rws['total_price'];
                                            }
                                            ?>
                                            <div style="height: 50px;">
                                                <div style="margin-top: 10px;float: right;margin-right: -30px;">
                                                    <label style="font-weight: bolder;color: teal;letter-spacing: 0.3px;">Total Amount:</label>&nbsp;&nbsp;&nbsp;<input type="text" name="totalAmount" id="totalAmount" value="Tsh <?php echo number_format($totalAmnt); ?> /=" class="totalAmount" readonly="">
                                                </div>
                                                <div style="margin-top:22px;float:left;font-weight:500;font-size:14px;letter-spacing:0.5px;margin-left:6px;color:darkslategrey">
                                                    <label id="totalChacked"></label>
                                                </div>
                                            </div>
                                        </div>
				                        <div style="padding:22px;padding-left:0px;border-bottom:1px solid silver;font-size:13px;background-color:lavender">
				                        	<?php
		                                    if(isset($_POST['deleteChackedBox']))
		                                    {
		                                        if($error2)
		                                        {
		                                        ?>
		                                        <div style="color:red;margin-bottom:10px;width:180%;" id="errorContainer">
		                                            <span><label style="font-size:15px;">*</label>&nbsp;<?php echo $error2; ?></span><span style="font-size:20px;font-weight:bold;margin-left:15px;cursor:pointer;" onclick="closeErrorContainer()" title="Close Error">&times;</span>
		                                        </div>
		                                        <?php
		                                        }
		                                    }
		                                    ?>
				                        	<div style="float: right;">
                                                <a href="p_drugs?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><button style="margin-right:20px;" type="button" style="outline: none;" id="salesProductBtn" class="btn btn-success" title="continue shop drugs"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Continue Shop&nbsp;&nbsp;<i class="fas fa-cart-plus"></i></button></a>
					                        	<button style="outline:none" type="button" style="outline: none;" id="salesProductBtn" class="btn btn-primary salesProductBtn salesBtn" title="sale items">Checkout&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></button>
					                        </div>
                                            <div style="padding-bottom:10px;color:red;font-size:14px;letter-spacing:0.5px;" id="deleteError"></div>
				                            <img src="images/icons/arrow.png" style="float: left;">&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label class="checkContainer">
                                                <input type="checkbox" id="checksAll" style="cursor: pointer;" >
                                                <span class="checkmark"></span>
                                                <span style="margin-left: 12px;font-weight:500;font-size:15px;color:darkslategrey;display: inline-block;margin-top: -10px;cursor: pointer;" >Check All</span>
                                            </label>
				                            <button style="color: white" type="button" name="deleteChackedBox" class="btn btn-info deleteChackedBox" title="delete chacked box"><i class="fas fa-minus-circle"></i>&nbsp;Delete</button>
				                        </div>
				                    </form>
				                   <?php
				                }
				                else
				                {
				                	?>
				                    <div style="height: 300px">
				                        <i class="fas fa-exclamation-triangle" style="font-size:245px;position:absolute;margin-left:3%;opacity:0.2;"></i>
				                        <br><br>
				                        <div style="margin-left:3%;">
				                            <div style="font-size:18px;margin-top:4%;">You don't have any products in your shopping cart.</div>
				                            <div style="margin-top:2%;"><a href="p_drugs?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><input type="button" value="Click Here to Add product" id="add_product_cart" style="cursor:pointer;opacity:0.8;outline:none;"></a></div>
				                        </div>
				                    </div>
				                    <?php
				                }
								?>
							</div>
						</div>
					</div>
					
					<div class="displayOrderContaier"></div>
				</div>
			</article>
		</div>
	</div>
    <?php
    $select=mysqli_query($conn,"select * from pharmacist where id='$id'");
    $row=mysqli_fetch_array($select);
    $selects=mysqli_query($conn,"select * from cart where pharmacistId='$id'");
    $num_row=mysqli_num_rows($selects);
    ?>
	<div class="salesOverViewMainCont">
		<div class="salesOverViewSubCont prepareSaleCont">
			<div style="padding: 10px;border-bottom: 1px solid silver">
				<div style="float: right;cursor: pointer;" class="closeSalesCont">
					<i class="fas fa-times"></i>
				</div>
				<h6>Prepare Sales</h6>
			</div>
			<div class="displaySalesResult"></div>
			<div class="salesOverViewThirdCont">
				<form class="salesForm">
					<br>
					<div class="row">
						<div class="col-md-2">
							<label>Saller Name:</label>
						</div>
						<div class="col-md-10 formControlCont">
							<span style="position: absolute;margin:10px;color: gray"><i class="fas fa-user"></i></span>
							<input style="width: 60%;cursor: no-drop;" type="text" name="sellerName" id="sellerName" value="<?php echo $row['fname']." ".$row['mName']." ".$row['lname']; ?>" readonly="">
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-2">
							<label>Customer Name:</label>
						</div>
						<div class="col-md-10 formControlCont">
							<span style="position: absolute;margin:10px;color: gray"><i class="fas fa-user"></i></span>
							<input style="width: 60%;" type="text" name="clientName" id="clientName" placeholder="enter customer name" autocomplete="off"><br>
							<div class="error error1">*customer name required</div>
							<div class="error error2">*customer name can't be less than 5 character of length</div>
						</div>
					</div><br><br>
					<div>
                        <div style="float:right;color:darkslategray;margin-right:20px;">
                            <label>Total Items:&nbsp;&nbsp;<strong><?php echo $num_row; ?></strong></label>
                        </div>
						<h6>Products you want to sale</h6>
						<div style="padding: 20px;padding-top: 5px;">
							<table class="table" style="color: darkslategray">
								<thead>
                                    <th>S/n</th>
									<th>Item Name</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Total Price</th>
								</thead>
								<tbody>
									<?php
                                    $i=1;
									while($rows=mysqli_fetch_array($selects))
									{
										?>
										<tr>
                                            <td><?php echo $i; ?></td>
											<td><?php echo $rows['drug_name']; ?></td>
											<td><?php echo $rows['quantity']; ?></td>
											<td>Ths <?php echo number_format($rows['price']); ?></td>
											<td>Tsh <?php echo number_format($rows['total_price']); ?></td>
										</tr>
										<?php
                                        $i++;
									}
									?>
								</tbody>
							</table>
                            <hr>
							<div style="height: 20px;">
								<div style="float: right;margin-right: 80px;font-weight: bold">Total: &nbsp;<label>Tsh <?php echo number_format($totalAmnt); ?> /=</label></div>
							</div>
							<hr><br>
							<center>
								<div style="width:30%;">
		                        	<button type="button" style="outline: none;" class="salesProductBtn submit"><i class="fas fa-cart-arrow-down"></i>&nbsp;&nbsp;Sale Now</button>
		                        </div>
		                    </center>
						</div>
						<input type="text" name="pharmacistId" id="pharmacistId" value="<?php echo $id; ?>" style="display: none;">
						<input type="text" name="token" id="token" value="<?php echo $token; ?>" style="display: none;">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="confirmSnoozeCartCont"></div>
	<div class="displayRemoveItemFromCartRslt"></div>
    <div class="confirmDeleteContainer">
        <div class="deleteMainCont">
            <div style="padding: 10px;color: darkslategray;margin-bottom: 10px;border-bottom: 1px solid silver">
                <div>
                    <h6><i class="fas fa-check-circle"></i>&nbsp;&nbsp;Confirmation</h6>
                </div>
            </div>
            <div style="padding: 20px;">
                <div>Are you sure you want to remove selected items from the cart</div>
            </div>
            <div style="height: 65px;padding: 10px;">
                <div style="float: right;">
                    <button style="outline: none;" class="btn btn-info cancel noCancel"><i class="fas fa-times"></i>&nbsp; No</button>
                    <button style="outline: none;" class="btn btn-danger yesRemove"><i class="fas fa-check"></i>&nbsp; Yes</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
$selects=mysqli_query($conn,"select * from expiredcart where employeeId='$id'");
$rws=mysqli_fetch_array($selects);
?>
<script type="text/javascript">
	$(document).ready(function(){
		 //----------------------->>
	    $("#checksAll").change(function(){
	    	$(".checkItems").prop("checked",$(this).prop("checked"));
            var total=$(".checkItems:checked").length;
            if(total==0){
                $("#totalChacked").html("");
            }
            else if(total==1){
                $("#totalChacked").html(total+"&nbsp;&nbsp;Item Selected");
            }
            else{
                $("#totalChacked").html(total+"&nbsp;&nbsp;Items Selected");
            }
            $(".checkItems").closest('#tr_cart').toggleClass("highlight");
	    });
	   
	    $(".checkItems").change(function(){
            var total=$(".checkItems:checked").length;
            if(total==0){
                $("#totalChacked").html("");
            }
            else if(total==1){
                $("#totalChacked").html(total+"&nbsp;&nbsp;Item Selected");
                $
            }
            else{
                $("#totalChacked").html(total+"&nbsp;&nbsp;Items Selected");
            }
            //-------------------------------------->>
	    	if($(this).prop("checked")==false)
	    	{
	    		$("#checksAll").prop("checked",false);
	    	}
	    	if($(".checkItems:checked").length==$(".checkItems").length)
	    	{
	    		$("#checksAll").prop("checked", true);
                
	    	}
	    });
	    //------------------------>>
	    $(".closeSalesCont").click(function(){$(".salesOverViewMainCont").hide();});
	    //----------------------->>
	    $(".salesBtn").click(function(){
            $(".shopLoadingContainer").show();
            setTimeout(function(){
                $(".shopLoadingContainer").hide();
                $(".salesOverViewMainCont").show(800);
            },6000);
        });
        //-------------------------->>
        $(".search").on('click',function(){
            $("#searchCont").show();
            $("#mainCnt").hide();
            $(".snoozedCartMainCont").hide();
        });
        //-------------------------->>
        $(".closeSearch").on('click',function(){
            $("#searchCont").hide();
            $("#mainCnt").show();
        });
        //-------------------------->>
        $(".noCancel").click(function(){
            $(".confirmDeleteContainer").slideUp(500);
		});
	    //-------------------------->>
	    $(".delete_button_cart").click(function(){
	    	var itemId=$(this).attr("id");
	    	var drugId=$(this).val();
	    	$.ajax({
	    		url:"ajax/cart/query.php",
	    		method:"post",
	    		async:false,
	    		data:{
	    			"itemId":itemId,
	    			"drugId":drugId
	    		},
	    		success:function(data)
	    		{
	    			$(".displayRemoveItemFromCartRslt").html(data);
	    		}
	    	});
	    });
	    //----------------------------->>
	    //----------------------------->>
	    $(".submit").click(function(){
	    	$.ajax({
	    		url:"ajax/ajaxSaleItems.php",
	    		method:"post",
	    		async:false,
	    		data:$(".salesForm").serialize(),
	    		success:function(data)
	    		{
	    			$(".displaySalesResult").html(data);
	    		}
	    	});
	    });
        //----------------------------------------------->>
        $(".deleteChackedBox").click(function(){
            var id=[];
            $('.checkItems:checked').each(function(i){
            id[i] = $(this).val();
            });
            if(id.length === 0){
                $("#deleteError").html("*please select atlest one checkbox");
            }
            else{
                $("#deleteError").html("");
                $(".confirmDeleteContainer").show();
            }
        });
        $(".yesRemove").click(function(){
            var id=[];
            var employeeId=$("#pharmacistId").val();
            $('.checkItems:checked').each(function(i){
                id[i] = $(this).val();
            });
            $.ajax({
                url:"ajax/cart/query.php",
                method:"post",
                async:false,
                data:{checkId:id,emplyId:employeeId},
                success:function()
                {
                    updateCartContainer();
                    $(".confirmDeleteContainer").hide();
                }
            });
        });
        //----------------------------------------->>
        $(".searchTxtBox").keyup(function(){
            var txtBoxValue=$("#searchTxtBox").val();
            var employeeId=$("#pharmacistId").val();
            var token=$("#token").val();
            $(".loadData").show();
            $.ajax({
                url:"ajax/ajaxQueryEmployee.php",
                type:"post",
                async:false,
                data:{txtBoxValue:txtBoxValue,empId:employeeId,token:token},
                success:function(data)
                {
                    setTimeout(function(){
                        $(".loadData").hide();
                        $(".cartCont").html(data);
                    },2000);
                }
            });
        });
	});
    $(function() {
      $('#td:first-child .checkItems').change(function() {
        $(this).closest('#tr_cart').toggleClass("highlight", this.checked);
      });
    });
    $(window).scroll(function() {
        if($(this).scrollTop()>100)
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
    //------------------------------->>
    setInterval(function(){
        var employeeId=$("#pharmacistId").val();
        $.ajax({
            url:"ajax/load/expiredCart.php",
            method:"post",
            data:{employeeId:employeeId},
            success:function(data){
                $(".expiredCart").html(data);
            }
        });
    },1000);
    //------------------------------->>
    function updateCartContainer(){
        var pharmacistId=$("#pharmacistId").val();
        var token=$("#token").val();
        $.ajax({
            url:"ajax/updateTable/ajaxUpdateCart.php",
            method:"post",
            async:false,
            data:{pharmacistId:pharmacistId,token:token},
            success:function(data)
            {
                $("#cartContainer").html(data);
            }
        });
    }
    //------------------------------->>
    function makeTimer() { 
        var endTime = new Date("<?php echo $rws['expiredTime']; ?>");      
          endTime = (Date.parse(endTime) / 1000);

          var nowTime = new Date();
          nowTime = (Date.parse(nowTime) / 1000);

          var timeLeft = endTime - nowTime;

          var days = Math.floor(timeLeft / 86400); 
          var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
          var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
          var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
      
          if (minutes < "10") { minutes = "0" + minutes; }
          if (seconds < "10") { seconds = "0" + seconds; }
          $("#minutes").html("<b>" + minutes + "</b><span> Minutes</span>&nbsp; and ");
          $("#seconds").html("<b>" + seconds + "</b><span> Seconds</span>");  
          if(minutes<=0 && seconds<=0)
          {
            window.location.reload();
          } 

      }

      setInterval(function() { makeTimer(); }, 1000);
    //--------------------------------->>
	function closeErrorContainer()
    {
        var a=document.getElementById('errorContainer');
        if(a.style.display==="none"){
            a.style.display="block";
        }
        else{
            a.style.display="none";
        }
    }
    //-------------------------->>
</script>