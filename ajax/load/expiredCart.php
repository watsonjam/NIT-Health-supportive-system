<?php 
include("db_connection/db_connection.php");

$employeeId=$_POST['employeeId'];
$select=mysqli_query($conn,"select * from expiredcart where employeeId='$employeeId'");
while($rw=mysqli_fetch_array($select))
{
    ?>
    <?php
    $newTime=$rw['expiredTime'];
    $tm=date("Y-m-d h:i:s A");
    if($tm>=$newTime)
    {
        mysqli_query($conn,"delete from cart where pharmacistId='$employeeId'");
        mysqli_query($conn,"update drugs set updated_quantity='0'");
        mysqli_query($conn,"delete from expiredcart  where employeeId='$employeeId'");
        $select2=mysqli_query($conn,"select * from cart where pharmacistId='$employeeId'");
        $fetchResult=mysqli_num_rows($select2);
        if($fetchResult<=0)
        {
            echo "";
        }
        else{
            ?>
            <script>
                window.location.reload();
            </script>
            <?php
        }
    }
}
?>
