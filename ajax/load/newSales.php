<style type="text/css">
	.newSaleNot{position: absolute;color: white;font-family: sans-serif;font-weight: 600;right:-11px;display: inline-block;padding:3px 5px;background-color: rgba(69,171,35);font-size: 12px;border-radius: 0px;margin-top: 7px;}
    .newSaleNot:after{position: inherit;width: 10;height: 13px;content: ' ';border:8px  solid;border-color: transparent transparent darkgreen transparent;transform:rotate(-45deg);right: 3px;margin-top: 15px;z-index: -20;}
</style>
<?php
include("db_connection/db_connection.php");
$selectNewSales=mysqli_query($conn,"select * from sales where status='New'");
$nm_rw=mysqli_num_rows($selectNewSales);
if($nm_rw>0)
{
	echo'<label class="newSaleNot"><i>'.$nm_rw.'&nbsp; New Sales</i></label>';
}
else{echo"";}
?>