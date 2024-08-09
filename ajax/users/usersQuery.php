 <style type="text/css">
	.viewContructorDetailsMainCont{width: 100%;top: 0px;position: fixed;left: 0px;float: none;margin: 0px;height: 100%;background-color: rgba(0,0,0,.4);z-index: 10;}
	.viewContructorDetailsSubCont{width: 75%;margin-left: 15%;background-color: white;box-sizing: content-box;border:1px solid silver;box-shadow: 0px 30px 15px rgba(0,0,0,.4);margin-top: 1%;border-radius: 4px;}
	.viewContructorDetailsThirdCont{overflow-y: scroll;height: 595px;padding: 0px;}
	.viewContructorDetailsThirdCont::-webkit-scrollbar{width: 9px;margin: 10px;}
	.viewContructorDetailsThirdCont::-webkit-scrollbar-track{background:transparent;}
	.viewContructorDetailsThirdCont::-webkit-scrollbar-thumb{background:silver;border-radius: 0px;}
	.viewContructorDetailsThirdCont::-webkit-scrollbar-thumb:hover{background:gray; }
	.btnCont button{cursor: pointer;border-radius: 2px;border: 1px solid silver;padding: 6px;font-size: 14px;outline: none;}
	#btn1{background-color: #CB4335;color: white;border: 1px solid #CB4335}
	#btn1:active{background-color: transparent;color: darkslategray;border: 1px solid transparent;}
	#btn2{background-color: #3498DB;color: white;border: 1px solid #3498DB;}
	#btn2:active{background-color: transparent;color: darkslategray;border: 1px solid transparent;}
	#btn3{background-color: #28B463;color: white;border: 1px solid #28B463;}
	#btn3:active{background-color: transparent;color: darkslategray;border: 1px solid transparent;}
	.editDrugMainCont{position: fixed;top: 0px;left: 0px;float: none;background-color: rgba(0,0,0,.6);width: 100%;height: 100%;z-index: 14;}
	.deleteMainCont{width: 35%;margin-left:35%;margin-top: 10%;background-color: white;border-radius: 3px;box-shadow: 0px 20px 10px rgba(0,0,0,.4);animation: 1s deleteCont;position: relative;}
	@keyframes deleteCont{from{top: -300px;opacity: 0}to{top: 0px;opacity: 1}}
	.yeBtn{background-color: #E74C3C;border:1px solid #E74C3C;color: white;cursor: pointer;line-height: 30px;border-radius: 3px; padding:5px;padding-top:0px;padding-bottom:0px;}
    .hoverContainer{position: absolute;top: 0px;float: none;left: 0px;width: 100%;height: 300%;background-color: rgba(0,0,0,.2);z-index: 100;}
    .monthSaleContainer{background-color: white;box-sizing: border-box;box-shadow: 0px 0px 100px 0px rgba(0,0,0,.4);border-radius: 4px;margin-top: 1%;color: darkslategray;}
</style>
<?php
//including database connection
include("db_connection/db_connection.php");

if(isset($_POST['doctorIdViewProfile']))
{
	$doctorId=$_POST['doctorIdViewProfile'];
	//----------------------->>
	$select=mysqli_query($conn,"select * from doctors where id='$doctorId'");
	$row=mysqli_fetch_array($select);
	?>
	<div class="viewContructorDetailsMainCont">
		<div class="viewContructorDetailsSubCont">
			<div id="loadContent">
				<div style="height: 370px;">
					<div style="margin-top: 250px;">
						<center><img src="images/icons/lod.gif" height="100" width="100"></center>
					</div>
				</div>
			</div>
			<div style="display: none;" id="showContent">
				<div style="padding: 10px;background:linear-gradient(#3498DB,#1F618D) ;color: white">
					<div style="float: right;cursor: pointer;" id="closeContainer"><i class="fas fa-times"></i></div>
					<div><h6>Doctor Full Profile</h6></div>
				</div>
				<div class="viewContructorDetailsThirdCont">
					<div class="row">
		            	<div class="col-md-9">
		            		<h5>Details</h5>
		            		<table class="table">
				            	<tr>
				            		<td>Full Name:</td>
				            		<td id="tdDetails"><?php echo $row['fname']." ".$row['mName']." ".$row['lname']; ?></td>
				            	</tr>
				            	<tr>
				            		<td>Gender:</td>
				            		<td id="tdDetails"><?php echo $row['gender']; ?></td>
				            	</tr>
				            	<tr>
				            		<td>Nationality:</td>
				            		<td id="tdDetails"><?php echo $row['nationality']; ?></td>
				            	</tr>
				            	<tr>
				            		<?php
				            		 $date = new DateTime($row['date_of_birth']);
									 $now = new DateTime();
									 $age = $now->diff($date);
				            		?>
				            		<td>Age:</td>
				            		<td id="tdDetails"><?php echo $age->y; ?>&nbsp; years old</td>
				            	</tr>
				            </table>
				            <br>
				            <h5>Contact</h5>
				            <table class="table">
				            	<tr>
				            		<td>Email Address:</td>
				            		<td id="tdDetails"><?php echo $row['email']; ?></td>
				            	</tr>
				            	<tr>
				            		<td>Phone Number:</td>
				            		<td id="tdDetails"><?php echo $row['phone_no']; ?></td>
				            	</tr>
				            </table>
				            <br>
				            <h5>Other Details</h5>
				            <table class="table">
				            	<tr>
				            		<td>Registered On:</td>
				            		<td id="tdDetails"><?php echo $row['date_registered']." at ".$row['time_registered']; ?></td>
				            	</tr>
                                <tr>
				            		<td>Status:</td>
				            		<td id="tdDetails"><?php echo $row['status']; ?></td>
				            	</tr>
				            </table>
		            	</div>
		            	<div class="col-md-3">
		            		<div style="margin-top: 10px;margin-left: 10px;">
		            			<?php
				            	if(empty($row['picture']))
				            	{
				            		echo"";
				            	}
				            	else
				            	{
					            	?>
					            	<div style="margin-bottom: 10px;font-weight: 500;color: darkslategray"><center><?php echo $row['fullName']; ?></center></div>
					                <img src="<?php echo $row['picture']; ?>" class="img-responsive" height="200" width="200" style="object-fit: cover;">
					                <?php
					            }
				                ?>
		            		</div>
		            	</div>
		            </div>
				</div>
				<div>
		        	<input type="text" name="doctorId" id="doctorId" value="<?php echo $doctorId; ?>" style="display: none;">
		        	<div class="btnContainer" style="padding: 10px;background-color: lavender;height: 60px;">
		        		<div style="float: right;" class="btnCont" id="btnCont">
		        			<button id="btn1" class="btn btn-danger deleteDoctor"><i class="far fa-trash-alt"></i>&nbsp;Delete</button>
		        		</div>
		        	</div>
		        </div>
			</div>
		</div>
	</div>
	<?php
}
//--------------------------------------->>
if(isset($_POST['prmId']))
{
	$prmId=$_POST['prmId'];
	//----------------------->>
	$select=mysqli_query($conn,"select * from pharmacist where id='$prmId'");
	$row=mysqli_fetch_array($select);
	?>
	<div class="viewContructorDetailsMainCont">
		<div class="viewContructorDetailsSubCont">
			<div id="loadContent">
				<div style="height: 370px;">
					<div style="margin-top: 250px;">
						<center><img src="images/icons/lod.gif" height="100" width="100"></center>
					</div>
				</div>
			</div>
			<div style="display: none;" id="showContent">
				<div style="padding: 10px;background:linear-gradient(#3498DB,#1F618D) ;color: white">
					<div style="float: right;cursor: pointer;" id="closeContainer"><i class="fas fa-times"></i></div>
					<div><h6>Pharmacist Full Profile</h6></div>
				</div>
				<div class="viewContructorDetailsThirdCont">
					<div class="row">
		            	<div class="col-md-9">
		            		<h5>Details</h5>
		            		<table class="table">
				            	<tr>
				            		<td>Full Name:</td>
				            		<td id="tdDetails"><?php echo $row['fname']." ".$row['mName']." ".$row['lname']; ?></td>
				            	</tr>
				            	<tr>
				            		<td>Gender:</td>
				            		<td id="tdDetails"><?php echo $row['gender']; ?></td>
				            	</tr>
				            	<tr>
				            		<td>Nationality:</td>
				            		<td id="tdDetails"><?php echo $row['nationality']; ?></td>
				            	</tr>
				            	<tr>
				            		<?php
				            		$date = new DateTime($row['date_of_birth']);
									 $now = new DateTime();
									 $age = $now->diff($date);
				            		?>
				            		<td>Age:</td>
				            		<td id="tdDetails"><?php echo $age->y; ?>&nbsp; years old</td>
				            	</tr>
				            </table>
				            <br>
				            <h5>Contact</h5>
				            <table class="table">
				            	<tr>
				            		<td>Email Address:</td>
				            		<td id="tdDetails"><?php echo $row['email']; ?></td>
				            	</tr>
				            	<tr>
				            		<td>Phone Number:</td>
				            		<td id="tdDetails"><?php echo $row['phone_no']; ?></td>
				            	</tr>
				            </table>
				            <br>
				            <h5>Other Details</h5>
				            <table class="table">
				            	<tr>
				            		<td>Registered On:</td>
				            		<td id="tdDetails"><?php echo $row['date_registered']." at ".$row['time_registered']; ?></td>
				            	</tr>
				            </table>
		            	</div>
		            	<div class="col-md-3">
		            		<div style="margin-top: 10px;margin-left: 20px;">
		            			<?php
				            	if(empty($row['picture']))
				            	{
				            		echo"";
				            	}
				            	else
				            	{
					            	?>
					            	<div style="margin-bottom: 10px;font-weight: 500;color: darkslategray"><center><?php echo $row['fullName']; ?></center></div>
					                <img src="<?php echo $row['picture']; ?>" class="img-responsive" height="200" width="200" style="object-fit: cover;">
					                <?php
					            }
				                ?>
		            		</div>
		            	</div>
		            </div>
				</div>
				<div>
		        	<input type="text" name="prmId" id="prmId" value="<?php echo $prmId; ?>" style="display: none;">
		        	<div style="padding: 10px;background-color: lavender;height: 60px;">
		        		<div style="float: right;" class="btnCont" id="btnCont">
		        			<button id="btn1" class="deletePharmacist"><i class="far fa-trash-alt"></i>&nbsp;Delete</button>
		        		</div>
		        	</div>
		        </div>
			</div>
		</div>
	</div>
	<?php
	//--------------------------------------->>
}
if(isset($_POST['userId']))
{
	$userId=$_POST['userId'];
	//----------------------->>
	$select=mysqli_query($conn,"select * from users where id='$userId'");
	$row=mysqli_fetch_array($select);
	?>
	<div class="viewContructorDetailsMainCont">
		<div class="viewContructorDetailsSubCont">
			<div id="loadContent">
				<div style="height: 370px;">
					<div style="margin-top: 250px;">
						<center><img src="images/icons/lod.gif" height="100" width="100"></center>
					</div>
				</div>
			</div>
			<div style="display: none;" id="showContent">
				<div style="padding: 10px;background:linear-gradient(#3498DB,#1F618D) ;color: white">
					<div style="float: right;cursor: pointer;" id="closeContainer"><i class="fas fa-times"></i></div>
					<div><h6>User Full Profile</h6></div>
				</div>
				<div class="viewContructorDetailsThirdCont">
					<div class="row">
		            	<div class="col-md-9">
		            		<h5>Details</h5>
		            		<table class="table">
				            	<tr>
				            		<td>Full Name:</td>
				            		<td id="tdDetails"><?php echo $row['fname']." ".$row['mName']." ".$row['lname']; ?></td>
				            	</tr>
				            	<tr>
				            		<td>Gender:</td>
				            		<td id="tdDetails"><?php echo $row['gender']; ?></td>
				            	</tr>
				            	<tr>
				            		<td>Nationality:</td>
				            		<td id="tdDetails"><?php echo $row['nationality']; ?></td>
				            	</tr>
				            	<tr>
				            		<?php
				            		$date = new DateTime($row['date_of_birth']);
									 $now = new DateTime();
									 $age = $now->diff($date);
				            		?>
				            		<td>Age:</td>
				            		<td id="tdDetails"><?php echo $age->y; ?>&nbsp; years old</td>
				            	</tr>
				            </table>
				            <br>
				            <h5>Contact</h5>
				            <table class="table">
				            	<tr>
				            		<td>Email Address:</td>
				            		<td id="tdDetails"><?php echo $row['email']; ?></td>
				            	</tr>
				            	<tr>
				            		<td>Phone Number:</td>
				            		<td id="tdDetails"><?php echo $row['phone_no']; ?></td>
				            	</tr>
				            </table>
				            <br>
				            <h5>Other Details</h5>
				            <table class="table">
				            	<tr>
				            		<td>Registered On:</td>
				            		<td id="tdDetails"><?php echo $row['date_registered']." at ".$row['time_registered']; ?></td>
				            	</tr>
				            </table>
		            	</div>
		            	<div class="col-md-3">
		            		<div style="margin-top: 10px;margin-left: 20px;">
		            			<?php
				            	if(empty($row['picture']))
				            	{
				            		echo"";
				            	}
				            	else
				            	{
					            	?>
					            	<div style="margin-bottom: 10px;font-weight: 500;color: darkslategray"><center><?php echo $row['fullName']; ?></center></div>
					                <img src="<?php echo $row['picture']; ?>" class="img-responsive" height="200" width="200" style="object-fit: cover;">
					                <?php
					            }
				                ?>
		            		</div>
		            	</div>
		            </div>
				</div>
				<div>
		        	<input type="text" name="userId" id="userId" value="<?php echo $userId; ?>" style="display: none;">
		        	<div style="padding: 10px;background-color: lavender;height: 60px;">
		        		<div style="float: right;" class="btnCont" id="btnCont">
		        			<button id="btn1" class="deleteUrBtn"><i class="far fa-trash-alt"></i>&nbsp;Delete</button>
		        		</div>
		        	</div>
		        </div>
			</div>
		</div>
	</div>
	<?php
}
?>
<div class="displayResultCont"></div>
<div class="displayResultCont2"></div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#closeContainer").click(function(){
			$(".viewContructorDetailsMainCont").css("display","none");
		});
		//------------------------->>
		$(".closeCont").click(function(){
			$(".editDrugMainCont").hide();
		});
		//---------------------------->>
		$(".deleteDoctor").click(function(){
			var doctorId=$("#doctorId").val();
			$.ajax({
				url:"ajax/ajaxDeleteAndBlock.php",
				method:"post",
				data:{"doctorId":doctorId},
				success:function(data)
				{
					$(".displayResultCont").html(data);
				}
			});
		});
		//---------------------------->>
		$(".deletePharmacist").click(function(){
			var prmId=$("#prmId").val();
			$.ajax({
				url:"ajax/ajaxDeleteAndBlock.php",
				method:"post",
				data:{"prmId":prmId},
				success:function(data)
				{
					$(".displayResultCont2").html(data);
				}
			});
		});
		//---------------------------->>
		$(".deleteUrBtn").click(function(){
			var userId=$("#userId").val();
			$.ajax({
				url:"ajax/ajaxDeleteAndBlock.php",
				method:"post",
				data:{"userId":userId},
				success:function(data)
				{
					$(".displayResultCont2").html(data);
				}
			});
		});
		//-------------------------->>
		$(".closeSaleCont").on('click',function(){
			$(".hoverContainer").hide();
		});
		//------------------------>>
		$("#printContainer").click(function(){
			$("#monthSaleResult").printThis({
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
	});
	//javacript
	function showContrDetails()
	{
		document.getElementById('loadContent').style.display="none";
		document.getElementById('showContent').style.display="block";
	}
	setTimeout("showContrDetails()",4000);
	//javacript
	function showContrDetails2()
	{
		document.getElementById('loadContainer').style.display="none";
		document.getElementById('monthSaleResult').style.display="block";
	}
	setTimeout("showContrDetails2()",4000);

</script>