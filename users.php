<?php 
include("includes/db_connection.php");
include("includes/security1.php");
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include("includes/head.php");
	?>
	<title>NIT Health Supportive System</title>
	<style type="text/css">
		.labelAction
		{color: #3498DB;cursor: pointer;}
		.labelAction:active{color: transparent;}
		.deleteEqu{color: #E74C3C;}
		.deletePharmacist,
		.deleteUser,
		.deleteDoctor{color: #E74C3C;}
	</style>
</head>
<?php
include("includes/admin_header.php");
?>
<body style="overflow-x: hidden;">
	<div class="row">
		<div class="col-md-3">
			<?php
			include("includes/aside_admin.php");
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
			<div class="pathMaincont">
				<div style="font-weight: 500;font-size: 13px;">Darshbord / <h6 style="display: inline-block;">Manage Users</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="mainContainer">
						<div class="doctors">
							<?php
							$select=mysqli_query($conn,"select * from doctors where details='added'");
							$num_rows=mysqli_num_rows($select);
							?>
							<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
								<div style="float: right;">
									<label style="cursor: pointer;" id="viewPharmacist"><i class="fas fa-eye" style="font-size: 14px;"></i>&nbsp;&nbsp;View Pharmacist</label>
									&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
									<label style="cursor: pointer;" id="viewUsers"><i class="fas fa-eye" style="font-size: 14px;"></i>&nbsp;&nbsp;View Users</label>
									&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
									<label>Total Doctors &nbsp;<?php echo $num_rows; ?></label>
								</div>
								<h6><i class="fas fa-pills" style="font-size: 22px;"></i>&nbsp;&nbsp; Doctors Details Overview</h6>
							</div>
							<div style="padding: 20px;">
								<table class="table table-striped table-bordered table-hover" id="dataTables" style="color: teal">
									<thead style="font-size: 14px;">
										<th>S/n</th>
										<th>Full Name</th>
										<th>Gender</th>
										<th>Email Address</th>
										<th>Phone Number</th>
										<th>Action</th>
									</thead>
									<tbody style="font-size: 15px;">
										<?php
										$x = 1;
										while($row=mysqli_fetch_array($select))
										{
											?>
											<tr>
												<td><?php echo $x; ?></td>
												<td><?php echo $row['fname']." ".$row['mName']." ".$row['lname']; ?></td>
												<td><?php echo $row['gender']; ?></td>
												<td><?php echo $row['email']; ?></td>
												<td><?php echo $row['phone_no']; ?></td>
												<td>
													<label class="labelAction viewDoctorBtn" id="<?php echo $row['id'] ?>"><i class="fas fa-eye"></i></label>
													<label class="labelAction deleteDoctor" id="<?php echo $row['id'] ?>" style="margin-left: 10px;"><i class="fas fa-trash-alt"></i></label>
												</td>
											</tr>
											<?php
											$x++;
										}										
										?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="pharmacist" style="display: none;">
							<?php
							$select=mysqli_query($conn,"select * from pharmacist where details='added'");
							$num_rows=mysqli_num_rows($select);
							?>
							<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
								<div style="float: right;">
									<label style="cursor: pointer;" id="viewDrugs3"><i class="fas fa-eye" style="font-size: 14px;"></i>&nbsp;&nbsp;View Doctors</label>
									&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
									<label style="cursor: pointer;" id="viewUsers2"><i class="fas fa-eye" style="font-size: 14px;"></i>&nbsp;&nbsp;View Users</label>
									&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
									<label>Total Pharmacist &nbsp;<?php echo $num_rows; ?></label>
								</div>
								<h6><i class="fas fa-stethoscope" style="font-size: 22px;"></i>&nbsp;&nbsp; Pharmacist Details Overview</h6>
							</div>
							<div style="padding: 20px;">
								<table class="table table-striped table-bordered table-hover" id="dataTables2" style="color: teal">
									<thead style="font-size: 14px;">
										<th>S/n</th>
										<th>Full Name</th>
										<th>Gender</th>
										<th>Email Address</th>
										<th>Phone Number</th>
										<th>Action</th>
									</thead>
									<tbody style="font-size: 15px;">
										<?php
										$l = 1;
										while($row=mysqli_fetch_array($select))
										{
											?>
											<tr>
												<td><?php echo $l; ?></td>
												<td><?php echo $row['fname']." ".$row['mName']." ".$row['lname']; ?></td>
												<td><?php echo $row['gender']; ?></td>
												<td><?php echo $row['email']; ?></td>
												<td><?php echo $row['phone_no']; ?></td>
												<td>
													<label class="labelAction viewPharmacistBtn" id="<?php echo $row['id'] ?>"><i class="fas fa-eye"></i></label>
													<label class="labelAction deletePharmacist" id="<?php echo $row['id'] ?>" style="margin-left: 10px;"><i class="fas fa-trash-alt"></i></label>
												</td>
											</tr>
											<?php
											$l++;
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="users" style="display: none;">
							<?php
							$select=mysqli_query($conn,"select * from users where details='added'");
							$num_rows=mysqli_num_rows($select);
							?>
							<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
								<div style="float: right;">
									<label style="cursor: pointer;" id="viewDrugs2"><i class="fas fa-eye" style="font-size: 14px;"></i>&nbsp;&nbsp;View Doctors</label>
									&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
									<label style="cursor: pointer;" id="viewPharmacist2"><i class="fas fa-eye" style="font-size: 14px;"></i>&nbsp;&nbsp;View Pharmacist</label>
									&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
									<label>Total users &nbsp;<?php echo $num_rows; ?></label>
								</div>
								<h6><i class="fas fa-user-friends" style="font-size: 22px;"></i>&nbsp;&nbsp; Users Details Overview</h6>
							</div>
							<div style="padding: 20px;">
								<table class="table table-striped table-bordered table-hover" id="dataTables3" style="color: teal">
									<thead style="font-size: 14px;">
										<th>S/n</th>
										<th>Full Name</th>
										<th>Gender</th>
										<th>Email Address</th>
										<th>Phone Number</th>
										<th>Action</th>
									</thead>
									<tbody style="font-size: 15px;">
										<?php
										$u = 1;
										while($row=mysqli_fetch_array($select))
										{
											?>
											<tr>
												<td><?php echo $u; ?></td>
												<td><?php echo $row['fname']." ".$row['mName']." ".$row['lname']; ?></td>
												<td><?php echo $row['gender']; ?></td>
												<td><?php echo $row['email']; ?></td>
												<td><?php echo $row['phone_no']; ?></td>
												<td>
													<label class="labelAction viewUserBtn" id="<?php echo $row['id'] ?>"><i class="fas fa-eye"></i></label>
													<label class="labelAction deleteUser" id="<?php echo $row['id'] ?>" style="margin-left: 10px;"><i class="fas fa-trash-alt"></i></label>
												</td>
											</tr>
											<?php
											$u++;
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
	<div class="displayViewEmployeeResult"></div>
	<div class="displayViewSuppllierResult"></div>
	<div class="displayResultCont"></div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function () {
		$('#dataTables').DataTable();
		//-------------------------->>
		$('#dataTables2').DataTable();
		//-------------------------->>
		$('#dataTables3').DataTable();
		//---------------------->>
		$("#viewPharmacist").on('click',function(){
			$(".doctors").hide(900);
			$(".users").hide(900);
			$(".pharmacist").show(900);
		});
		$("#viewPharmacist2").on('click',function(){
			$(".doctors").hide(900);
			$(".users").hide(900);
			$(".pharmacist").show(900);
		});
		//---------------------->>
		$("#viewDrugs").on('click',function(){
			$(".doctors").show(900);
			$(".pharmacist").hide(900);
			$(".users").hide(900);
		});
		$("#viewDrugs2").on('click',function(){
			$(".doctors").show(900);
			$(".pharmacist").hide(900);
			$(".users").hide(900);
		});
		$("#viewDrugs3").on('click',function(){
			$(".doctors").show(900);
			$(".pharmacist").hide(900);
			$(".users").hide(900);
		});
		//---------------------->>
		$("#viewUsers").on('click',function(){
			$(".users").show(900);
			$(".pharmacist").hide(900);
			$(".doctors").hide(900);
		});
		//---------------------->>
		$("#viewUsers2").on('click',function(){
			$(".users").show(900);
			$(".pharmacist").hide(900);
			$(".doctors").hide(900);
		});
		//------------------------>>
		$(".viewDoctorBtn").click(function(){
			var doctorId=$(this).attr("id");
			$.ajax({
				url:"ajax/users/usersQuery.php",
				method:"post",
				async:false,
				data:{"doctorIdViewProfile":doctorId},
				success:function(data)
				{
					
					$(".displayViewEmployeeResult").html(data);
				}
			});
		});
		//------------------------>>
		$(".viewPharmacistBtn").click(function(){
			var prmId=$(this).attr("id");
			$.ajax({
				url:"ajax/users/usersQuery.php",
				method:"post",
				async:false,
				data:{prmId:prmId},
				success:function(data)
				{
					$(".displayViewSuppllierResult").html(data);
				}
			});
		});
		//------------------------>>
		$(".viewUserBtn").click(function(){
			var userId=$(this).attr("id");
			$.ajax({
				url:"ajax/users/usersQuery.php",
				method:"post",
				async:false,
				data:{"userId":userId},
				success:function(data)
				{
					$(".displayViewSuppllierResult").html(data);
				}
			});
		});
		//---------------------------->>
		$(".deleteDoctor").click(function(){
			var doctorId=$(this).attr("id");
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
			var prmId=$(this).attr("id");
			$.ajax({
				url:"ajax/ajaxDeleteAndBlock.php",
				method:"post",
				data:{"prmId":prmId},
				success:function(data)
				{
					$(".displayResultCont").html(data);
				}
			});
		});
		//---------------------------->>
		$(".deleteUser").click(function(){
			var userId=$(this).attr("id");
			$.ajax({
				url:"ajax/ajaxDeleteAndBlock.php",
				method:"post",
				data:{"userId":userId},
				success:function(data)
				{
					$(".displayResultCont").html(data);
				}
			});
		});
	});
</script>