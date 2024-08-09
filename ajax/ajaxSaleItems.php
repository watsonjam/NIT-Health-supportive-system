<style type="text/css">
	.salesOverViewMainCont2{position: fixed;height: 100%;top: 0px;width: 100%;left: 0px;background-color: rgba(0,0,0,.3);z-index: 20;display: block;}
	.salesOverViewSubCont
	{margin-top: 1%;width: 70%;background-color: white;box-shadow: 0px 20px 10px rgba(0,0,0,.4);border:1px solid silver;border-radius: 3px;}
	.salesOverViewThirdCont{overflow-y: scroll;padding: 20px;height: 630px;}
	.salesOverViewThirdCont::-webkit-scrollbar{width: 7px;margin: 10px;}
    .salesOverViewThirdCont::-webkit-scrollbar-track{background:transparent;}
    .salesOverViewThirdCont::-webkit-scrollbar-thumb{background:silver;border-radius: 10px;}
    .salesOverViewThirdCont::-webkit-scrollbar-thumb:hover{background:gray;}
</style>
<?php
//including database connection
include("db_connection/db_connection.php");

$pharmacistId=$_POST['pharmacistId'];

if(empty($_POST['clientName']))
{
	?>
	<style type="text/css">
		#clientName{border-color:red;box-shadow: 0px 0px 2px 0px red;}
		.error1{display: block;}
        .prepareSaleCont{border-color:red;box-shadow: 0px 0px 20px 0px red inset;}
        .prepareSaleCont{animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;transform: translate3d(0, 0, 0);backface-visibility: hidden;perspective: 1000px;
		}
		@keyframes shake {10%, 90% {transform: translate3d(-15px, 0, 0);}20%, 80% {transform: translate3d(20px, 0, 0);}30%, 50%, 70% {transform: translate3d(-24px, 0, 0);}40%, 60% {transform: translate3d(24px, 0, 0);}
		}
	</style>
    <script type="text/javascript">
        $('.salesOverViewThirdCont').animate({scrollTop:0}, '800');
    </script>
	<?php
}
else
{
	if(strlen($_POST['clientName'])<5)
	{
		?>
		<style type="text/css">
			#clientName{border-color:red;box-shadow: 0px 0px 2px 0px red;}
			.error2{display: block;}
            .prepareSaleCont{border-color:red;box-shadow: 0px 0px 20px 0px red inset;}
            .prepareSaleCont{animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;transform: translate3d(0, 0, 0);backface-visibility: hidden;perspective: 1000px;
            }
            @keyframes shake {10%, 90% {transform: translate3d(-15px, 0, 0);}20%, 80% {transform: translate3d(20px, 0, 0);}30%, 50%, 70% {transform: translate3d(-24px, 0, 0);}40%, 60% {transform: translate3d(24px, 0, 0);}
            }
		</style>
        <script type="text/javascript">
            $('.salesOverViewThirdCont').animate({scrollTop:0}, '800');
        </script>
		<?php
	}
	else
	{
		$select=mysqli_query($conn,"select * from cart where pharmacistId='$pharmacistId'");
		while($row=mysqli_fetch_array($select))
		{
			$itemId=$row['drugId'];
			$pharmacistId=$row['pharmacistId'];
			$sellerName=$_POST['sellerName'];
			$clientName=$_POST['clientName'];
			$itemName=$row['drug_name'];
			$quantity=$row['quantity'];
			$price=$row['price'];
            $profit=$row['profit'];
            $total_profit=$row['total_profit'];
			$total_price=$row['total_price'];
			$date=date("Y-m-d");
            $date2=date("M-Y");
			$time=date("h:i a");
            $month=date("F");
            $year=date("Y");
            $timestamp=date("d-m-Y h:i A");

			$selectId=mysqli_query($conn,"select id from sales order by id desc");
			$row2=mysqli_fetch_array($selectId);
			$id=$row2[0]+1;

			$insert=("insert into sales(id,itemId,pharmacistId,seller_name,customer_name,item_name,quantity,price,profit,total_profit,total_price,date_sale,date_sale2,month,year,time_sale,timestamp,status) values('$id','$itemId','$pharmacistId','$sellerName','$clientName','$itemName','$quantity','$price','$profit','$total_profit','$total_price','$date','$date2','$month','$year','$time','$timestamp','New')");
			$result=mysqli_query($conn,$insert);
			if($result)
			{
				$delete=mysqli_query($conn,"delete from cart where pharmacistId='$pharmacistId'");
    			$getid=mysqli_query($conn,"select id from payment_receipt order by id desc");
                $rowId=mysqli_fetch_array($getid);
                $id=$rowId[0]+1;
                $pharmacistId=$pharmacistId;
                $receipt_no=rand(999999,9999999);
                $paymentDate=date("d/M/Y");
                $reference_no=rand(99999999,999999999).rand(999999,9999999);
                $payment_for="Sales Drugs";
                $in_respect_of="G190621-3638";
                $timestamp=date("d-m-Y h:i A");

                $insert2=mysqli_query($conn,"insert into payment_receipt(id,pharmacistId,clientName,receipt_no,reference_no,payment_for,in_respect_of,paymentDate,date_sale,time_sale,timestamp) values('$id','$pharmacistId','$clientName','$receipt_no','$reference_no','$payment_for','$in_respect_of','$paymentDate','$date','$time','$timestamp')");
			}
            $select2=mysqli_query($conn,"select * from drugs where id='$itemId'");
            $row3=mysqli_fetch_array($select2);
            $updated_quantity=$row3['updated_quantity'];

            mysqli_query($conn,"update drugs set quantity='$updated_quantity',updated_quantity='0' where id='$itemId'");
		}
        $date=date("Y-m-d");
        $time=date("h:i a");
        $clientName=$_POST['clientName'];
        $selectRepDetails_p=mysqli_query($conn,"select * from payment_receipt where pharmacistId='$pharmacistId' and clientName='$clientName' and date_sale='$date' and time_sale='$time'");
        $rws_qr=mysqli_fetch_array($selectRepDetails_p);
        //--------------------------------------->>
        $selectRepDetails=mysqli_query($conn,"select * from sales where pharmacistId='$pharmacistId' and customer_name='$clientName' and date_sale='$date' and time_sale='$time'");
        $roows=mysqli_fetch_array($selectRepDetails);
        ?>
        <div class="salesOverViewMainCont2">
            <div class="salesOverViewSubCont">
                <div id="loadingCont">
                    <div id="allCont"  style="height: 370px;">
                        <div id="firstPrss">
                            <div style="margin-top: 220px;"><center><img src="images/icons/lod.gif" height="80" width="80"> <label style="font-weight: bolder;margin-left: 20px;font-size: 24px;">Preparing Receipt ..... </label></center></div>
                        </div>
                         <div style="display: none;" id="secondPrss">
                            <div style="margin-top: 220px;"><center><img src="images/icons/progress.gif" height="80" width="80"> <label style="font-weight: bolder;margin-left: 20px;font-size: 24px;">Processing ..... </label></center></div>
                        </div>
                    </div>
                </div>
                <div style="display: none;" id="receiptCont">
                        <div style="padding: 6px;border-bottom: 1px solid silver;margin-bottom: 20px;">
                            <div style="float:right;">
                                <label style="cursor: pointer;color: darkslategray"><i class="fas fa-print" id="printBtn"></i></label>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                <label style="cursor: pointer;color: darkslategray"><i class="fas fa-download"></i></label>
                                &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                <label style="font-size: 18px;color: darkslategray;cursor: pointer;" id="closeCont2"><i class="fas fa-times"></i></label>
                            </div>
                            <h5>Payment receipt</h5>
                        </div>
                    <div class="salesOverViewThirdCont" id="salesOverViewThirdCont">
                        <div style="display: inline-block;">
                            <img src="images/icons/company_logo.png" height="60">
                            <div style="display: inline-block;margin-left: 3px;vertical-align: top;">
                                <h5 style="margin-top: 6px;">NIT Health Supportive System</h5>
                                <label style="font-size: 14px;margin-left: 0px">Good Treatment for Good Health</label>
                            </div>
                        </div>
                        <div style="display: inline-block;vertical-align: top;margin-left: 200px;">
                            <div><label style="font-weight: bold;">PHONE: </label>+255 677436278</div>
                            <div><label style="font-weight: bold;">FAX: </label>+255 2221 2180371</div>
                            <div><label style="font-weight: bold;">EMAIL: </label>nitsupportivesystem@gmail.com</div>
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
                                    <label style="font-weight: bolder;">Receipt number: &nbsp;&nbsp;</label><?php echo $rws_qr['receipt_no']; ?>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label style="font-weight: bolder;">Payment date: &nbsp;&nbsp;</label><?php echo $rws_qr['paymentDate']; ?>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label style="font-weight: bolder;">Reference number: &nbsp;&nbsp;</label><?php echo $rws_qr['reference_no']; ?>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label style="font-weight: bolder;">Payment for: &nbsp;&nbsp;</label><?php echo $rws_qr['payment_for']; ?>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label style="font-weight: bolder;">In respect of: Application&nbsp;&nbsp;</label><?php echo $rws_qr['in_respect_of']; ?>
                                </div>
                            </div>
                            <?php
                                $totalAmnt=0;
                                $select=mysqli_query($conn,"select * from sales where pharmacistId='$pharmacistId' and customer_name='$clientName' and date_sale='$date' and time_sale='$time'");
                                while($rws_s=mysqli_fetch_array($select))
                                {
                                    $totalAmnt+=$rws_s['total_price'];
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
                                        $select=mysqli_query($conn,"select * from sales where pharmacistId='$pharmacistId' and customer_name='$clientName' and date_sale='$date' and time_sale='$time'");
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
}
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#closeCont2").click(function(){
            window.location.reload();
        });
        //----------------------------------->>
        $("#printBtn").click(function(){
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
    });
    $("#prepareRecpt").click(function(){
    	$(".hoverCont").hide();
    	$(".salesOverViewMainCont2").show();
    });
    //-------------------------->>
    function showReceipt()
    {
        document.getElementById('loadingCont').style.display="none";
        document.getElementById('receiptCont').style.display="block";
        document.getElementById('allCont').style.display="none";
        document.getElementById('loadingCont').style.height="0px";
    }
    setTimeout("showReceipt()",10000);
    //--------------------->>
    function showSecondProcess()
    {
        document.getElementById('firstPrss').style.display="none";
        document.getElementById('secondPrss').style.display="block";
    }
    setTimeout("showSecondProcess()",3000);
</script>