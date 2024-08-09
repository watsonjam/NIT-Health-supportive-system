<?php
include("db_connection/db_connection.php");
if(isset($_POST['checkId']))
{
    foreach($_POST['checkId'] as $checkId)
    {
        
        mysqli_query($conn,"delete from drugs where id='".$checkId."'");
    }
    //--------------------------------------->>
}
?>