<style type="text/css">
	.hoverContainer{position: fixed;width: 100%;top: 0px;left: 0px;float: none;margin: 0px;height: 100%;background-color: rgba(0,0,0,.4);z-index: 11;}
	.blockAccountCont{width: 35%;background-color: white;box-sizing: content-box;border:1px solid silver;box-shadow: 0px 30px 15px rgba(0,0,0,.4);border-radius: 4px;margin-top: 10%;position: relative;animation: 1s blockAccount;}
	@keyframes blockAccount{from{top:-200px;opacity: 0}to{top: 0px;opacity: 1}}
</style>
<?php
//including database connection
include("db_connection/db_connection.php");
//----------------->>
//---------------------->>
if(isset($_POST['prmId']))
{
	$prmId=$_POST['prmId'];
?>
	<div class="hoverContainer" id="unblockCont">
	    <div class="container blockAccountCont">
	    	<div style="padding: 10px;border-bottom: 2px solid silver">
	    		<h5><i class="fas fa-trash-alt"></i> &nbsp;Delete Confirmation</h5>
	    	</div>
	    	<div id="displayResults4"></div>
	    	<input type="text" name="prmId2" id="prmId2" value="<?php echo $prmId; ?>" style="display: none;">
	        <div style="padding: 20px;" id="d">Are you sure want to delete</div>
	        <div style="height: 50px;">
				<div style="float: right;">
					<button type="button" class="btn btn-info closeCont"><i class="fas fa-times"></i>&nbsp;No</button>
					<button type="button" class="btn btn-danger yesBtn2"><i class="fas fa-check"></i>&nbsp;Yes</button>
				</div>
			</div>
	    </div>
	</div>
<?php
}
//-------------------------------------->>
if (isset($_POST['prmId2']))
{
	$prmId2=$_POST['prmId2'];
	$update=mysqli_query($conn,"delete from pharmacist where id='$prmId2'");
	if($update){
		?>
		<br/>
		<div style="color: #2f3a48;padding: 2px;font-size: 17px;text-align: center;"><i class="fas fa-check" style="color: #229954;"></i>&nbsp;Pharmacist deleted
		</div>
		<script type="text/javascript">
			$('.closeCont').hide();
			$('.yesBtn2').hide();
			$('#d').hide();
		</script>
		<?php
	}
}
//---------------------->>
//---------------------------------------------------------------------------------------------------------->>
//----------------->>
if(isset($_POST['doctorId']))
{
	$doctorId=$_POST['doctorId'];
?>
	<div class="hoverContainer"  id="unblockCont">
	    <div class="container blockAccountCont">
	    	<div style="padding: 10px;border-bottom: 2px solid silver">
	    		<h5><i class="fas fa-trash-alt"></i> &nbsp;Delete Confirmation</h5>
	    	</div>
	    	<div id="displayResults2_user"></div>
	    	<input type="text" name="doctorId2" id="doctorId2" value="<?php echo $doctorId; ?>" style="display: none;">
	        <div style="height:70px;padding: 20px;" id="d">Are you sure want to delete
	        </div>
	        <div style="height: 50px;">
				<div style="float: right;">
					<button type="button" class="btn btn-info closeCont"><i class="fas fa-times"></i>&nbsp;No</button>
					<button type="button" class="btn btn-danger yesBtn_user"><i class="fas fa-check"></i>&nbsp;Yes</button>
				</div>
			</div>
	    </div>
	</div>
<?php
}
//---------------------->>
if(isset($_POST['userId']))
{
	$userId=$_POST['userId'];
?>
	<div class="hoverContainer" id="unblockCont">
	    <div class="container blockAccountCont">
	    	<div style="padding: 10px;border-bottom: 2px solid silver">
	    		<h5><i class="fas fa-trash-alt"></i> &nbsp;Delete Confirmation</h5>
	    	</div>
	    	<div id="displayResults3_user"></div>
	    	<input type="text" name="userId2" id="userId2" value="<?php echo $userId; ?>" style="display: none;">
	        <div style="height:100px;padding: 20px;" id="d">Are you sure want to delete
	        </div>
	        <div style="height: 50px;">
				<div style="float: right;">
					<button type="button" class="btn btn-info closeCont"><i class="fas fa-times"></i>&nbsp;No</button>
					<button type="button" class="btn btn-danger yesBtn2_user"><i class="fas fa-check"></i>&nbsp;Yes</button>
				</div>
			</div>
	    </div>
	</div>
<?php
}
//---------------------->>
//-------------------------------------->>
if (isset($_POST['doctorId2']))
{
	$doctorId2=$_POST['doctorId2'];
	$update=mysqli_query($conn,"delete from doctors where id='$doctorId2'");
	if($update){
		?>
		<br/>
		<div style="color: #2f3a48;padding: 2px;font-size: 17px;text-align: center;"><i class="fas fa-check" style="color: #229954;"></i>&nbsp;Doctor deleted
		</div>
		<script type="text/javascript">
			$('.closeCont').hide();
			$('.yesBtn_user').hide();
			$('#d').hide();
		</script>
		<?php
	}
}
//-------------------------------------->>
if (isset($_POST['userId2']))
{
	$userId2=$_POST['userId2'];
	$update=mysqli_query($conn,"delete from users where id='$userId2'");
	if($update){
		?>
		<br/>
		<div style="color: #2f3a48;padding: 2px;font-size: 17px;text-align: center;"><i class="fas fa-check" style="color: #229954;"></i>&nbsp;User deleted
		</div>
		<script type="text/javascript">
			$('.closeCont').hide();
			$('.yesBtn2_user').hide();
			$('#d').hide();
		</script>
		<?php
	}
}
//---------------------->>
?>
<script type="text/javascript">
	$(document).ready(function(){
		//------------------------->>
		$(".closeCont").on('click',function(){
			$(".hoverContainer").slideUp(1000);
		});        
		//---------------------->>
		$(".yesBtn2").click(function(){
			var prmId2=$("#prmId2").val();
			$.ajax({
				url:"ajax/ajaxDeleteAndBlock.php",
				method:"post",
				data:{
					"prmId2":prmId2,
				},
				success:function(data){
					$("#displayResults4").html(data);
					window.location.reload();
				}
			});
		});
		//--------------------------------------------------------------------------->>
		$(".yesBtn_user").click(function(){
			var doctorId2=$("#doctorId2").val();
			$.ajax({
				url:"ajax/ajaxDeleteAndBlock.php",
				method:"post",
				data:{
					"doctorId2":doctorId2,
				},
				success:function(data){
					$("#displayResults2_user").html(data);
					window.location.reload();
				}
			});
		});
		//---------------------->>
		$(".yesBtn2_user").click(function(){
			var userId2=$("#userId2").val();
			$.ajax({
				url:"ajax/ajaxDeleteAndBlock.php",
				method:"post",
				data:{
					"userId2":userId2,
				},
				success:function(data){
					$("#displayResults3_user").html(data);
					window.location.reload();
				}
			});
		});
	});
</script>