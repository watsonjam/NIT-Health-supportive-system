<?php
include("db_connection/db_connection.php");

$select=mysqli_query($conn,"select * from drugs");
$num_rows=mysqli_num_rows($select);
?>
<div>
	<?php
	$select=mysqli_query($conn,"select * from drugs");
	$num_rows=mysqli_num_rows($select);
	?>
	<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
		<div style="float: right;">
			<label style="cursor: pointer;" id="viewEquipments"><i class="fas fa-eye" style="font-size: 14px;"></i>&nbsp;&nbsp;View Equipments</label>
			&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
			<label>Total Drugs &nbsp;<?php echo $num_rows; ?></label>
		</div>
		<h6><i class="fas fa-pills" style="font-size: 22px;"></i>&nbsp;&nbsp; Manage Drugs</h6>
	</div>
	<div style="padding: 20px;">
		<table class="table table-striped table-bordered table-hover" id="dataTables" style="color: teal">
			<thead style="font-size: 14px;">
				<th>S/n</th>
				<th>Drug Name</th>
				<th>Manufacture Date</th>
				<th>Expire Date</th>
				<th>Quantity</th>
				<th>Buying Price</th>
				<th>Sale Price</th>
				<th>Profit</th>
				<th>Status</th>
				<th>Action</th>
			</thead>
			<tbody style="font-size: 15px;" id="tbody_drugs">
				<?php
				while($row=mysqli_fetch_array($select))
				{
					if($row['expire_date']<=date("Y-m-d"))
					{
						?>
						<tr style="background-color:#F1948A;">
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['drug_name']; ?></td>
							<td><?php echo $row['manufacture_date']; ?></td>
							<td><?php echo $row['expire_date']; ?></td>
							<td><?php echo $row['quantity']." ".$row['quantity_type']; ?></td>
							<td>Ths <?php echo number_format($row['buyingPrice']); ?></td>
							<td>Ths <?php echo number_format($row['price']); ?></td>
							<td>Ths <?php echo number_format($row['profit']); ?></td>
							<td>Expired</td>
							<td>
								<label class="labelAction" style="cursor: no-drop;"id="<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></label>
								<label class="labelAction delete" id="<?php echo $row['id'] ?>" style="margin-left: 10px;"><i class="fas fa-trash-alt"></i></label>
							</td>
						</tr>
						<?php
					}
					else if($row['quantity']<=0)
					{
						?>
							<tr style="background-color:#F5B041;">
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['drug_name']; ?></td>
								<td><?php echo $row['manufacture_date']; ?></td>
								<td><?php echo $row['expire_date']; ?></td>
								<td><?php echo $row['quantity']; ?></td>
								<td>Ths <?php echo number_format(0); ?></td>
								<td>Ths <?php echo number_format(0); ?></td>
								<td>Ths <?php echo number_format(0); ?></td>
								<td>Absent</td>
								<td>
									<label class="labelAction edit" id="<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></label>
									<label class="labelAction delete" id="<?php echo $row['id'] ?>" style="margin-left: 10px;"><i class="fas fa-trash-alt"></i></label>
								</td>
							</tr>
							<?php
					}
					else
					{
						?>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['drug_name']; ?></td>
							<td><?php echo $row['manufacture_date']; ?></td>
							<td><?php echo $row['expire_date']; ?></td>
							<td><?php 
							if($row['updated_quantity']<=0)
							{
								echo $row['quantity']." ".$row['quantity_type']; 
						    }
						    else
						    {
						    	echo $row['updated_quantity']." ".$row['quantity_type'];
						    }
							?></td>
							<td>Ths <?php echo number_format($row['buyingPrice']); ?></td>
							<td>Ths <?php echo number_format($row['price']); ?></td>
							<td>Ths <?php echo number_format($row['profit']); ?></td>
							<td></td>
							<td>
								<label class="labelAction edit" id="<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></label>
								<label class="labelAction delete" id="<?php echo $row['id'] ?>" style="margin-left: 10px;"><i class="fas fa-trash-alt"></i></label>
							</td>
						</tr>
						<?php
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<div class="equipments" style="display: none;">
	<?php
	$select=mysqli_query($conn,"select * from equipments");
	$num_rows=mysqli_num_rows($select);
	?>
	<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
		<div style="float: right;">
			<label style="cursor: pointer;" id="viewDrugs"><i class="fas fa-eye" style="font-size: 14px;"></i>&nbsp;&nbsp;View Drugs</label>
			&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
			<label>Total Equipments &nbsp;<?php echo $num_rows; ?></label>
		</div>
		<h6><i class="fas fa-stethoscope" style="font-size: 22px;"></i>&nbsp;&nbsp; Manage Equipments</h6>
	</div>
	<div style="padding: 20px;">
		<table class="table table-striped table-bordered table-hover" id="dataTables2" style="color: teal">
			<thead style="font-size: 14px;">
				<th>S/n</th>
				<th>Equipment Name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Profit</th>
				<th>Registration Date</th>
				<th>Action</th>
			</thead>
			<tbody style="font-size: 15px;">
				<?php
				while($row=mysqli_fetch_array($select))
				{
					?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['equipment_name']; ?></td>
						<td><?php echo $row['quantity']." ".$row['quantity_type']; ?></td>
						<td>Ths <?php echo number_format($row['price']); ?></td>
						<td>Ths <?php echo number_format($row['profit']); ?></td>
						<td><?php echo $row['registration_date']; ?></td>
						<td>
							<label id="<?php echo $row['id'] ?>" class="labelAction editEqu"><i class="fas fa-edit"></i></label>
							<label id="<?php echo $row['id'] ?>" class="labelAction deleteEqu" style="margin-left: 10px;"><i class="fas fa-trash-alt"></i></label>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		//-------------------------->>
		$('#dataTables2').DataTable();
		//---------------------->>
		$("#viewEquipments").on('click',function(){
			$(".drugs").hide();
			$(".equipments").slideDown("slow");
		});
		//---------------------->>
		$("#viewDrugs").on('click',function(){
			$(".drugs").slideDown("slow");
			$(".equipments").hide();
		});
		//---------------------->>
		//---------------------->>
		$(".edit").click(function(){
			var drugId=$(this).attr("id");
			$.ajax({
				url:"ajax/ajaxQueryManager2.php",
				method:"post",
				async:false,
				data:{"drugId":drugId},
				success:function(data)
				{
					$(".displayEditDrugResult").html(data);
				}
			});
		});
		//--------------------------------->>
		//---------------------->>
		$(".delete").click(function(){
			var drugId2=$(this).attr("id");
			$.ajax({
				url:"ajax/ajaxQueryManager2.php",
				method:"post",
				async:false,
				data:{"drugId2":drugId2},
				success:function(data)
				{
					$(".displayDeleteDrugResult").html(data);
				}
			});
		});
	});
</script>