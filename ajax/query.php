<style type="text/css">
    .salesOverViewMainCont2{position: fixed;height: 100%;top: 0px;width: 100%;left: 0px;background-color: rgba(0,0,0,.3);z-index: 20;display: block;}
    .salesOverViewSubCont{margin-top: 1%;width: 70%;background-color: white;box-shadow: 0px 20px 10px rgba(0,0,0,.4);border:1px solid silver;border-radius: 3px;}
    .salesOverViewThirdCont{overflow-y: scroll;padding: 20px;height: 680px;}
    .salesOverViewThirdCont::-webkit-scrollbar{width: 7px;margin: 10px;}
    .salesOverViewThirdCont::-webkit-scrollbar-track{background:transparent; }
    .salesOverViewThirdCont::-webkit-scrollbar-thumb{background:silver;border-radius: 10px;}
    .salesOverViewThirdCont::-webkit-scrollbar-thumb:hover{background:gray; }
    .hoverContainer{position: fixed;width: 100%;top: 0px;left: 0px;float: none;margin: 0px;height: 100%;background-color: rgba(0,0,0,.1);z-index: 100;}
    .deleteConfirmation{width: 40%;background-color: white;box-shadow:0px 30px 15px rgba(0,0,0,.6);margin-top: 7%;border-radius: 4px;box-sizing: content-box;position: relative;animation: 1s deleteConfirmation}
    @keyframes deleteConfirmation{from{top:-300px;opacity: 0px;}to{top:0px;opacity: 1}}
    .hoverContainer{position: fixed;width: 100%;top: 0px;left: 0px;float: none;margin: 0px;height: 100%;background-color: rgba(0,0,0,.1);z-index: 100; overflow-y: scroll;}
    .viewAppointmentContainer{width: 50%;background-color: white;box-sizing: content-box;border:1px solid silver;box-shadow: 0px 0px 30px 0px rgba(0,0,0,.4);border-radius: 4px;margin-top: 1%;}
