<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConSpring | Admin Customer</title>
</head>
    <body>
        <?php Route::view_extend("administrator.navigation"); ?>
        <?php Route::view_extend("administrator.modal"); ?>
        <div class="admin-display-container">
            <div class="modal-body">
                <div class="pane-header sticky-top">
                    <h4>CUSTOMER RECORD | VIEW</h4>
                </div>
                <div id="customerrecord">
                    <div class="modal-header">
                        <h5><b>PERSONAL INFORMATION</b></h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><b>Name:</b> <?php echo $dd['customeraccounts'][0]["name"]; ?></h6>
                            </div>
                            <div class="col-md-6">
                                <h6><b>Contact No.:</b>  <?php echo $dd['customeraccounts'][0]["contactno"]; ?></h6>
                            </div>
                            <div class="col-md-6">
                                <h6><b>Purok No.:</b>  <?php echo $dd['customeraccounts'][0]["purokno"]; ?></h6>
                            </div>
                            <div class="col-md-6">
                                <h6><b>Connection Date:</b>  <?php echo $dd['customeraccounts'][0]["dateconnected"]; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="modal-header">
                        <h5><b>CREDENTIALS</b></h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-6">
                            <h6><b>Username:</b>  <?php echo $dd['customeraccounts'][0]["username"]; ?></h6>
                        </div>
                        <div class="col-md-6">
                            <h6><b>Password.:</b>  <?php echo $dd['customeraccounts'][0]["password"]; ?></h6>
                        </div>
                    </div>
                    <div class="modal-header">
                        <h5><b>BILLING INFORMATION</b></h5>
                    </div>
                    <div class="modal-body">
                        <?php if(count($dd['billingrecords'])){ ?>
                            <div class="col-md-6" style="display: flex">
                                <h6 class="mr-2 mt-1"><b>Billing Period:</b></h6>
                                <select name="" id="" onchange="billingrecordview(this.value)">
                                    <?php foreach($dd['billingrecords'] as $br){ ?>
                                        <?php foreach($dd['billingperiods'] as $bp){ ?>
                                            <?php if($br['bpid'] == $bp['id']){ ?>
                                                <option value="<?php echo $br['id']; ?>"><?php echo date("M d, Y", strtotime($bp["collection"])).' - '.date("M d, Y", strtotime($bp["due"])); ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 id="preading"><b>Previous Reading:</b> <?php echo $dd['billingrecords'][0]['preading'];?></h6>
                                    <h6 id="creading"><b>Current Reading:</b> <?php echo $dd['billingrecords'][0]['creading'];?></h6>
                                    <h6 id="used"><b>Used:</b> <?php echo $dd['billingrecords'][0]['used'];?></h6>
                                    <h6 id="amount"><b>Amount:</b> <?php echo $dd['billingrecords'][0]['amount'];?></h6>
                                </div>
                                <div class="col-md-5">
                                    <h6 id="status"><b>Status: </b> <?php echo $dd['billingrecords'][0]['status'];?></h6>
                                    <h6 id="datepaid"><b>Date Paid: </b> <?php if($dd['billingrecords'][0]['datepaid'] != "PENDING"){echo date('Y-m-d',strtotime($dd['billingrecords'][0]['datepaid']));}else{ echo $dd['billingrecords'][0]['datepaid'];};?></h6>
                                </div>
                            </div>    
                        <?php }else{ ?>
                            <h5>NO RECORD</h5>
                        <?php } ?>
                    </div>    
                </div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-dark col-md-1"onclick="printslip('customerrecord')"><span class="fa fa-print"></span> PRINT</button>
                <a href="AdminCustomerList" class="btn btn-sm btn-primary col-md-1"><span class="fa fa-home"></span> OK</a>
            </div>
        </div>
        <script>
            <?php if(Data::unload("sole-message")[0] == "true"){ ?>
                sole.<?php echo(Data::unload("sole-message")[1]); ?>("<?php echo(Data::unload("sole-message")[2]); ?>","bottom-right");
            <?php }?>
            <?php Data::load("sole-message",["false","",""]); ?>
        </script>
    </body>
</html>