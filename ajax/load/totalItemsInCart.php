<?php
include("db_connection/db_connection.php");
$phId=$_POST['phId'];
$select=mysqli_query($conn,"select * from cart where pharmacistId='$phId'");
$num_rows=mysqli_num_rows($select);
?>
<style type="text/css">
	.inputTotalItemsInCart{
		position: fixed;
		width: 2%;
		padding: 2px 0px;
		margin-top: -16px;
		margin-left: 10px;
		text-align: center;
		border-radius: 5px;
		border:1px solid #2E86C1;
		background-color: #2E86C1;
		color: white;
		outline: none;
		font-size: 13px;
		cursor: pointer;
	}
</style>
<div>
	<input type="text" name="total" value="<?php echo $num_rows; ?>" class="inputTotalItemsInCart" readonly>
</div>