<div class="sidebar-container">
    <div class="sidebar-header">
        <img src="../../public/root/img/icon1.png" alt="">
        <div>
            <h3>ConSpring</h3>
            <h4>Conalum Water Billing and Collection System</h4>    
        </div>
    </div>
    <?php if(Data::unload("user-type") == "administrator"){ ?>
        <h5 class="sidebar-user admin-header"><span class="fa fa-shield"></span> Administrator</h5>
    <?php }else{ ?>
        <h5 class="sidebar-user treasurer-header"><span class="fa fa-bank"></span> Treasurer</h5>
    <?php }?>
    
    <a href="AdminDashboard" class="<?php if(Data::unload("admin-location") == "AdminDashboard"){ echo "isActive"; }?>"><span class="fa fa-dashboard"></span> Dashboard</a>
    <a class="<?php if(Data::unload("admin-location") == "AdminCustomerList"){ echo "isActive"; }?>" onclick="menu('customermenu')" href="#"><span class="fa fa-users"></span> Customer <span style="right: 10px; position: absolute">-</span></a>
    <div class="menu" id="customermenu" style="display: none">
        <a style="display: block" href="#" data-toggle="modal" data-target="#addcustomer"><span class="fa fa-plus"></span> Add New Customer</a>
        <a href="AdminCustomerList"><span class="fa fa-user"></span> Customer List</a>
        <a href="AdminSendMessage"><span class="fa fa-envelope"></span> Send Message</a>
    </div>
    <a class="<?php if(Data::unload("admin-location") == "AdminBillingRecord"){ echo "isActive"; }?>" onclick="menu('billingmenu')" href="#"><span class="fa fa-book"></span> Billing <span style="right: 10px; position: absolute">-</span></a>
    <div class="menu" id="billingmenu" style="display: none">
        <a href="#" data-toggle="modal" data-target="#addbilling"><span class="fa fa-plus"></span> Add New Billing Period</a>
        <a href="AdminBillingRecord"><span class="fa fa-book"></span> Billing Records</a>
    </div>
    <a class="<?php if(Data::unload("admin-location") == "AdminReport"){ echo "isActive"; }?>" href="AdminReport"><span class="fa fa-line-chart"></span> Reports</a>
    <a data-toggle="modal" data-target="#manageaccount" href="#"><span class="fa fa-gears"></span> Account Management</a>
    <a data-toggle="modal" data-target="#logout" href="#"><span class="fa fa-sign-out"></span> Logout</a>
</div>