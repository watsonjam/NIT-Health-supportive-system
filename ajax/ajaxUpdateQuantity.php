<?php
include("db_connection/db_connection.php");
//------------------------------------->.
if(isset($_POST['itemId']))
{
    $drugId=$_POST['itemId'];
    $employeeId=$_POST['employeeId'];
    $quantity=$_POST['quantity'];
    $error="";
    if(empty($quantity))
    {
        ?>
        <script>
            $(".error").html("*quantity can't be empty");
        </script>
        <?php
    }
    else
    {
        if($quantity<0)
        {
            ?>
            <script>
                $(".error").html("*quantity can't be less than 0");
            </script>
            <?php
        }
        else
        {
            
            if(preg_match_all('/^[0-9]+$/',$quantity))
            {
            	$select2=mysqli_query($conn,"select * from drugs where id=$drugId");
                $row2=mysqli_fetch_array($select2);
                $qnty=$row2['quantity'];
                if($quantity>$qnty)
                {
                    ?>
                    <script>
                        $(".error").html("*quantity can't be greater than <?php echo $qnty; ?>");
                    </script>
                    <?php
                }
                else if($qnty>$quantity)
                {
                	$update=("update cart set quantity='$quantity' where drugId=$drugId and pharmacistId='$employeeId'");
                    $result=mysqli_query($conn,$update);
                    if($result)
                    {
                        //update quantity
                        $select=mysqli_query($conn,"select * from cart where drugId=$drugId and pharmacistId='$employeeId'");
                        $row=mysqli_fetch_array($select);
                        $price=$row['price'];
                        $profit=$row['profit'];
                        //----------------->>
                        //----------------->>
                        //update price when quanity change
                        for($i=0;$i<$quantity;$i++)
                        {
                            $total=$quantity*$price;
                        }
                        $profit=$quantity*$profit;
                        $total_quantity=$qnty-$quantity;
                        $update2=mysqli_query($conn,"update cart set total_price='$total',total_profit='$profit' where drugId=$drugId and pharmacistId='$employeeId'");
                        $update=mysqli_query($conn,"update drugs set updated_quantity='$total_quantity' where id='$drugId'");
                        ?>
                        <script>
                            $("#load").show();
                            $(".error").html("");
                            $("#prodName").hide();
                            $("#notfy").show();
                            $("#qnty").html("Quantity: &nbsp;<strong><?php echo $quantity; ?></strong>");
                            setTimeout(function(){
                                $("#updateCont").hide();
                                $("#viewCart").show();
                            },2000);
                        </script>
                        <?php
                        
                    }
                }
                else{
                	$update=("update cart set quantity='$quantity' where drugId=$drugId and pharmacistId='$employeeId'");
                    $result=mysqli_query($conn,$update);
                    if($result)
                    {
                        //update quantity
                        $select=mysqli_query($conn,"select * from cart where drugId=$drugId and pharmacistId='$employeeId'");
                        $row=mysqli_fetch_array($select);
                        $price=$row['price'];
                        $profit=$row['profit'];
                        //----------------->>
                        //----------------->>
                        //update price when quanity change
                        for($i=0;$i<$quantity;$i++)
                        {
                            $total=$quantity*$price;
                        }
                        $profit=$quantity*$profit;
                        $total_quantity=$qnty-$quantity;
                        $update2=mysqli_query($conn,"update cart set total_price='$total',total_profit='$profit' where drugId=$drugId and pharmacistId='$employeeId'");
                        $update=mysqli_query($conn,"update drugs set updated_quantity='$total_quantity' where id='$drugId'");
                        ?>
                        <script>
                            $("#load").show();
                            $(".error").html("");
                            $("#prodName").hide();
                            $("#notfy").show();
                            $("#qnty").html("Quantity: &nbsp;<strong><?php echo $quantity; ?></strong>");
                            setTimeout(function(){
                                $("#updateCont").hide();
                                $("#viewCart").show();
                            },2000);
                        </script>
                        <?php
                    }
                }
            }
            else{
                ?>
                <script>
                    $(".error").html("*quantity accept only numbers");
                </script>
                <?php
            }
        }
    }
}
if(isset($_POST['itmId']))
{
    $itmId=$_POST['itmId'];
    mysqli_query($conn,"delete from cart where drugId='$itmId'");
}
?>