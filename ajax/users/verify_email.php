<style type="text/css">
	.errorCont{margin-bottom: 5px;padding: 7px;background-color: #E6B0AA;border-radius: 3px;box-shadow: 0px 0px 5px 0px #B03A2E inset;color: #943126}
</style>
<?php
include_once("db_connection/db_connection.php");

if(isset($_POST['userId']))
{
	$userId=$_POST['userId'];
	$verfyEmail=$_POST['verfyEmail'];
	$select=mysqli_query($conn,"select * from users where id='$userId'");
	$rws=mysqli_fetch_array($select);
	$verification_code=$rws['email_verification_code'];
	if(empty($verfyEmail))
	{
		?>
		<style type="text/css">
			#verfyEmail{border-color:red;box-shadow: 0px 0px 2px 0px red;}
			.verfyEmail{display: block;}
		</style>
		<?php
	}
	else
	{
		if($verification_code==$verfyEmail)
		{
			$update=("update users set about_email='Verified' where id='$userId'");
			$query=mysqli_query($conn,$update);
			if($query) {
				?>
				<script type="text/javascript">
					window.location.reload();
				</script>
				<?php
			}
			else{
				?>
					<div class="errorCont"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;prox error occur</div>
				<?php
			}
		}
		else{
			?>
			<div class="errorCont"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;invalid verification code</div>
				<style type="text/css">#verfyEmail{border-color:red;box-shadow: 0px 0px 2px 0px red;}</style>
			<?php
		}
	}
}
?>