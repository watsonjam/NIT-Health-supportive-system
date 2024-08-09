<?php
include("db_connection/db_connection.php");

$search=$_POST['search'];
$employeeId=$_POST['employeeId'];
$token=$_POST['token'];
$select=mysqli_query($conn,"select * from drugs where drug_name like '%$search%'");
$num_rows=mysqli_num_rows($select);
if($num_rows<=0)
{
    ?>
    <div style="margin:20px;color:#E74C3C;font-weight:500">
        <center><label>No matching records found</label></center>
    </div>
    <?php
}
else
{
?>
<table class="table table-bordered table-hover nowrap drugTable" id="dataTable" style="color: teal">
    <thead style="font-size: 14px;">
        <th>Select</th>
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
        $i=1;
        while($row=mysqli_fetch_array($select))
        {
            if($row['expire_date']<=date("Y-m-d"))
            {
                ?>
                <tr style="background-color:#F1948A;">
                    <td>
                        <input id="checksBox-<?php echo $i; ?>" class="checkbox-custom" name="chckbox[]" type="checkbox" value="<?php echo $row['id']; ?>" style="cursor: no-drop;" disabled> 
                        <label for="checksBox-<?php echo $i; ?>" class="checkbox-custom-label" style="cursor: no-drop;"></label>
                    </td>
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
                        <td>
                            <input id="checksBox-<?php echo $i; ?>" class="checkbox-custom" name="chckbox[]" type="checkbox" value="<?php echo $row['id']; ?>" style="cursor: no-drop;" disabled> 
                        <label for="checksBox-<?php echo $i; ?>" class="checkbox-custom-label" style="cursor: no-drop;"></label>
                        </td>
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
                <tr id="tr_cart">
                    <td id="td">
                        <input id="checksBox-<?php echo $i; ?>" class="checkbox-custom checkItems" name="chckbox[]" type="checkbox" value="<?php echo $row['id']; ?>"> 
                        <label for="checksBox-<?php echo $i; ?>" class="checkbox-custom-label"></label>
                    </td>
                    <td id="td"><?php echo $row['id']; ?></td>
                    <td id="td"><?php echo $row['drug_name']; ?></td>
                    <td id="td"><?php echo $row['manufacture_date']; ?></td>
                    <td id="td"><?php echo $row['expire_date']; ?></td>
                    <td id="td"><?php 
                    if($row['updated_quantity']<=0)
                    {
                        echo $row['quantity']." ".$row['quantity_type']; 
                    }
                    else
                    {
                        echo $row['updated_quantity']." ".$row['quantity_type'];
                    }
                    ?></td>
                    <td id="td">Ths <?php echo number_format($row['price']); ?></td>
                    <td id="td"><?php echo $row['registration_date']; ?></td>
                    <td id="td"><?php echo $row['status']; ?></td>
                    <td id="td" style="text-align: center;">
                        <label id="<?php echo $row['id'] ?>" class="labelAction addToCart"><i class="fas fa-cart-plus"></i></label>
                    </td>
                </tr>
                <?php
            }
            $i++;
        }
        ?>
        <input type="text" id="employeeId" name="employeeId" value="<?php echo $employeeId; ?>" style="display:none">
        <input type="text" id="token" name="token" value="<?php echo $token; ?>" style="display:none">
    </tbody>
</table>
<div class="displaAddProductToCartResult"></div>
<?php
}
?>
<script>
    $(".addToCart2").click(function(){
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
</script>



