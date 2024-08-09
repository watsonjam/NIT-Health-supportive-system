<?php
//including database connection
include("db_connection/db_connection.php");

$drugId=$_POST['drugId'];
$drugName=mysqli_real_escape_string($conn,$_POST['drugName']);
$manDate=mysqli_real_escape_string($conn,$_POST['manDate']);
$expireDate=mysqli_real_escape_string($conn,$_POST['expireDate']);
$quantity=mysqli_real_escape_string($conn,$_POST['quantity']);
$type=mysqli_real_escape_string($conn,$_POST['type']);
$price=mysqli_real_escape_string($conn,$_POST['price']);
$buyingPrice=mysqli_real_escape_string($conn,$_POST['buyingPrice']);
$profit=mysqli_real_escape_string($conn,$_POST['profit']);


//form validation
if(empty($drugName) and empty($manDate) and empty($expireDate) and empty($quantity) and empty($type) and empty($price))
{
	?>
	<style type="text/css">
		.formControlCont input{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
		.formControlCont2 select{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
		.loginError{display: block;}
	</style>
	<?php
}
else
{
	if(empty($drugName))
	{
		?>
		<style type="text/css">
			#drugName{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
			.drugName{display: block;}
		</style>
		<?php
	}
	else
	{
		if(strlen($drugName)>=3)
		{
			if(empty($manDate))
			{
				?>
				<style type="text/css">
					#manDate{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
					.manDate{display: block;}
				</style>
				<?php
			}
			else
			{
				if(empty($expireDate))
				{
					?>
					<style type="text/css">
						#expireDate{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
						.expireDate{display: block;}
					</style>
					<?php
				}
				else
				{
					if(empty($quantity))
					{
						?>
						<style type="text/css">
							#quantity{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
							.quantity{display: block;}
						</style>
						<?php
					}
					else
					{
						if($quantity<=0)
						{
							?>
							<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="quantity can't be less than or equal to 0"; ?></div>
								 <style type="text/css">#password{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}#quantity{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}</style>
							<?php
						}
						else
						{
							if(empty($type))
							{
								?>
								<style type="text/css">
									#type{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
									.type{display: block;}
								</style>
								<?php
							}
							else
							{
								if(empty($price))
								{
									?>
									<style type="text/css">
										#price{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}
										.price{display: block;}
									</style>
									<?php
								}
								else
								{
									if($price<=0)
									{
										?>
										<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="price can't be less than or equal to 0"; ?></div>
											 <style type="text/css">#password{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}#price{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}</style>
										<?php
									}
									else
									{
										$select=mysqli_query($conn,"select * from drugs where id='$drugId'");
										$row=mysqli_fetch_array($select);

										$update=("update drugs set drug_name='$drugName',manufacture_date='$manDate',expire_date='$expireDate',quantity='$quantity',updated_quantity='0',quantity_type='$type',buyingPrice='$buyingPrice',price='$price',profit='$profit',status='Changes' where id='$drugId'");
										$result=mysqli_query($conn,$update);
										if($result)
										{
											?>
											<script type="text/javascript">
												$(".editDrugMainCont").slideUp("slow");
											</script>
						                    <?php
										}
										else
										{
											?>
											<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="prox error occur ! there problem on server"; ?></div>
											<?php
										}
									}
								}
							}
						}
					}
				}
			}
		}
		else
		{
			?>
			<div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;<?php echo $error="drug name can't be less than 3 characters of length"; ?></div>
				 <style type="text/css">#password{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}#drugName{border-color: #EC7063;box-shadow: 0px 0px 3px 0px red}</style>
			<?php
		}
	}
}
?>