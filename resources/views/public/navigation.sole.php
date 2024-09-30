<div class="sidebar-container">
    <div class="sidebar-header">
        <img src="../../public/root/img/icon1.png" alt="">
        <div>
            <h3>ConSpring</h3>
            <h4>Conalum Water Billing and Collection System</h4>    
        </div>
    </div>
    <h5 class="sidebar-user treasurer-header"><span class="fa fa-user"></span> <?php echo Data::unload("user-data")[0]['name']; ?></h5>
    
    <a href="UserDashboard" class="<?php if(Data::unload("user-location") == "UserDashboard"){ echo "isActive"; }?>"><span class="fa fa-dashboard"></span> Dashboard</a>
    <a href="UserPaymentRecord"  class="<?php if(Data::unload("user-location") == "UserPaymentRecord"){ echo "isActive"; }?>"><span class="fa fa-book"></span> Payment Records</a>
    <a href="UserMessage"  class="<?php if(Data::unload("user-location") == "UserMessage"){ echo "isActive"; }?>"><span class="fa fa-envelope"></span> Messages</a>
    <a data-toggle="modal" data-target="#manageaccount" href="#"><span class="fa fa-gears"></span> Account Management</a>
    <a data-toggle="modal" data-target="#logout" href="#"><span class="fa fa-sign-out"></span> Logout</a>
</div>