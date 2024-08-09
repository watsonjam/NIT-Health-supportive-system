<?php
$select=mysqli_query($conn,"select * from doctors where id='$id'");
$row=mysqli_fetch_array($select);
//----------------------------------->>

?>
<style>
    .active a{background-color: #1C2833;color: white;}
    .active a:before{content: '';display: inline-block;height: 49px;width: 5px;background-color: #E74C3C;position: absolute;left: 0px;margin-top: -11px;}
    .active a:after{font-family: 'Font Awesome 5 Free';font-weight: 900;content: '\f0da';display: inline-block;position: absolute;left: 4px;color: #E74C3C;font-size: 19px;margin-top: -1px;}
    .asideDivControl a{border-bottom: 1px solid #1C2833;}
    .asideDivControl a i{font-size: 13px;}
    .asideMainContainer{background-color: #000E1C;height: 100%;}
    .asideDivControl a label{font-size: 13px;}
    .asideDivControl a:hover{background-color:#1C2833;color: white;}
    .asideDivControl a:active{background-color: transparent;color: darkslategray;}
    .emptyCont{margin-top: 45%;font-weight: 500;letter-spacing: 0.5px;color:darkslategray;font-size: 15px;opacity: 0.3;}
    .activeClass{color: darkslategray;}
    .onlineUser{margin:10px;color: silver;font-size: 13px;}
    .onlineUser label{display: inline-block;padding: 5px;background-color: #5CD806;border-radius: 100px;margin-top: 5px;}
    .onlineUser2{display: inline-block;vertical-align: top;margin-left: -14px;margin-top: 26px;}
    .onlineUser2 label{display: inline-block;padding: 5px;background-color:#5CD806;border-radius: 100px;border: 2px solid white;}
    .recentltyChartContainer{position: fixed;top: 20px;width:30%;background-color: #D5F5E3;z-index: 100;color:darkslategrey;left: 270px;border-radius: 2px;box-shadow: 0px 0px 40px 0px rgba(0,0,0,.8);display: none;}
    .recentltyChartContainer:before{font-family: 'Font Awesome 5 Free';font-weight: 900;content: '\f0d9';position: absolute;margin-left: -9px;font-size: 27px;top:470px;color: #D5F5E3;}
    .bar{top:20px;position: fixed;font-size: 25px;margin-left: 10px;cursor: pointer;z-index: 100;}
    .asideCont2{z-index: 200;display: none;width: 60%;}
    .closeAside{margin: 10px 30px;font-size: 25px;cursor: pointer;}
    .closeAside:active{color: transparent;}
</style>

<aside>
    <label class="bar"><i class="fas fa-bars"></i></label>
    <div class="asideMainContainer">
        <div class="onlineUser">
            <label></label><div style="display: inline-block;vertical-align: top;margin-left:5px;"><span>Online</span>
            </div>
        </div>
        <div style="width: 100%;border:0.5px solid #1C2833;margin-top: 10px;"></div>
        <div style="background-color:blue; class="asideSubContainer"  id="asideContainer">
            <div " class="asideDivControl">
                <a href="doctor_darshbord?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-tachometer-alt"></i><label>Darshbord</label></a>
            </div>
            <div class="asideDivControl">
                 <div class="notification newAppo"></div>
                <a href="appointment?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-eye"></i><label>View Appointment</label></a>
            </div>
            <div class="asideDivControl">
                <a href="approved_appointment?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-check"></i><label>Approved Appointment</label></a>
            </div>
            <div class="asideDivControl">
                <div class="displayNewSales"></div>
                <a href="drugs_d?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-eye"></i><label>View Drugs</label></a>
            </div>                         
            <div class="asideDivControl">
                <div class="displayNewSales"></div>
                <a href="comments?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-envelope"></i><label>Users Comments</label></a>
            </div>
            <div class="asideDivControl">
                <div class="displayNewSales"></div>
                <a href="d_setting?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-cog"></i><label>Setting</label></a>
            </div>
            <div class="asideDivControl">
                <div class="displayNewSales"></div>
                <a href="anny?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-bars"></i><label>Analytics</label></a>
            </div>
            <div class="asideDivControl">
                <a href="doctor_profile?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-user"></i><label>My Profile</label></a>
            </div>
             <input type="text" name="doctorId" id="doctorId" value="<?php echo $row['id']; ?>" style="display: none;">
            <footer>
                <div style="margin-top: 160px;">
                    <?php
                    include("includes/footer2.php");
                    ?>
                </div>
            </footer>
        </div>
    </div>
    <div class="asideMainContainer asideCont2">
        <div style="float: right;">
            <label class="closeAside"><i class="fas fa-times"></i></label>
        </div>
        <div class="onlineUser">
            <label></label><div style="display: inline-block;vertical-align: top;margin-left:5px;"><span>Online</span>
            </div>
        </div>
        <div style="width: 100%;border:0.5px solid #1C2833;margin-top: 10px;"></div>
        <div class="asideSubContainer"  id="asideContainer">
            <div class="asideDivControl">
                <a href="doctor_darshbord?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-tachometer-alt"></i><label>Darshbord</label></a>
            </div>
            <div class="asideDivControl">
                <div class="notification newAppo"></div>
                <a href="appointment?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-eye"></i><label>View Appointment</label></a>
            </div>
            <div class="asideDivControl">
                <a href="approved_appointment?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-check"></i><label>Approved Appointment</label></a>
            </div>
            <div class="asideDivControl">
                <div class="displayNewSales"></div>
                <a href="drugs_d?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-eye"></i><label>View Drugs</label></a>
            </div>
            <div class="asideDivControl">
                <div class="displayNewSales"></div>
                 <a href="generate_report?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-file-alt"></i><label>Generate Report</label></a>
            </div>
            <div class="asideDivControl">
                <div class="displayNewSales"></div>
                <a href="my_report?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-file-alt"></i><label>My Report</label></a>
            </div>
            <div class="asideDivControl">
                <div class="displayNewSales"></div>
                <a href="comments?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-envelope"></i><label>Users Comments</label></a>
            </div>
             <div class="asideDivControl">
                <div class="displayNewSales"></div>
                <a href="d_setting?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-cog"></i><label>Setting</label></a>
            </div>
            <div class="asideDivControl">
                <a href="doctor_profile?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-user"></i><label>My Profile</label></a>
            </div>
             <input type="text" name="doctorId" id="doctorId" value="<?php echo $row['id']; ?>" style="display: none;">
            <footer>
                <div style="margin-top: 160px;">
                    <?php
                    include("includes/footer2.php");
                    ?>
                </div>
            </footer>
        </div>
    </div>
</aside>
<script type="text/javascript">
    $(document).ready(function(){
        //active class
        $(function(){
            $('#asideContainer a').filter(function(){
                return this.href==location.href;
            }).parent().addClass('active').siblings().removeClass('active');
            $('#asideContainer a').click(function(){
                $(this).parent().addClass('active').siblings().removeClass('active');   
            });
        });
        ///////////////////////////////////////////////////////////
        $("#changePicture").on('click',function(){
            $(".uploadPicture").css("display","block");
        });
        ////////////////////////////////////
        $(".bar").click(function(){
            $(".asideCont2").show(700);
        });
        $(".closeAside").click(function(){
            $(".asideCont2").hide(700);
        });
        //--------------------------->>
        setInterval(function(){
            var doctorId=$("#doctorId").val();
            $.ajax({
                url:"ajax/load/loadInfo.php",
                method:"post",
                data:{doctorId:doctorId},
                success:function(data)
                {
                    $(".newAppo").html(data);
                }
            });
        },200);
    });
</script>




