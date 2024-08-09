<style type="text/css">
	.loadingContainer_hover{position: fixed;top: 0px;left: 0px;margin: 0px;float: none;width: 100%;height: 100%;background-color: rgba(0,0,0,.5);z-index: 100;}
    .loadingContainer{margin-top: 15%}
</style>
<?php
include("db_connection/db_connection.php");

$flname=mysqli_real_escape_string($conn,$_POST['flname']);
$password=mysqli_real_escape_string($conn,$_POST['pass']);
$confPass=mysqli_real_escape_string($conn,$_POST['confPass']);
$date=date("d/m/Y");
$time=date("h:i a");
$select=mysqli_query($conn,"select id from users order by id desc");
$fetch=mysqli_fetch_array($select);
$id=$fetch[0]+1;

if(empty($flname) and empty($password) and empty($confPass))
{
	?>
	<style type="text/css">.form-input-container-register input{border-color:red;box-shadow: 0px 0px 2px 0px red;}.error_reg{display: block;}</style>
	<?php
}
else{
	if(empty($flname))
	{
		?>
		<style type="text/css">#flname{border-color:red;box-shadow: 0px 0px 2px 0px red;}.flnameError{display: block;}</style>
		<?php
	}
	else{
		if(empty($password))
		{
			?>
			<style type="text/css">#password{border-color:red;box-shadow: 0px 0px 2px 0px red;}.passwordError{display: block;}</style>
			<?php
		}
		else{
			if(empty($confPass))
			{
				?>
				<style type="text/css">#confPass{border-color:red;box-shadow: 0px 0px 2px 0px red;}.confPassError{display: block;}</style>
				<?php
			}
			else{
				$name1=substr($flname, 0, 2);
                $name2=substr($flname, -2, 2);
                $username=$name1.$name2;
                $pass=md5($password);
				$details="not added";
				$randKey=rand(99999,999999);
				$username=$username.$randKey;
				$insert=("insert into users (id,username,password,details,role,date_registered,time_registered) values('$id','$username','$pass','$details','user','$date','$time')");

				$query=mysqli_query($conn,$insert);
				if($query)
				{
					?>
					<script type="text/javascript">
						$(".register-form")[0].reset();
                        setTimeout(function(){
                            $(".loadingContainer_hover").hide();
                            $(".result").show();
                        },4000);
					</script>
                    <div class="loadingContainer_hover">
                        <center>
                            <div class="loadingContainer">
                                <img src="images/icons/double_loading.svg" height="120">
                                <div style="color:white">
                                    <h6>Please Wait.......</h6>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div  style="color: #2f3a48;padding: 7px;background-color: #A9DFBF;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);display:none" class="result">
                    	<i class="fas fa-check-circle" style="font-size: 18px;color: #229954;"></i>&nbsp;&nbsp;Successfully<br><br>
                    	<div>
                    		<div style="font-size: 15px;">Username= <strong><?php echo $username; ?></strong></div><br>
                    		<div style="font-size: 15px;">Password= <strong><?php echo $password; ?></strong></div>
                    		<div>
                    			<div style="float: right;margin-top: -20px;margin-right: 10px;font-size: 17px;cursor: pointer">
									<span class="signInLink text-info"><b>LogIn</b></span>
								</div>
                    		</div>
                    	</div>
                    </div>
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
?>
<script type="text/javascript">
	$('.signInLink').on('click',function(){
		$('.signUpfom').hide(1000);
		$('.signInfom').show(1000);
	});
</script>