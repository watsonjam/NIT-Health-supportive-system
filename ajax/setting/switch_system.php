<?php
include("db_connection/db_connection.php");
if(isset($_POST['switchOn']))
{
	$doctor_id=$_POST['doctor_id'];
	$doctor_name=$_POST['doctor_name'];
	$select=mysqli_query($conn,"select * from setting where doctor_id='$doctor_id'");
	$num_row=mysqli_num_rows($select);
	if($num_row<=0)
	{
		mysqli_query($conn,"insert into setting (doctor_id,doctor_name,switch_button,status) values('$doctor_id','$doctor_name','checked','On')");
	}
	else{
		mysqli_query($conn,"update setting set switch_button='checked',status='On' where doctor_id='$doctor_id'");
	}
}
//--------------------------->>
if(isset($_POST['switchOff']))
{
	$doctor_id=$_POST['doctor_id'];
	$doctor_name=$_POST['doctor_name'];
	$select=mysqli_query($conn,"select * from setting where doctor_id='$doctor_id'");
	$num_row=mysqli_num_rows($select);
	if($num_row<=0)
	{
		mysqli_query($conn,"insert into setting (doctor_id,doctor_name,switch_button,status) values('$doctor_id','$doctor_name','','Off')");
	}
	else{
		mysqli_query($conn,"update setting set switch_button='',status='Off' where doctor_id='$doctor_id'");
	}
}
?>
