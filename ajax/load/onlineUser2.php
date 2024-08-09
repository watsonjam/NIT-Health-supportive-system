<?php
include("db_connection/db_connection.php");
$select=mysqli_query($conn,"select * from admin");
$rowData=mysqli_fetch_array($select);
if($rowData['status']=="Online")
{
    ?>
    <div class="onlineUser3">
        <label></label><span style="display: inline-block;vertical-align: top;margin-top:-6px;margin-left:5px;">Online</span>
    </div>
    <?php
}
?>
