<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConSpring | Admin Billing Record</title>
</head>
    <body>
        <?php Route::view_extend("administrator.navigation"); ?>
        <?php Route::view_extend("administrator.modal"); ?>
        <div class="admin-display-container">
            <div class="modal-body">
                <div class="pane-header sticky-top">
                    <h4>BILLING RECORDS | VIEW</h4>
                </div>
                <div class="modal-body" id="billingrecord">
                    <h5><b>BILLING PERIOD INFO</b></h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h6><b>Start Date: </b><?php echo $dd['billingperiods'][0]['start']; ?></h6>
                            <h6><b>End Date: </b><?php echo $dd['billingperiods'][0]['end']; ?></h6>        
                        </div>
                        <div class="col-md-6">
                            <h6><b>Collection Date: </b><?php echo $dd['billingperiods'][0]['collection']; ?></h6>
                            <h6><b>Due Date: </b><?php echo $dd['billingperiods'][0]['due']; ?></h6>        
                        </div>
                    </div>
                    <hr>
                    <h5><b>STATUS</b></h5>
                    <div class="col">
                        <h6><b>
                        <?php
                            foreach($dd['billingperiods'] as $bp){
                                $status = "COMPLETE";
                                $billingrecords = new BillingRecord;
                                foreach(DB::where($billingrecords,'bpid','=',$bp['id']) as $br){
                                    if($br['status'] == 'PENDING' || $br['status'] == 'OVERDUE'){
                                        $status = 'INCOMPLETE';
                                    }
                                }
                                echo $status;    
                            }                      
                        ?>
                        </b></h6>    
                    </div>
                    <hr>
                    <h5><b>STATISTIC</b></h5>
                    <div class="row">
                        <?php 
                            $pending = 0;
                            $paid = 0;
                            $overdue = 0;
                            foreach($dd['billingrecords'] as $br){
                                if($br['status'] == 'PENDING'){
                                    $pending++;
                                }
                                if($br['status'] == 'PAID'){
                                    $paid++;
                                }
                                if($br['status'] == 'OVERDUE'){
                                    $overdue++;
                                }
                            }
                        ?>
                        <div class="col-md-4">
                            <h6><b>PENDING: <?php echo $pending; ?></b></h6>
                        </div>
                        <div class="col-md-4">
                            <h6><b>PAID: <?php echo $paid; ?></b></h6>
                        </div>
                        <div class="col-md-4">
                            <h6><b>OVERDUE: <?php echo $overdue; ?></b></h6>
                        </div>
                    </div>
                    <hr>
                    <h5><b>RECORDS</b></h5>
                    <table class="table mt-3">
                        <tbody>
                            <?php foreach($dd['billingrecords'] as $br){ ?>
                                <tr>
                                    <td>
                                        <?php 
                                            foreach($dd['customeraccounts'] as $ca){
                                                if($ca['id'] == $br['caid']){
                                                    echo $ca['name'];
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $br['status']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <hr>
                    <h5><b>TOTAL INCOME</b></h5>
                    <div class="col">
                        <h6><b>
                            <?php 
                                $income = 0;
                                foreach($dd['billingrecords'] as $br){
                                    if($br['status'] == 'PAID'){
                                        $income = $income + $br['amount'];
                                    }
                                }
                                echo 'PHP '.$income.'.00';
                            ?>
                        </b></h6>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="printslip('billingrecord')" class="btn btn-sm btn-dark col-md-1"><span class="fa fa-print"></span> PRINT</button>
                    <a href="AdminBillingRecord" class="btn btn-sm btn-primary col-md-1"><span class="fa fa-home"></span> OK</a>
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