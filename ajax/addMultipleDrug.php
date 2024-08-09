<style type="text/css">
	.sucessCont{position: absolute;top: 15%;margin-left: 40%;width: 30%;background-color: white;padding:1px;color: darkslategrey;border-radius: 4px;border: 1px solid silver;box-shadow: 0px 0px 30px 0px rgba(0,0,0,.5);z-index: 20;}
    .hoverCont2{position: absolute;top: 0px;left: 0px;background-color: rgba(0,0,0,.5);width: 100%;height: 100%;z-index: 20;}
    .sucessCont2{position: relative;top: 3%;width: 30%;background-color: white;padding:1px;color: darkslategrey;border-radius: 4px;border: 1px solid silver;box-shadow: 0px 0px 30px 0px rgba(0,0,0,.5);z-index: 20;}
    #notfy{display: none}
    #viewCart{background-color: #58D68D;padding: 20px;display:block;}
    #load{position:absolute;right:135px;margin-top:-2px;display:none}
</style>
<?php
include("db_connection/db_connection.php");

if(isset($_POST['checkedId']))
{
	$employeeId=$_POST['employeeId'];
    $token=$_POST['token'];
    foreach($_POST['checkedId'] as $productId)
    {
	    //--------------------------------->>
	    

		$select2=mysqli_query($conn,"select id from cart order by id desc");
		$row2=mysqli_fetch_array($select2);

		$id=$row2[0]+1;
		//---------------------------------->>
	    $selects=mysqli_query($conn,"select id from cart order by id desc");
		$rows2=mysqli_fetch_array($selects);

		$ids=$rows2[0]+1;
		//---------------------------------->>
		$select3=mysqli_query($conn,"select * from cart where pharmacistId='".$employeeId."' and drugId='".$productId."'");
		$row3=mysqli_fetch_array($select3);
		if($employeeId==$row3['employeeId'] and $productId==$row3['drugId'])
		{
			$selects3=mysqli_query($conn,"select * from cart where pharmacistId='".$employeeId."'");
			?>
			<div class="hoverCont">
				<div class="sucessCont">
					<div style="padding: 7px;">
						<div style="float: right;cursor: pointer;" class="closeCont"><i class="fas fa-times"></i></div>
						<h6>Error Occur</h6>
					</div>
					<div style="background-color: #D98880;padding: 30px;">
						<span><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;you have already add this drugs to cart</span>
						<br>
						<br>
						<?php
						while($fetchRow=mysqli_fetch_array($selects3)){
							?>
							<div>Product Id: &nbsp;<?php echo $fetchRow['drugId']; ?></div>
							<div>Product Name: &nbsp;<?php echo $fetchRow['drug_name']; ?></div><hr>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
		else
		{
			$select=mysqli_query($conn,"select * from drugs where id='".$productId."'");
		    while($row=mysqli_fetch_array($select))
		    {
				$drug_name=mysqli_real_escape_string($conn,$row['drug_name']);
				$price=$row['price'];
				$profit=$row['profit'];
				$total_profit=$row['profit'];
				$total_price=$row['price'];
				$quantity=1;
				$date=date("d-M-Y");
				$time=date("h:i a");
			    $expiredTime=$newTime = date("Y-m-d h:i:s A",strtotime(date("Y-m-d h:i:s A")." +30 minutes"));
				$insert_data=("insert into cart(id,drugId,pharmacistId,drug_name,price,profit,total_profit,total_price,quantity,date_added_to_cart,time_added_to_cart) values('$id','$productId','$employeeId','$drug_name','$price','$profit','$total_profit','$total_price','$quantity','$date','$time')");
				$result=mysqli_query($conn,$insert_data);
				if($result)
				{
		            
		            $checkData=mysqli_query($conn,"select * from expiredcart where employeeId='".$employeeId."'");
		            $rwData=mysqli_fetch_array($checkData);
		            if(empty($rwData['expiredTime']))
		            {
		                mysqli_query($conn,"insert into expiredcart(id,employeeId,expiredTime) values('$ids','$employeeId','$expiredTime')");
		            }
		            else{
		                mysqli_query($conn,"update expiredcart set expiredTime='$expiredTime' where employeeId='$employeeId'");
		            }
		            //------------------->>
		            $select=mysqli_query($conn,"select * from drugs where id='".$productId."'");
			        $row=mysqli_fetch_array($select);
					if($row['updated_quantity']==0)
					{
						$update=mysqli_query($conn,"update drugs set updated_quantity=quantity-1 where id='".$productId."'");
					}
					else
					{
						$update=mysqli_query($conn,"update drugs set updated_quantity=updated_quantity-1 where id='".$productId."'");
					}
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
			?>
			<div class="hoverCont2">
				<div class="sucessCont" style="top:25%;">
                    <div id="viewCart">
                        <center><label style="font-weight:500">Successfully Add Products to Cart</label><hr>
                        	<?php
							$selectData=mysqli_query($conn,"select * from cart where pharmacistId='".$employeeId."'");
							while($result_fetchData=mysqli_fetch_array($selectData))
							{	
								?>
	                            <div style="font-size:14px;text-align:left">Product Name: &nbsp;<strong><?php echo $result_fetchData['drug_name']; ?></strong></div>
	                            <div style="font-size:14px;text-align:left" id="qnty"></div>
	                            <?php
	                        }
                            ?>
                           <br>
                            <div>
                                <a href="p_drugs?id=<?php echo $employeeId; ?>&token=<?php echo $token; ?>"><button class="btn btn-danger" id="cancel">Close</button></a>
                                <a href="cart.php?id=<?php echo $employeeId; ?>&token=<?php echo $token; ?>"><button class="btn btn-info">View Cart</button></a>
                            </div>
                        </center>
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
                }
            });
        });
	});
</script>