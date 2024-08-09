<?php
//including database connection
include("db_connection/db_connection.php");

//------------------>>
$delete=("delete from sales");
$result=mysqli_query($conn,$delete);
if($result)
{
	mysqli_query($conn,"delete from payment_receipt");
}
?>