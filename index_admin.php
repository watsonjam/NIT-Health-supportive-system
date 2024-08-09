<?php 
include("includes/db_connection.php");
include("includes/security1.php");
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include("includes/head.php");
	?>
	<title>NIT Health Supportive System</title>
	<style type="text/css">
	</style>
</head>
<?php
include("includes/admin_header.php");
?>
<body class="system-body">
	<div class="row">
		<div class="col-md-3">
			<?php
			include("includes/aside_admin.php");
			?>
		</div>
		<div class="col-md-9">
			<div class="pathMaincont">
				<div style="font-weight: 500;font-size: 13px;">Admin / <h6 style="display: inline-block;">Darshbord</h6></div>
			</div>
			<article class="articleMaincont">
				<div class="articleSubcont">
					<div class="container mainContainer" id="mainContainer" style="margin-top:-12px;padding: 10px;">
                        <div>
							<div id="goTop" title="Go back to Top"><a href=""><i class="fas fa-angle-double-up fa-2x"></i></a></div>
							<?php
							
							?>
						</div>
						
					</div>
				</div>
			</article>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
	    $(window).scroll(function() {
	    if($(this).scrollTop()>300)
	    {
	       $('#goTop').show(1000);
	    }
	    else
	    {
	       $('#goTop').hide(1000);
	    }
	    });
	    $("#goTop").on('click', function(e) {
	       e.preventDefault();
	       $('html, body').animate({scrollTop:0}, '800');
	    });
	});
</script>