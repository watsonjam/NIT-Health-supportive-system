<style type="text/css">
	.statusMainCont{
		background-color: white;
		width: 40%;
		margin: 0px;
		box-sizing: border-box;
		position: absolute;
		z-index: 10;
		margin-left: -250px;
		border:1px solid silver;
		box-shadow:0px 20px 10px rgba(0,0,0,.4);
		border-radius: 5px;
	}
</style>
<?php
include("db_connection/db_connection.php");

if(isset($_POST['feedbackId']))
{
	$feedbackId=$_POST['feedbackId'];
	?>
	<div class="statusMainCont">
		<div style="padding: 10px;border-bottom: 1px solid silver">
			<div style="float: right;cursor: pointer;color: darkslategray" class="closeCont"><i class="fas fa-times"></i></div>
			<div style="font-weight: bold;color: darkslategray;font-size: 14px;letter-spacing: 0.3">Feedback</div>
		</div>
		<div style="padding: 10px;">
			<?php
			$selects=mysqli_query($conn,"select * from appointment where id='$feedbackId'");
			$rows=mysqli_fetch_array($selects);
			?>
			<p style="word-wrap: break-word;"><?php echo $rows['feedback']; ?></p>
		</div>
	</div>
	<?php
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".closeCont").on('click',function(){
			$(".statusMainCont").slideUp();
		});
		
	}); 
</script>
