<?php
$select=mysqli_query($conn,"select * from admin");
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
    .asideDivControl_charting{padding-bottom: 10px;padding-left: 60px;background-color:#1C2833;display: none;}
    .asideDivControl_charting span{cursor: pointer;color: silver;font-size: 12px;letter-spacing: 0.5px;display: inline-block;padding: 5px;width: 100%;}
    .asideDivControl_charting span:hover{color: darkslategray;}
    .usersContainer{position: fixed;top: 20px;width:25%;background-color: white;z-index: 100;color:darkslategrey;left: 270px;border-radius: 2px;box-shadow: 0px 0px 40px 0px rgba(0,0,0,.8);display: none;}
    .usersContainer:before{font-family: 'Font Awesome 5 Free';font-weight: 900;content: '\f0d9';position: absolute;margin-left: -9px;font-size: 27px;top:511px;color: white;}
    .userSubContainer{padding-top: 30px;overflow: hidden;overflow-y: scroll;height: 580px;}
    .userSubContainer::-webkit-scrollbar{width: 8px;margin: 10px;}
    .userSubContainer::-webkit-scrollbar-track{background:transparent; }
    .userSubContainer::-webkit-scrollbar-thumb{background:#ddd;border-radius: 10px;}
    .userSubContainer::-webkit-scrollbar-thumb:hover{background:gray; }
    .userLink{padding: 7px;cursor: pointer;margin-left: 8px;}
    .userLink:hover{background-color: lavender;}
    .userLink:active{background-color: cadetblue;color:white;}
    .newMsgLink{padding: 7px;cursor: pointer;margin-left: 8px;}
    .newMsgLink:hover{background-color: #D7DBDD;}
    .newMsgLink:active{background-color: cadetblue;color:white;}
    .newSms{padding: 3px 6px;min-width: 25px;background-color: #2980B9;color: white;z-index: 20;text-align: center;border-radius: 100px;font-size: 13px;cursor: pointer;}
    .newSmsOverView{position: fixed;left:96px;margin-top: 2px;}
    .newSmsOverView2{position: absolute;left: 160px;margin-top: -5px;}
    .newMessageContainer{position: fixed;top: 20px;width:30%;background-color: #D5F5E3;z-index: 100;color:darkslategrey;left: 270px;border-radius: 2px;box-shadow: 0px 0px 40px 0px rgba(0,0,0,.8);display: none;}
    .newMessageContainer:before{font-family: 'Font Awesome 5 Free';font-weight: 900;content: '\f0d9';position: absolute;margin-left: -9px;font-size: 27px;top:434px;color: #D5F5E3;}
    .totalSms{float: right;margin-top: 4px;font-size: 12px;color: #02BE11;}
    .totalSms label{display: inline-block;padding: 2px 7px;background-color: #02BE11;color: white;border-radius: 100px;font-size: 11px;float: right;margin-top: 8px;margin-right: 10px;}
    .msgCont{font-size:12.5px;color:#2471A3;font-weight:500;letter-spacing:0.5px;margin-top:0px;height: 26px;padding: 5px 0px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
    .newMsgLinkSubCont{display:inline-block;vertical-align: top;font-size:14px;margin-left:10px;width: 58%;}
    .emptyCont{margin-top: 45%;font-weight: 500;letter-spacing: 0.5px;color:darkslategray;font-size: 15px;opacity: 0.3;}
    .activeClass{color: darkslategray;}
    .onlineUser{margin:10px;color: silver;font-size: 13px;}
    .onlineUser label{display: inline-block;padding: 5px;background-color: #5CD806;border-radius: 100px;margin-top: 5px;}
    .onlineUser2{display: inline-block;vertical-align: top;margin-left: -14px;margin-top: 26px;}
    .onlineUser2 label{display: inline-block;padding: 5px;background-color:#5CD806;border-radius: 100px;border: 2px solid white;}
    .recentltyChartContainer{position: fixed;top: 20px;width:30%;background-color: #D5F5E3;z-index: 100;color:darkslategrey;left: 270px;border-radius: 2px;box-shadow: 0px 0px 40px 0px rgba(0,0,0,.8);display: none;}
    .recentltyChartContainer:before{font-family: 'Font Awesome 5 Free';font-weight: 900;content: '\f0d9';position: absolute;margin-left: -9px;font-size: 27px;top:470px;color: #D5F5E3;}
    .msgCont2{font-size:12.5px;color:gray;letter-spacing:0.5px;margin-top:0px;height: 26px;padding: 5px 0px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
    .newMsgLinkSubCont2{display:inline-block;vertical-align: top;font-size:14px;margin-left:10px;width: 55%;}
    .totalSms2{float: right;font-size: 12px;color: #02BE11;margin-top: 26px;}
    .recMsgLink{padding: 7px;cursor: pointer;margin-left: 8px;}
    .recMsgLink:hover{background-color: #D7DBDD;}
    .recMsgLink:active{background-color: cadetblue;color:white;}
    .addClassCont{height: 600px;overflow: hidden;overflow-y: scroll;position: relative;}
    .addClassCont::-webkit-scrollbar{width: 6px;margin: 10px;}
    .addClassCont::-webkit-scrollbar-track{background:transparent;}
    .addClassCont::-webkit-scrollbar-thumb{background:grey;border-radius: 10px;}
    .addClassCont::-webkit-scrollbar-thumb:hover{background:gray;}
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
        <div class="asideSubContainer"  id="asideContainer">
            <div class="asideDivControl">
                <div class="loadNofication2"></div>
                <a href="darshbord?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-tachometer-alt"></i><label>Darshbord</label></a>
            </div>
            <div class="asideDivControl">
                <div class="loadNofication2"></div>
                <a href="create_user?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-user-plus"></i><label>Create New User</label></a>
            </div>
            <div class="asideDivControl">
                <div class="displayNewSales"></div>
                <a href="add_drugs?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-prescription-bottle-alt"></i><label>Add Drugs</label></a>
            </div>
            <div class="asideDivControl">
                <a href="manage_users?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fa fa-user-friends"></i><label>Manage Users</label></a>
            </div>
                <div class="asideDivControl">
                <a href="profile_admin?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-user"></i><label>My Profile</label></a>
            </div>
            <footer>
                <div style="margin-top: 460px;">
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
                <div class="loadNofication2"></div>
                <a href="darshbord?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-tachometer-alt"></i><label>Darshbord</label></a>
            </div>
            <div class="asideDivControl">
                <div class="loadNofication2"></div>
                <a href="create_user?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-user-plus"></i><label>Create New User</label></a>
            </div>
            <div class="asideDivControl">
                <div class="displayNewSales"></div>
                <a href="add_drugs?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-prescription-bottle-alt"></i><label>Add Drugs</label></a>
            </div>
            <div class="asideDivControl">
                <a href="manage_users?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fa fa-user-friends"></i><label>Manage Users</label></a>
            </div>
                <div class="asideDivControl">
                <a href="profile_admin?id=<?php echo $id; ?>&token=<?php echo $token; ?>"><i class="fas fa-user"></i><label>My Profile</label></a>
            </div>
            <footer>
                <div style="margin-top: 460px;">
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
    });
</script>




