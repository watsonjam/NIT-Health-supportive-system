<style type="text/css">
	.editDrugMainCont{position: fixed;top: 0px;left: 0px;float: none;background-color: rgba(0,0,0,.6);width: 100%;height: 100%;z-index: 14;}
	.editSubCont{width: 45%;margin-left: 30%;margin-top: 2%;background-color: white;border-radius: 3px;box-shadow: 0px 20px 10px rgba(0,0,0,.4);animation: 1s editCont;position: relative;}
	@keyframes editCont{from{top: -300px;opacity: 0}to{top: 0px;opacity: 1}}
	.deleteMainCont{width: 35%;margin-left:35%;margin-top: 10%;background-color: white;border-radius: 3px;box-shadow: 0px 20px 10px rgba(0,0,0,.4);animation: 1s deleteCont;position: relative;}
	@keyframes deleteCont{from{top: -300px;opacity: 0}to{top: 0px;opacity: 1}}
    .yesBtn2,
    .yesRemove,
	.yeBtn{background-color: #E74C3C;border:1px solid #E74C3C;color: white;cursor: pointer;line-height: 30px;border-radius: 3px;padding:5px;padding-top:0px;padding-bottom:0px;}
    .cancel,
    .closeCont{background-color: #2980B9;border:1px solid #2980B9;color: white;cursor: pointer;line-height: 30px;border-radius: 3px;padding:5px;padding-top:0px;padding-bottom:0px;}
    .highlight{background: #ABEBC6;}
</style>
<?php
include("db_connection/db_connection.php");
//-------------------------------->>
if(isset($_POST['itemId']))
{
    $itemId=$_POST['itemId'];
    $drugId=$_POST['drugId'];
    $select=mysqli_query($conn,"select * from cart where id='$itemId'");
    $row=mysqli_fetch_array($select);
    ?>
	<div class="editDrugMainCont" id="deleteItemFromCart">
		<div class="deleteMainCont">
			<div style="padding: 10px;color: darkslategray;margin-bottom: 10px;border-bottom: 1px solid silver">
				<div>
					<h6><i class="fas fa-check-circle"></i>&nbsp;&nbsp;Confirmation</h6>
				</div>
			</div>
			<div style="padding: 20px;">
				<div>Are you sure you want to remove this item from the cart</div>
                <br>
                <label>Item Name:&nbsp;&nbsp;<strong><?php echo $row['drug_name']; ?></strong></label>
			</div>
			<div style="height: 65px;padding: 10px;">
                <div style="float: right;">
                	<button style="outline: none;" class="cancel"><i class="fas fa-times"></i>&nbsp; No</button>
                	<button style="outline: none;" class="yesBtn2"><i class="fas fa-check"></i>&nbsp; Yes</button>
                </div>
			</div>
		</div>
		<input type="text" name="prodId" id="prodId" value="<?php echo $itemId; ?>" style="display: none;">
		<input type="text" name="drgId" id="drgId" value="<?php echo $drugId; ?>" style="display: none;">
	</div>
	<?php
}
//-------------------------------->>
if(isset($_POST['prodId']))
{
    $prodId=$_POST['prodId'];
    $drugId=$_POST['drgId'];

    $delete=mysqli_query($conn,"delete from cart where id='$prodId'");
    //------------------------------------->>
    mysqli_query($conn,"update drugs set updated_quantity='0' where id = '$drugId'");
    ?>
    <script>
        $("#deleteItemFromCart").hide();
    </script>
    <?php
}
//--------------------------------------->>
if(isset($_POST['checkId']))
{
    foreach($_POST['checkId'] as $checkId)
    {
        $emplyId=$_POST['emplyId'];
        mysqli_query($conn,"delete from cart where pharmacistId='".$emplyId."' and id='".$checkId."'");
        mysqli_query($conn,"update drugs set updated_quantity='0' where id = '".$checkId."'");
        ?>
        <script type="text/javascript">
            window.location.reload();
        </script>
        <?php
    }
    //--------------------------------------->>
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		//-------------------------->>
        $(".cancel").click(function(){
            $("#deleteItemFromCart").hide();
		});
		//--------------------------------->>
    $(".yesBtn2").click(function(){
        var prodId=$("#prodId").val();
        var drgId=$("#drgId").val();
        $.ajax({
            url:"ajax/cart/query.php",
            method:"post",
            async:false,
            data:{
                "prodId":prodId,
                "drgId":drgId
            },
            success:function()
            {
                $("#deleteItemFromCart").hide();
                window.location.reload();
            }
        });
    });
	});
</script>