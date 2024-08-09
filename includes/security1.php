<?php
include('db_connection.php');
//------------------>>
//-------------->>
$id=$_REQUEST['id'];
$token=$_REQUEST['token'];
//--------------------------------------->>
$select=("select * from admin where id='$id'");
$query=mysqli_query($conn,$select);
$row=mysqli_fetch_array($query);
//-------------------------------------->>
if($row['id'] !==$id or $row['token'] !==$token)
{
	header('location:index.php');
}
?>
<script>
    function redictUser(){
        window.history.forward();
    }
    setTimeout("redictUser()",0);
    window.onunload=function(){null};
</script>