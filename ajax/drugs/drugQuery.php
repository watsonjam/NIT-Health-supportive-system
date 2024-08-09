<style type="text/css">
	.editDrugMainCont{position: fixed;top: 0px;left: 0px;float: none;background-color: rgba(0,0,0,.6);width: 100%;height: 100%;z-index: 14;}
	.editSubCont{width: 45%;margin-left: 30%;margin-top: 2%;background-color: white;border-radius: 3px;box-shadow: 0px 20px 10px rgba(0,0,0,.4);animation: 1s editCont;position: relative;}
	@keyframes editCont{from{top: -300px;opacity: 0}to{top: 0px;opacity: 1}}
	.deleteMainCont{width: 35%;margin-left:35%;margin-top: 10%;background-color: white;border-radius: 3px;box-shadow: 0px 20px 10px rgba(0,0,0,.4);animation: 1s deleteCont;position: relative;}
	@keyframes deleteCont{from{top: -300px;opacity: 0}to{top: 0px;opacity: 1}}
	.yeBtn{background-color: #E74C3C;border:1px solid #E74C3C;color: white;cursor: pointer;line-height: 30px;border-radius: 3px;padding:5px;padding-top:0px;padding-bottom:0px;}
    .closeCont{background-color: #2980B9;border:1px solid #2980B9;color: white;cursor: pointer;line-height: 30px;border-radius: 3px;padding:5px;padding-top:0px;padding-bottom:0px;}
</style>
<?php
include("db_connection/db_connection.php");

if(isset($_POST['drugId']))
{
	$drugId=$_POST['drugId'];
	$select=mysqli_query($conn,"select * from drugs where id='$drugId'");
	$row=mysqli_fetch_array($select);
	?>
	<div class="editDrugMainCont">
		<div class="editSubCont">
			<form class="editDrugForm">
				<div style="padding: 10px;color: darkslategray;margin-bottom: 10px;border-bottom: 1px solid silver">
					<div style="float: right;cursor: pointer;" class="closeEditContainer">
						<i class="fas fa-times"></i>
					</div>
					<div>
						<h6><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit Drug</h6>
					</div>
				</div>
				<div class="displayAddDrugResult" style="margin: 5px;margin-top: 10px;"></div>
				<div style="padding: 20px;">
					 <div>
                        <div>Drug Name:</div>
                        <div class="formControlCont">
                            <div class="inputIcon"><i class="fas fa-pills"></i></div>
                             <input type="text" name="drugName" placeholder="enter drug name" autocomplete="off" id="drugName" value="<?php echo $row['drug_name']; ?>">
                        </div>
                        <span class="loginError drugName">*drug name required</span>
                    </div><br>
                    <div>
                        <div>Manufacture Date:</div>
                        <div class="formControlCont">
                            <div class="inputIcon"><i class="fas fa-clock"></i></div>
                              <input type="date" name="manDate" id="manDate" value="<?php echo $row['manufacture_date']; ?>">				      
                        </div>
                        <span class="loginError manDate">*manufacture date required</span>
                    </div><br>
                    <div>
                        <div>Expire Date:</div>
                        <div class="formControlCont">
                            <div class="inputIcon"><i class="fas fa-clock"></i></div>
                              <input type="date" name="expireDate" id="expireDate" value="<?php echo $row['expire_date']; ?>">			
                        </div>
                        <span class="loginError expireDate">*expire date required</span>
                    </div><br>
                    <div class="row">
	                    <div class="col-md-6">
	                        <div>Quantity:</div>
	                        <div class="formControlCont">
	                            <div class="inputIcon"><i class="fas fa-clipboard-list"></i></div>
	                              <input type="number" name="quantity" placeholder="enter quantity" id="quantity" autocomplete="off" value="<?php echo $row['quantity']; ?>">	
	                        </div>
	                        <span class="loginError quantity">*quantity required</span>
	                    </div>
	                    <div class="col-md-6">
	                    	<div>Measurement:</div>
	                    	<div class="formControlCont2">
	                    		<div class="inputIcon"><i class="fas fa-clipboard-list"></i></div>
	                              <select name="type" placeholder="select type" id="type" class="form-control">
	                              	<option><?php echo $row['quantity_type']; ?></option>
	                              	<option>Pices</option>
	                              	<option>Boxes</option>
	                              </select>	
	                        </div>
	                        <span class="loginError type">*select Measurement</span>
	                    </div>
                    </div><br>
                     <div class="row">
	                    <div class="col-md-6">
	                        <div>Buying Price:</div>
	                        <div class="formControlCont">
	                            <div class="inputIcon"><i class="fas fa-dollar-sign"></i></div>
	                              <input type="number" name="buyingPrice" placeholder="enter buying price" id="buyingPrice" autocomplete="off" onkeyup="displayProfit()" value="<?php echo $row['buyingPrice']; ?>">	
	                        </div>
	                        <span class="loginError buyingPrice">*Buying price required</span>
	                    </div>
	                    <div class="col-md-6">
	                    	<div>Sale Price:</div>
	                        <div class="formControlCont">
	                            <div class="inputIcon"><i class="fas fa-dollar-sign"></i></div>
	                              <input type="number" name="price" placeholder="enter sale price" id="price" class="salePrice" autocomplete="off" onkeyup="displayProfit()" value="<?php echo $row['price']; ?>">	
	                        </div>
	                        <span class="loginError price">*Salling price required</span>
	                    </div>
                    </div><br>
                    <div>
                    	<div>Profit:</div>
                        <div class="formControlCont">
                            <div class="inputIcon"><i class="fas fa-dollar-sign"></i></div>
                              <input style="background-color: lavender" type="number" name="profit" placeholder="profit"value="<?php echo $row['profit']; ?>" id="profit" class="proft" readonly />	
                        </div>
                    </div><br>
                    <input type="text" name="drugId" id="drugId" value="<?php echo $drugId; ?>" style="display: none;">
                    <div style="height: 40px;">
                    	<div style="float: right;width: 30%;">
                    		<button style="outline: none;" type="button" name="editDrugBtn" id="editDrugBtn" class="signInBtn"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit Drug</button>
                    	</div>
                    </div>
				</div>
			</form>
		</div>
	<?php
}
//------------------------------------------------->>
if(isset($_POST['drugId2']))
{
	$drugId2=$_POST['drugId2'];
	?>
	<div class="editDrugMainCont" id="deleteDrugCont">
		<div class="deleteMainCont">
			<div style="padding: 10px;color: darkslategray;margin-bottom: 10px;border-bottom: 1px solid silver">
				<div>
					<h6><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Delete Confirmation</h6>
				</div>
			</div>
			<div style="padding: 20px;">
				<div><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Are you sure you want to delete this drug</div>
			</div>
			<div style="height: 65px;padding: 10px;">
                <div style="float: right;">
                	<button style="outline: none;" class="closeCont"><i class="fas fa-times"></i>&nbsp; No</button>
                	<button style="outline: none;" class="yeBtn"><i class="fas fa-check"></i>&nbsp; Yes</button>
                </div>
			</div>
		</div>
		<input type="text" name="drgId" id="drgId" value="<?php echo $drugId2; ?>" style="display: none;">
	</div>
	<?php
}
//------------------------------------------------------->>
if(isset($_POST['equipmentId2']))
{
	$equipmentId2=$_POST['equipmentId2'];
	?>
	<div class="editDrugMainCont">
		<div class="deleteMainCont">
			<div style="padding: 10px;color: darkslategray;margin-bottom: 10px;border-bottom: 1px solid silver">
				<div>
					<h6><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Delete Confirmation</h6>
				</div>
			</div>
			<div style="padding: 20px;">
				<div>Are you sure you want to delete this equipment</div>
			</div>
			<div style="height: 65px;padding: 10px;">
                <div style="float: right;">
                	<button style="outline: none;" class="closeCont"><i class="fas fa-times"></i>&nbsp; No</button>
                	<button style="outline: none;" class="yeBtn yesBtn2"><i class="fas fa-check"></i>&nbsp; Yes</button>
                </div>
			</div>
		</div>
		<input type="text" name="equId" id="equId" value="<?php echo $equipmentId2; ?>" style="display: none;">
	</div>
	<?php
}
//----------------------------->>
if(isset($_POST['drgId']))
{
	$drgId=$_POST['drgId'];

	$delete=mysqli_query($conn,"delete from drugs where id='$drgId'");
}
//----------------------------->>
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".closeEditContainer").click(function(){
			$(".editDrugMainCont").hide();
		});
		//------------------------->>
		$(".closeCont").click(function(){
			$(".editDrugMainCont").hide();
		});
		//-------------------------->>
		$("#editDrugBtn").click(function(){
			$.ajax({
				url:"ajax/ajaxEditDrug.php",
				method:"post",
				async:false,
				data:$(".editDrugForm").serialize(),
				success:function(data)
				{
					$(".displayAddDrugResult").html(data);
					showUpdateDrugs();
				}
			});
		});
		function showUpdateDrugs()
		{
			$.ajax({
				url:"ajax/updateTable/ajaxUpdateDrugsTable.php",
				method:"post",
				success:function(data)
				{
					$(".drugs").html(data);
				}
			});
		}
		//--------------------------------->>
		$(".yeBtn").click(function(){
			var drgId=$("#drgId").val();
			$.ajax({
				url:"ajax/drugs/drugQuery.php",
				method:"post",
				async:false,
				data:{"drgId":drgId},
				success:function()
				{
					showDeleteDrugs();
					$("#deleteDrugCont").hide();
				}
			});
		});
		function showDeleteDrugs()
		{
			$.ajax({
				url:"ajax/updateTable/ajaxUpdateDrugsTable.php",
				method:"post",
				success:function(data)
				{
					$(".drugs").html(data);
				}
			});
		}
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