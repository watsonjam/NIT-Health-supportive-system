<?php
include("db_connection/db_connection.php");
$select=mysqli_query($conn,"select * from sales");
$num_rows=mysqli_num_rows($select);
$totalAmnt=0;
$selects=mysqli_query($conn,"select * from sales");
while($rowAmount=mysqli_fetch_array($selects))
{
	$totalAmnt+=$rowAmount['total_price'];
}
?>
<div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
	<div style="float: right;">
		<label><?php
		if($totalAmnt==0)
		{
			echo "";
		}
		else{
			echo'Total Amount&nbsp;Tsh &nbsp;'.number_format($totalAmnt).'&nbsp;/='; 
		}
		 ?></label>
		&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
		<label>Total sales &nbsp;<?php echo $num_rows; ?></label>
	</div>
	<h6><i class="fas fa-stethoscope" style="font-size: 22px;"></i>&nbsp;&nbsp;  Product Sales</h6>
</div>
<div style="padding: 20px;">
	<table class="table table-striped table-bordered table-hover" id="dataTables" style="color: teal">
		<thead style="font-size: 14px;">
			<th>S/n</th>
			<th>Seller Name</th>
			<th>Client Name</th>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Transaction Date</th>
			<th>Action</th>
		</thead>
		<tbody style="font-size: 15px;" id="tbody_sales">
			<?php
			while($row=mysqli_fetch_array($select))
			{
				?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['seller_name']; ?></td>
					<td><?php echo $row['customer_name']; ?></td>
					<td><?php echo $row['item_name']; ?></td>
					<td><?php echo $row['quantity']; ?></td>
					<td>Ths <?php echo number_format($row['total_price']); ?></td>
					<td><?php echo $row['date_sale']; ?></td>
					<td>
						<label id="<?php echo $row['id'] ?>" class="labelAction deleteSale" style="margin-left: 10px;"><i class="fas fa-trash-alt"></i></label>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#dataTables').DataTable();
		//-------------------------->>
		$(".deleteSale").click(function(){
			var saleId=$(this).attr("id");
			$.ajax({
				url:"ajax/ajaxQueryManager3.php",
				method:"post",
				async:false,
				data:{"saleId":saleId},
				success:function(data)
				{
					$(".displayDeleteSaleResult").html(data);
				}
			});
		});
	});
</script>