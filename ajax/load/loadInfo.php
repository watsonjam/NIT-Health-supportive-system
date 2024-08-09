<style type="text/css">
	.newNot{padding: 2px 10px;background-color: #E74C3C;max-width: 10%;position: fixed;margin-left: 140px;color: white;border-radius: 5px;margin-top: -6px;}
</style>
<?php
include("db_connection/db_connection.php");
if(isset($_POST['contentId'])){
	$selectAsbentDrug=mysqli_query($conn,"select * from drugs where quantity<='0'");
    $num_rows1=mysqli_num_rows($selectAsbentDrug);
    echo $num_rows1;
}
if(isset($_POST['contentId2'])){
	$date=date("Y-m-d");
	$selectExpiredDrug=mysqli_query($conn,"select * from drugs where expire_date<='$date'");
	$num_rows2=mysqli_num_rows($selectExpiredDrug);
    echo $num_rows2;
}
if(isset($_POST['contentId3']))
{
	$fetchData=mysqli_query($conn,"select * from drugs where alertAddingDrug > quantity");
    $nm_rows1=mysqli_num_rows($fetchData);
    echo $nm_rows1;
}
if(isset($_POST['doctorId']))
{
	$doctorId=$_POST['doctorId'];
	$doctorId="doctor".$doctorId;
	$selectDt=mysqli_query($conn,"select * from appointment where doctorId='$doctorId' and about_appo='New'");
	$num_rw=mysqli_num_rows($selectDt);
	if($num_rw<1){
    echo"";
	}
	else{
	    ?>
	    <div class="newNot"><?php echo $num_rw; ?></div>
	    <?php
	}
}
?>