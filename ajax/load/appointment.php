<?php 
include("db_connection/db_connection.php");

$select_d=mysqli_query($conn,"select * from appointment");
$nm_row=mysqli_num_rows($select_d);
$time2  = strtotime('04:00 pm');
$tm=strtotime(date("h:i:s a"));
if($nm_row<=0)
{
	echo"";
}
else
{
	if($tm>=$time2)
	{
	    mysqli_query($conn,"appointment");
	    ?>
	    <script>
	        window.location.reload();
	    </script>
	    <?php
	}
}
?>