</style>
<?php
include("db_connection/db_connection.php");
//--------------------------------------->>
if(isset($_POST['saleId2']))
{
    $saleId2=$_POST['saleId2'];
    $selectRepDetails=mysqli_query($conn,"select * from payment_receipt where timestamp='$saleId2'");
    $rws=mysqli_fetch_array($selectRepDetails);
    //--------------------------------------->>
    $selectRepDetails=mysqli_query($conn,"select * from sales where timestamp='$saleId2'");
    $roows=mysqli_fetch_array($selectRepDetails);
    ?>
    <div class="salesOverViewMainCont2">
            <div class="container salesOverViewSubCont">
                <div>
                    <div style="padding: 6px;border-bottom: 1px solid silver;margin-bottom: 20px;">
                        <div style="float:right;">
                            <label style="cursor: pointer;color: darkslategray" class="printBtn"><i class="fas fa-print"></i></label>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                            <label style="cursor: pointer;color: darkslategray"><i class="fas fa-download"></i></label>
                            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                            <label style="font-size: 18px;color: darkslategray;cursor: pointer;" class="text-danger closeReceiptCont"><i class="fas fa-times"></i></label>
                        </div>
                        <h5>Payment receipt</h5>
                    </div>
                    <div class="salesOverViewThirdCont" id="salesOverViewThirdCont">
                        <div style="display: inline-block;">
                            <img src="images/icons/company_logo.png" height="60">
                            <div style="display: inline-block;margin-left: 3px;vertical-align: top;">
                                <h5 style="margin-top: 6px;">NIT HEALTH SUPPORTIVE SYSTEM</h5>
                                <label style="font-size: 14px;margin-left: 0px">Good Medicine for Good health</label>
                            </div>
                        </div>
                        <div style="display: inline-block;vertical-align: top;margin-left: 200px;">
                            <div><label style="font-weight: bold;">PHONE: </label>+255 677436278</div>
                            <div><label style="font-weight: bold;">FAX: </label>+255 2221 2180371</div>
                            <div><label style="font-weight: bold;">EMAIL: </label>nithealth12@gmail.com</div>
                        </div>
                        <div style="margin-top: 20px;"><center><h5>Payment receipt</h5></center></div>
                        <div style="margin-left: 50px;width: 80%;">
                            <div>
                                <div>
                                    <label style="font-weight: bolder;">Seller Name: &nbsp;&nbsp;</label><?php echo $roows['seller_name']; ?>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label style="font-weight: bolder;">Customer Name: &nbsp;&nbsp;</label><?php echo $roows['customer_name']; ?>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label style="font-weight: bolder;">Receipt number: &nbsp;&nbsp;</label><?php echo $rws['receipt_no']; ?>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label style="font-weight: bolder;">Payment date: &nbsp;&nbsp;</label><?php echo $rws['paymentDate']; ?>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label style="font-weight: bolder;">Reference number: &nbsp;&nbsp;</label><?php echo $rws['reference_no']; ?>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label style="font-weight: bolder;">Payment for: &nbsp;&nbsp;</label><?php echo $rws['payment_for']; ?>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label style="font-weight: bolder;">In respect of: Application&nbsp;&nbsp;</label><?php echo $rws['in_respect_of']; ?>
                                </div>
                            </div>
                            <?php
                                $totalAmnt=0;
                                $select=mysqli_query($conn,"select * from sales where timestamp='$saleId2'");
                                while($rws=mysqli_fetch_array($select))
                                {
                                    $totalAmnt+=$rws['total_price'];
                                }
                                ?>
                            <div style="margin-top:20px;">
                                <h6>Items:</h6>
                                <table class="table table-bordered" style="color: darkslategray;">
                                    <thead>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select=mysqli_query($conn,"select * from sales where timestamp='$saleId2'");
                                        while($rows=mysqli_fetch_array($select))
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $rows['item_name']; ?></td>
                                                <td><?php echo $rows['quantity']; ?></td>
                                                <td>Ths <?php echo number_format($rows['price']); ?></td>
                                                <td>Tsh <?php echo number_format($rows['total_price']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div style="height: 20px;">
                                    <div style="float: right;font-weight: bold">Total: &nbsp;<label>Tsh <?php echo number_format($totalAmnt); ?> /=</label></div>
                                </div>
                                <hr><br>
                            </div>
                            <div style="margin-top:20px;">
                                <h6>Payment Info:</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <th style="width: 60%;">Fee</th>
                                        <th>Amount</th>
                                        <th>Currency</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 60%;">Drugs</td>
                                            <td><?php echo number_format($totalAmnt); ?></td>
                                            <td>TZS</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
}
///////////////////////////////////////////
if(isset($_POST['doctorName']))
{
    $doctorName=$_POST['doctorName'];
    $comment=$_POST['comment'];
    $username=$_POST['username'];
    $date=date("d/m/Y");
    $time=date("h:i a");
    $selectId=mysqli_query($conn,"select id from users_comment order by id desc");
    $rslt=mysqli_fetch_array($selectId);
    $id=$rslt[0]+1;
    $insert=("insert into users_comment(id,doctor_name,user_name,comment,status,date,time) values('$id','$doctorName','$username','$comment','New','$date','$time')");
    $query=mysqli_query($conn,$insert);
    if($query)
    {
        ?>
        <script type="text/javascript">
            $("#comment").val("");
        </script>
        <div style="color: #2f3a48;padding: 7px;background-color: #A9DFBF;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-top: 10px;border-radius: 4px;margin-bottom: 10px;"><i class="fas fa-check-circle" style="font-size: 18px;color: #229954;"></i>&nbsp;&nbsp;Comment Sending Successfully</div>
        <?php
    }
    else
    {
        ?>
        <div style="color: #2f3a48;padding: 7px;background-color: #d86363;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);margin-bottom:20px;"><i class="fas fa-exclamation-circle" style="font-size: 18px;color: #be1818"></i>&nbsp;&nbsp;prox error occur ! there problem on server</div>
        <?php
    }
}
//////////////////////////////////////////////////////////////
if(isset($_POST['commentId']))
{
    $commentId=$_POST['commentId'];
    ?>
    <div class="hoverContainer">
        <div class="container deleteConfirmation">
            <div style="padding: 10px;border-bottom:1px solid silver">
                <h5>Confirmation</h5>
            </div>
            <div style="padding: 20px;">
                <p>Are you sure you want to delete this comment</p>
                <div style="height: 50px;">
                    <div style="float: right;">
                        <button type="button" class="btn btn-info closeViewAppoCont"><i class="fas fa-times"></i>&nbsp;No</button>
                        <button type="button" class="btn btn-danger yesDltBtn"><i class="fas fa-check"></i>&nbsp;Yes</button>
                    </div>
                </div>
            </div>
            <input type="text" name="commentId2" id="commentId2" value="<?php echo $commentId; ?>" style="display: none;">
        </div>
    </div>
    <?php
}
////////////////////////////////////////////
if(isset($_POST['commentId2']))
{
    $commentId2=$_POST['commentId2'];
    mysqli_query($conn,"delete from users_comment where id='$commentId2'");
}
//-------------------------------------------->>
if(isset($_POST['adminId'])){
    $id = $_POST['adminId'];
    $oldpass = $_POST['oldPass'];
    $newpass = md5($_POST['newPass']);
    $l= mysqli_query($conn,"update admin set password = '$newpass' where id =$id");
    if($l){
?>
<div style="color: #2f3a48;padding: 7px;background-color: #A9DFBF;font-size: 13px;letter-spacing: 0.5px;box-shadow: inset 0px 0px 1px 1px rgba(0,0,0,.3);"><i class="fas fa-check-circle" style="font-size: 18px;color: #229954;"></i>&nbsp;&nbsp;Successfully changed
</div>
<?php
    }
}
if(isset($_POST['reportId']))
{
    $reportId=$_POST['reportId'];
    $selectDt=mysqli_query($conn,"select * from report where id='$reportId'");
    $nm_rw=mysqli_num_rows($selectDt);
    $rwData=mysqli_fetch_array($selectDt);
    ?>
    <div class="hoverContainer">
        <div class="container viewAppointmentContainer" style="margin-top: 1%;width: 60%;">
            <div id="loadContent">
                <div style="height: 370px;">
                    <div style="margin-top: 250px;">
                        <center><img src="images/icons/lod.gif" height="100" width="100"></center>
                    </div>
                </div>
            </div>
            <div style="display: none;" id="showContent">
                <div style="padding: 10px;border-bottom:1px solid silver">
                    <div style="float: right;cursor: pointer" class="text-danger closeViewAppoCont">
                        <i class="fas fa-times"></i>
                    </div>
                    <h5>Doctor Report</h5>
                </div>
                <div>
                    <div  style="padding: 20px;line-height:35px;">
                        <div style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,.5);padding: 10px">
                            <div>Doctor Name:&nbsp;&nbsp;<b><?php echo $rwData['doctor_name']; ?></b><span style="margin-left: 50px;"><?php echo $rwData['date']; ?>&nbsp;&nbsp; at &nbsp;&nbsp;<?php echo $rwData['time']; ?></span></div><hr>
                            <div style="padding: 10px;margin-left: 20px;">
                                <div><?php echo $rwData['report']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }
