<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConSpring | Admin Reports</title>
</head>
    <body>
        <?php Route::view_extend("administrator.navigation"); ?>
        <?php Route::view_extend("administrator.modal"); ?>
        
        <div class="admin-display-container">
            <div class="modal-body">
                <div class="pane-header sticky-top" id="billr">
                    <h4>REPORTS</h4>
                </div> 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5><b>WATER CONSUMPTION (Cubic Meter Per Billing Period)</b></h5>    
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <label for="" class="btn btn-dark">Sort by: </label>
                                <select name="" id="" class="form-control">
                                    <option value="Month">Monthly</option>
                                    <option value="Year">Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-2 pl-2 pr-2" style="overflow-Y: hidden;">
                        <canvas style="margin-top: -25px;" id="waterconsumption" width="400" height="120"></canvas>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5><b>INCOME (Income Per Billing Period)</b></h5>    
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <label for="" class="btn btn-dark">Sort by: </label>
                                <select name="" id="" class="form-control">
                                    <option value="Month">Monthly</option>
                                    <option value="Year">Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-2 pl-2 pr-2" style="overflow-Y: hidden;">
                        <canvas style="margin-top: -25px;" id="customerincome" width="400" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var ctx = document.getElementById('waterconsumption').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        <?php
                            foreach($dd['billingperiods'] as $bp){
                                echo "'".$bp['collection']." - ".$bp['due']."',";
                            }      
                        ?>
                    ],
                    datasets: [{
                        label: 'Water Consumption',
                        data: [
                                <?php
                                    $max = 100;
                                    foreach($dd['billingperiods'] as $bp){
                                        $used = 0;
                                        foreach($dd['billingrecords'] as $br){
                                            if($br['bpid'] == $bp['id']){
                                                $used = $used + $br['used'];
                                            }
                                        }
                                        if($used > $max){
                                            $max = $used;
                                        }
                                        echo "'".$used."',";
                                    }     
                                ?>
                            ],
                        backgroundColor: [
                            <?php
                                foreach($dd['billingperiods'] as $bp){
                                    //echo "'rgba(54, 162, 235, 0.2)',";
                                    echo "'rgb(0, 189, 0, 0.2)',";
                                }      
                            ?>
                        ],
                        borderColor: [
                            <?php
                                foreach($dd['billingperiods'] as $bp){
                                    echo "'rgb(0, 189, 0, 1)',";
                                }      
                            ?>
                        ],
                        borderWidth: 2
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            min: 0,
                            max: <?php echo $max; ?>,
                            stepSize: 1 // 1 - 2 - 3 ...
                        },
                        xAxes: [{
                            display: true
                        }]
                    },
                }
            });
        </script>
        <script>
            var ctx = document.getElementById('customerincome').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        <?php
                            foreach($dd['billingperiods'] as $bp){
                                echo "'".$bp['collection']." - ".$bp['due']."',";
                            }      
                        ?>
                    ],
                    datasets: [{
                        label: 'Customer Income',
                        data: [
                                <?php
                                    $max = 100;
                                    foreach($dd['billingperiods'] as $bp){
                                        $income = 0;
                                        foreach($dd['billingrecords'] as $br){
                                            if($br['bpid'] == $bp['id']){
                                                $income = $income + $br['amount'];
                                            }
                                        }
                                        if($income > $max){
                                            $max = $income;
                                        }
                                        echo "'".$income."',";
                                    }     
                                ?>
                            ],
                        backgroundColor: [
                            <?php
                                foreach($dd['billingperiods'] as $bp){
                                    echo "'rgb(255, 165, 0, 0.2)',";
                                }      
                            ?>
                        ],
                        borderColor: [
                            <?php
                                foreach($dd['billingperiods'] as $bp){
                                    echo "'rgb(255, 165, 0, 1)',";
                                }      
                            ?>
                        ],
                        borderWidth: 2
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            min: 0,
                            max: <?php echo $max; ?>,
                            stepSize: 1 // 1 - 2 - 3 ...
                        },
                        xAxes: [{
                            display: true
                        }]
                    },
                }
            });
        </script>
        <script>
            <?php if(Data::unload("sole-message")[0] == "true"){ ?>
                sole.<?php echo(Data::unload("sole-message")[1]); ?>("<?php echo(Data::unload("sole-message")[2]); ?>","bottom-right");
            <?php }?>
            <?php Data::load("sole-message",["false","",""]); ?>
        </script>
    </body>
</html>