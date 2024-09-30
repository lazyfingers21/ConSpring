<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConSpring | Admin Dashboard</title>
</head>
    <body>
        <?php Route::view_extend("administrator.navigation"); ?>
        <?php Route::view_extend("administrator.modal"); ?>
        <div class="admin-display-container">
            <div class="modal-body">
                <div class="pane-header sticky-top">
                    <h4>DASHBOARD</h4>
                </div> 
                <div class="d-calendar p-3" id="datetime">
                    <h1 id="time">12:00:00 AM</h1>
                    <h5 id="date">Saturday, January 1 2022</h5>
                </div>
                <hr>
                <div class="d-notice p-3">
                    <?php if(count($dd['billingperiods'])){ ?>
                        <h5><b>Billing Period: <?php echo date("M d, Y", strtotime($dd['billingperiods'][0]["start"])).' - '.date("M d, Y", strtotime($dd['billingperiods'][0]["end"])); ?></b></h5>
                        <h5>Previous Billing Period:  
                            <?php if(count($dd['billingperiods']) > 1){ ?>
                                <?php echo date("M d, Y", strtotime($dd['billingperiods'][1]["start"])).' - '.date("M d, Y", strtotime($dd['billingperiods'][1]["end"])); ?>
                            <?php }else{ ?>
                                N/A
                            <?php } ?>
                        </h5>
                        <h5>Collection Date: <?php echo date("M d, Y", strtotime($dd['billingperiods'][0]["collection"])); ?></h5>
                        <h5>Due Date: <?php echo date("M d, Y", strtotime($dd['billingperiods'][0]["due"])); ?></h5>    
                    <?php }else{ ?>
                        <h5><b>THERE IS NO BILLING SCHEDULE AT THE MOMENT</b></h5>
                    <?php } ?>
                    
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div style="text-align: left" class="btn btn-success col">
                            <h3><b><?php echo $dd['statistic'][0]; ?></b></h3>
                            <h4><span class="fa fa-check"></span> Paid Customers</h4>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div style="text-align: left" class="btn btn-primary col">
                            <h3><b><?php echo $dd['statistic'][1]; ?></b></h3>
                            <h4><span class="fa fa-book"></span> Pending Customers</h4>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div style="text-align: left" class="btn btn-secondary col">
                            <h3><b><?php echo $dd['statistic'][2]; ?></b></h3>
                            <h4><span class="fa fa-clock-o"></span> Overdue Customers</h4>
                        </div> 
                    </div>
                </div>
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