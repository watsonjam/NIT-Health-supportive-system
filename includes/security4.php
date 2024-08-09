<?php
include('db_connection.php');
//------------------>>
//-------------->>
$id=$_GET['id'];
$token=$_GET['token'];
//--------------------------------------->>
$select=("select * from users where id='$id'");
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