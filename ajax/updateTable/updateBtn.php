<?php
include("db_connection/db_connection.php");

$employeeId=$_POST['emplyId'];
?>
<input type="text" name="employeeId" id="employeeId" value="<?php echo $employeeId; ?>" style="display: none;">
<div style="float: right;" class="btnCont" id="btnCont">
    <?php
        $select=mysqli_query($conn,"select * from employee where id='$employeeId'");
        $row=mysqli_fetch_array($select);
        ?>
        <button id="btn1" class="deleteContr"><i class="far fa-trash-alt"></i>&nbsp;Delete</button>
        <?php
        if ($row['account'] !=="blocked") {
        ?>
            <button id="btn2" class="blockPhacyst"><i class="fas fa-minus-circle"></i>&nbsp;Block Account</button>
        <?php
        }
        else
        {
        ?>
            <button id="btn2" class="unblockPhacyst" style="background-color:#2ECC71;border:1px solid #2ECC71">Unblock Account</button>
        <?php
        }
    ?>
</div>
<script>
    $(".blockPhacyst").click(function(){
        var employeeId=$("#employeeId").val();
        $.ajax({
            url:"ajax/ajaxDeleteAndBlock.php",
            method:"post",
            data:{"employeeId":employeeId},
            success:function(data)
            {
                $(".displayResultCont").html(data);
            }
        });
    });
    //---------------------------->>
    $(".unblockPhacyst").click(function(){
        var employeeId2=$("#employeeId").val();
        $.ajax({
            url:"ajax/ajaxDeleteAndBlock.php",
            method:"post",
            data:{"employeeId2":employeeId2},
            success:function(data)
            {
                $(".displayResultCont").html(data);
            }
        });
    });
</script>