?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".closeReceiptCont").click(function(){$(".salesOverViewMainCont2").slideUp()});
        //------------------------------->>
        $(".closeViewAppoCont").on('click',function(){
            $(".hoverContainer").slideUp("slow");
        });
        //----------------------------------->>
        setTimeout(function(){
            $("#loadContent").hide(700);
            $("#showContent").show(700);
        },4000);
        //------------------------------------>>
        $(".printBtn").click(function(){
            $("#salesOverViewThirdCont").printThis({
                debug: false,               // show the iframe for debugging
                importCSS: true,            // import parent page css
                importStyle: false,         // import style tags
                printContainer: true,       // print outer container/$.selector
                loadCSS: "http://localhost/pharmacy%20system/bootstrap/css/bootstrap.min.css",                // path to additional css file - use an array [] for multiple
                pageTitle: "Payment Receipt",              // add title to print page
                removeInline: false,        // remove inline styles from print elements
                removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
                printDelay: 333,            // variable print delay
                header: null,               // prefix to html
                footer: null,               // postfix to html
                base: false,                // preserve the BASE tag or accept a string for the URL
                formValues: true,           // preserve input/form values
                canvas: false,              // copy canvas content
                doctypeString: '<!DOCTYPE html>', // enter a different doctype for older markup
                removeScripts: false,       // remove script tags from print content
                copyTagClasses: false,      // copy classes from the html & body tag
                beforePrintEvent: null,     // callback function for printEvent in iframe
                beforePrint: null,          // function called before iframe is filled
                afterPrint: null            // function called before iframe is removed
            });
        });
        $(".yesDltBtn").on('click',function(){
            var commentId2=$("#commentId2").val();
            $.ajax({
                url:"ajax/query.php",
                method:"post",
                data:{commentId2:commentId2},
                success:function()
                {
                    window.location.reload();
                }
            });
        });
    });
</script>