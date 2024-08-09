<?php
include("db_connection/db_connection.php");

$id=$_POST['pharmacistId'];
$token=$_POST['token'];

?>
<div id="cartContainer">
    <?php
    $selectProduct=mysqli_query($conn,"select * from cart where pharmacistId='$id'");
    $num_rows=mysqli_num_rows($selectProduct);
    ?>
    <div style="padding: 10px ;background:linear-gradient(silver,white);border-bottom: 1px solid silver">
        <div style="float: right;">
            <?php
            if($num_rows==0)
            {
                echo"";
            }
            else
            {
                ?>
                <button class="btn btn-success snooze"><i class="fas fa-shopping-cart"></i>&nbsp;&nbsp;Snooze Cart</button>
                &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                <?php
            }
            ?>
            <label>Total Items In Cart : &nbsp;<?php echo $num_rows; ?></label>
        </div>
        <h6 style="color: darkslategray"><i class="fab fa-product-hunt"></i>&nbsp;&nbsp;Drugs / Equipmets in Cart</h6>
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
                        $select=mysqli_query($conn,"select * from cart where employeeId='$id'");
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
                $select=mysqli_query($conn,"select * from cart where employeeId='$id'");
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
                        <a href="drug_and_equipments?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><button style="margin-right:20px;" type="button" style="outline: none;" id="salesProductBtn" class="btn btn-success" title="continue shop drugs or equipments"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Continue Shop&nbsp;&nbsp;<i class="fas fa-cart-plus"></i></button></a>
                        <button style="outline:none" type="button" style="outline: none;" id="salesProductBtn" class="btn btn-primary salesProductBtn salesBtn" title="sale items">Checkout&nbsp;&nbsp;<i class="fas fa-arrow-right"></i></button>
                    </div>
                    <div style="padding-bottom:10px;color:red;font-size:14px;letter-spacing:0.5px;" id="deleteError"></div>
                    <img src="images/icons/arrow.png" style="float: left;">&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="checkContainer">
                        <input type="checkbox" id="checksAll" style="cursor: pointer;" >
                        <span class="checkmark"></span>
                    </label>
                    <span style="margin-left: 10px;font-weight:500;font-size:15px;color:darkslategrey;" >Check All</span>
                    <button type="button" name="deleteChackedBox" class="deleteChackedBox" title="delete chacked box"><i class="fas fa-minus-circle"></i>&nbsp;Delete</button>
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
                    <div style="margin-top:2%;"><a href="drug_and_equipments?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><input type="button" value="Click Here to Add product" id="add_product_cart" style="cursor:pointer;opacity:0.8;outline:none;"></a></div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div class="confirmSnoozeCartCont2"></div>
<div class="displayRemoveItemFromCartRslt"></div>
<div class="confirmDeleteContainer">
    <div class="deleteMainCont">
        <div style="padding: 10px;color: darkslategray;margin-bottom: 10px;border-bottom: 1px solid silver">
            <div>
                <h6><i class="fas fa-check-circle"></i>&nbsp;&nbsp;Confirmation</h6>
            </div>
        </div>
        <div style="padding: 20px;">
            <div>Are you sure you want to remove this items from the cart</div>
        </div>
        <div style="height: 65px;padding: 10px;">
            <div style="float: right;">
                <button style="outline: none;" class="cancel noCancel"><i class="fas fa-times"></i>&nbsp; No</button>
                <button style="outline: none;" class="yesRemove"><i class="fas fa-check"></i>&nbsp; Yes</button>
            </div>
        </div>
    </div>
</div>
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
	    $(".salesBtn").click(function(){$(".salesOverViewMainCont").show();});
        //-------------------------->>
        $(".noCancel").click(function(){
            $(".confirmDeleteContainer").hide();
		});
	    //-------------------------->>
	    $(".delete_button_cart").click(function(){
	    	var itemId=$(this).attr("id");
	    	var drugId=$(this).val();
	    	$.ajax({
	    		url:"ajax/ajaxQueryEmployee.php",
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
	    //--------------------------->>
	    $(".snooze").click(function(){
	    	var employeeId=$("#employeeId").val();
	    	var token=$("#token").val();
	    	$.ajax({
	    		url:"ajax/ajaxQueryEmployee.php",
	    		method:"post",
	    		async:false,
	    		data:{emplId:employeeId,token:token},
	    		success:function(data)
	    		{
	    			$(".confirmSnoozeCartCont").html(data);
	    		}
	    	});
	    });
	    //--------------------------->>
	    $(".snoozed").click(function(){
	    	if($(".snoozedCartMainCont").css("display")=="block")
	    	{
	    		$(".snoozedCartMainCont").slideUp('slow');
	    	}
	    	else{
	    		$(".snoozedCartMainCont").slideDown('slow');
	    	}
	    	var employeeId=$("#employeeId").val();
	    	$.ajax({
	    		url:"ajax/ajaxViewSnoozedCart.php",
	    		type:"post",
	    		async:false,
	    		data:{employeeId:employeeId},
	    		success:function(data)
	    		{
	    			$(".displaySnoozeCartCont").html(data);
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
            $('.checkItems:checked').each(function(i){
            id[i] = $(this).val();
            });
            $.ajax({
                url:"ajax/ajaxQueryEmployee.php",
                method:"post",
                async:false,
                data:{checkId:id},
                success:function()
                {
                    updateCartContainer();
                    $(".confirmDeleteContainer").hide();
                }
            });
        });
        function updateCartContainer(){
            var employeeId=$("#employeeId").val();
            var token=$("#token").val();
            $.ajax({
                url:"ajax/updateTable/ajaxUpdateCart.php",
                method:"post",
                async:false,
                data:{employeeId:employeeId,token:token},
                success:function(data)
                {
                    $("#cartContainer").html(data);
                }
            });
        }
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
</script>