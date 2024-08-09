<?php
include("db_connection/db_connection.php");

$id=$_POST['id'];
$token=$_POST['token'];
$select=mysqli_query($conn,"select * from drugs");
$num_rows=mysqli_num_rows($select);
?>
<div>
    <div style="padding: 10px;border-bottom: 1px solid lightgrey;background:linear-gradient(#3498DB,#1F618D) ;color: white">
        <div style="float: right;">
            <label style="cursor: pointer;" id="viewEquipments"><i class="fas fa-eye" style="font-size: 14px;"></i>&nbsp;&nbsp;View Equipments</label>
            &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
            <label>Total Drugs &nbsp;<?php echo $num_rows; ?></label>
        </div>
        <h6><i class="fas fa-pills" style="font-size: 22px;"></i>&nbsp;&nbsp; Manage Drugs</h6>
    </div>
    <div style="padding: 15px;">
        <div class="searchContainer">
            <div class="searchingDataIcon"><img src="images/icons/lod.gif" height="20"></div>
            <label>Search:&nbsp;</label><input type="text" name="search" id="search" autocomplete="off">
        </div>
        <table class="table table-striped table-bordered table-hover nowrap" id="dataTable" style="color: teal">
            <thead style="font-size: 14px;">
                <th>S/n</th>
                <th>Drug Name</th>
                <th>Manufacture Date</th>
                <th>Expire Date</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Registration Date</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody style="font-size: 15px;">
                <?php
                while($row=mysqli_fetch_array($select))
                {
                    if($row['expire_date']<=date("Y-m-d"))
                    {
                        ?>
                        <tr style="background-color:#F1948A;">
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['drug_name']; ?></td>
                            <td><?php echo $row['manufacture_date']; ?></td>
                            <td><?php echo $row['expire_date']; ?></td>
                            <td><?php echo $row['quantity']." ".$row['quantity_type']; ?></td>
                            <td>Ths <?php echo number_format($row['price']); ?></td>
                            <td><?php echo $row['registration_date']; ?></td>
                            <td>Expired</td>
                            <td style="text-align: center;">
                                <label id="<?php echo $row['id'] ?>" class="labelAction" style="cursor: no-drop;"><i class="fas fa-cart-plus"></i></label>
                            </td>
                        </tr>
                        <?php
                    }
                    else if($row['quantity']<=0)
                    {
                        ?>
                            <tr style="background-color:#F5B041;">
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['drug_name']; ?></td>
                                <td><?php echo $row['manufacture_date']; ?></td>
                                <td><?php echo $row['expire_date']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>Ths <?php echo number_format(0); ?></td>
                                <td><?php echo $row['registration_date']; ?></td>
                                <td>Absent</td>
                                <td style="text-align: center;">
                                    <label id="<?php echo $row['id'] ?>" class="labelAction" style="cursor: no-drop;"><i class="fas fa-cart-plus"></i></label>
                                </td>
                            </tr>
                            <?php
                    }
                    else
                    {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['drug_name']; ?></td>
                            <td><?php echo $row['manufacture_date']; ?></td>
                            <td><?php echo $row['expire_date']; ?></td>
                            <td><?php 
                            if($row['updated_quantity']<=0)
                            {
                                echo $row['quantity']." ".$row['quantity_type']; 
                            }
                            else
                            {
                                echo $row['updated_quantity']." ".$row['quantity_type'];
                            }
                            ?></td>
                            <td>Ths <?php echo number_format($row['price']); ?></td>
                            <td><?php echo $row['registration_date']; ?></td>
                            <td></td>
                            <td style="text-align: center;">
                                <label id="<?php echo $row['id'] ?>" class="labelAction addToCart"><i class="fas fa-cart-plus"></i></label>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <input type="text" name="employeeId" id="employeeId" value="<?php echo $id; ?>" style="display: none;">
        <input type="text" name="token" id="token" value="<?php echo $token; ?>" style="display: none;">
    </div>
    <div class="displaAddProductToCartResult"></div>
<script type="text/javascript">
	$(document).ready(function () {
		$('#dataTables').DataTable();
		//-------------------------->>
		$('#dataTables2').DataTable();
		//---------------------->>
		$("#viewEquipments").on('click',function(){
			$(".drugs").hide();
			$(".equipments").slideDown("slow");
		});
		//---------------------->>
		$("#viewDrugs").on('click',function(){
			$(".drugs").slideDown("slow");
			$(".equipments").hide();
		});
		//---------------------->>
		$(".addToCart").click(function(){
			var drugId=$(this).attr("id");
			var employeeId=$("#employeeId").val();
            var token=$("#token").val();
			$.ajax({
				url:"ajax/ajaxAddProductToCart.php",
				method:"post",
				async:false,
				data:{
					"drugId":drugId,
					"employeeId":employeeId,
                    "token":token
				},
				success:function(data)
				{
					$(".displaAddProductToCartResult").html(data);
				}
			});
		});
        //---------------------------->>
        $("#search").keyup(function(){
            var search=$(this).val();
            var employeeId=$("#employeeId").val();
            var token=$("#token").val();
            $.ajax({
                url:"ajax/search/searchingDrug.php",
                type:"post",
                data:{search:search,employeeId:employeeId,token:token},
                success:function(data)
                {
                    $(".searchingDataIcon").show();
                    setTimeout(function(){
                        $(".searchingDataIcon").hide();
                        $("#dataTable").html(data);
                    },1000);
                }
            });
        });
	});
</script>