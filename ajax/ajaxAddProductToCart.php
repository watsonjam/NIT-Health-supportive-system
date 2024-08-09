<style type="text/css">
	.sucessCont{position: fixed;top: 15%;margin-left: 40%;width: 30%;background-color: white;padding:1px;color: darkslategrey;border-radius: 4px;border: 1px solid silver;box-shadow: 0px 0px 30px 0px rgba(0,0,0,.5);z-index: 20;}
    .hoverCont2{position: fixed;top: 0px;left: 0px;background-color: rgba(0,0,0,.5);width: 100%;height: 100%;z-index: 20;}
    #notfy{display: none}
    #viewCart{background-color: #58D68D;padding: 20px;display:none}
    #load{position:absolute;right:45px;margin-top:2px;display:none}
    #updateCont{background-color: lavender;padding: 30px;}
</style>
<?php
include("db_connection/db_connection.php");

if(isset($_POST['drugId']))
{
	$productId=$_POST['drugId'];
	$employeeId=$_POST['employeeId'];
    $token=$_POST['token'];
    //--------------------------------->>
    $select=mysqli_query($conn,"select * from drugs where id='$productId'");
    $row=mysqli_fetch_array($select);
	$drug_name=mysqli_real_escape_string($conn,$row['drug_name']);
	$price=$row['price'];
	$profit=$row['profit'];
	$total_profit=$row['profit'];
	$total_price=$row['price'];
	$quantity=1;
	$date=date("d-M-Y");
	$time=date("h:i a");
    $expiredTime=$newTime = date("Y-m-d h:i:s A",strtotime(date("Y-m-d h:i:s A")." +30 minutes"));;

	$select2=mysqli_query($conn,"select id from cart order by id desc");
	$row2=mysqli_fetch_array($select2);

	$id=$row2[0]+1;
	//---------------------------------->>
    $selects=mysqli_query($conn,"select id from cart order by id desc");
	$rows2=mysqli_fetch_array($selects);

	$ids=$rows2[0]+1;
	//---------------------------------->>
	$select3=mysqli_query($conn,"select * from cart where pharmacistId='$employeeId' and drugId='$productId'");
	$row3=mysqli_fetch_array($select3);
	if($employeeId==$row3['pharmacistId'] and $productId==$row3['drugId'])
	{
		?>
		<div class="hoverCont">
			<div class="sucessCont">
				<div style="padding: 7px;">
					<div style="float: right;cursor: pointer;" class="closeCont"><i class="fas fa-times"></i></div>
					<h6>Error Occur</h6>
				</div>
				<div style="background-color: #D98880;padding: 30px;">
					<span><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;you have already add this drug to cart</span>
					<br>
					<br>
					<div>Product Id: &nbsp;<?php echo $productId; ?></div>
					<br>
					<div>Product Name: &nbsp;<?php echo $drug_name; ?></div>
				</div>
			</div>
		</div>
		<?php
	}
	else
	{
		$insert_data=("insert into cart(id,drugId,pharmacistId,drug_name,price,profit,total_profit,total_price,quantity,date_added_to_cart,time_added_to_cart) values('$id','$productId','$employeeId','$drug_name','$price','$profit','$total_profit','$total_price','$quantity','$date','$time')");
		$result=mysqli_query($conn,$insert_data);
		if($result)
		{
            
            $checkData=mysqli_query($conn,"select * from expiredcart where employeeId='$employeeId'");
            $rwData=mysqli_fetch_array($checkData);
            if(empty($rwData['expiredTime']))
            {
                mysqli_query($conn,"insert into expiredcart(id,employeeId,expiredTime) values('$ids','$employeeId','$expiredTime')");
            }
            else{
                mysqli_query($conn,"update expiredcart set expiredTime='$expiredTime' where employeeId='$employeeId'");
            }
            //------------------->>
            $select=mysqli_query($conn,"select * from drugs where id='$productId'");
	        $row=mysqli_fetch_array($select);
			if($row['updated_quantity']==0)
			{
				$update=mysqli_query($conn,"update drugs set updated_quantity=quantity-1 where id='$productId'");
			}
			else
			{
				$update=mysqli_query($conn,"update drugs set updated_quantity=updated_quantity-1 where id='$productId'");
			}
			?>
            <style>
                .quantity{width: 100%;outline:none;padding: 12px;height: 37px;}
            </style>
			<div class="hoverCont hoverCont2">
				<div class="sucessCont" style="top:25%;">
                    <div class="showResultContainer"></div>
					<div style="padding: 15px;border-bottom: 2px solid silver">
                        <h6>Update Quantity</h6>
					</div>
					<div id="updateCont">
                        <div id="prodName" style="font-size:14px;">Product Name: &nbsp;<strong><?php echo $drug_name; ?></strong></div>
                        <br>
                        <div id="notfy" style="font-size:13px;margin-bottom:5px;font-weight:500">Updating Quantity ...........</div>
                        <div id="load"><img src="images/icons/progress_2.svg" height="35"></div>
                        <input type="text" value="1" class="quantity" name="quantity" id="quantity" autocomplete="off" >
                        <input type="text" name="itemId" id="itemId" value="<?php echo $productId; ?>" style="display:none;">
                        <input type="text" name="employeeId" id="employeeId" value="<?php echo $employeeId; ?>" style="display:none;">
                        <input type="text" name="token" id="token" value="<?php echo $token; ?>" style="display:none;">
                        <div style="margin-top: 20px;">
                        	<center>
                        		<button class="btn btn-danger cancelAddProductBtn" type="button">Cancel</button>
                        		<button class=" btn btn-success updateQuantityBtn" type="button">Update</button>
                        	</center>
                        </div>
                        <div>
                            <label style="color:red;font-size:14px;" class="error"></label>
                        </div>
					</div>
                    <div id="viewCart">
                        <center><label style="font-weight:500">Successfully Update Quantity</label><hr>
                            <div style="font-size:14px;text-align:left">Product Name: &nbsp;<strong><?php echo $drug_name; ?></strong></div>
                            <div style="font-size:14px;text-align:left" id="qnty"></div>
                           <br>
                            <div>
                                <button class="btn btn-danger" id="cancel">Close</button>
                                <a href="cart.php?id=<?php echo $employeeId; ?>&token=<?php echo $token; ?>"><button class="btn btn-info">View Cart</button></a>
                            </div>
                        </center>
					</div>
				</div>
			</div>
			<?php
        }
		else
		{
			?>
			<div class="hoverCont">
				<div class="sucessCont">
					<div style="padding: 15px;">
						<div style="float: right;cursor: pointer;margin-top: -10px;" class="closeCont"><i class="fas fa-times"></i></div>
					</div>
					<div style="background-color: #D98880;padding: 30px;">
						<span><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;Error Occur ! there problem on the server</span>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.closeCont').click(function(){
			$('.hoverCont').hide();
		});
        //------------------------------>>
        $("#cancel").click(function(){
            $('.hoverCont2').hide();
        });
        //------------------------------>>
        $(".updateQuantityBtn").on('click',function(){
            var employeeId=$("#employeeId").val();
            var itemId=$("#itemId").val();
            var quantity=$("#quantity").val();
            $.ajax({
                method:"post",
                url:"ajax/ajaxUpdateQuantity.php",
                async:false,
                data:{employeeId:employeeId,itemId:itemId,quantity:quantity},
                success:function(data)
                {
                    $(".showResultContainer").html(data);
                    $(".updateCont").css("background-color","#58D68D");
                }
            });
        });
        //------------------------->>
        $(".cancelAddProductBtn").click(function(){
            var itemId=$("#itemId").val();
            $.ajax({
                method:"post",
                url:"ajax/ajaxUpdateQuantity.php",
                async:false,
                data:{itmId:itemId},
                success:function(data)
                {
                    $(".hoverCont2").hide();
                }
            });
        });
	});
</script>














