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
            <form action="AdminCustomerList?update" method="post">
                <input name="id" type="hidden" value="<?php echo $dd['customeraccounts'][0]["id"]; ?>">
                <div class="modal-body">
                    <div class="pane-header sticky-top">
                        <h4>CUSTOMER RECORD | EDIT</h4>
                    </div>
                    <div class="modal-header">
                        <h5><b>PERSONAL INFORMATION</b></h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2" style="display: flex">
                                <h6 class="mt-1 col-md-4"><b>Name:</b></h6>
                                <input required name="name" type="text" class="form-control" value="<?php echo $dd['customeraccounts'][0]["name"]; ?>">
                            </div>
                            <div class="col-md-6 mb-2" style="display: flex">
                                <h6 class="mt-1 col-md-4"><b>Contact No.:</b></h6>
                                <input required name="contactno" type="number" class="form-control" value="<?php echo $dd['customeraccounts'][0]["contactno"]; ?>">
                            </div>
                            <div class="col-md-6 mb-2" style="display: flex">
                                <h6 class="mt-1 col-md-4"><b>Purok No.:</b></h6>
                                <select required name="purokno" class="form-control">
                                    <option value="<?php echo $dd['customeraccounts'][0]["purokno"]; ?>"><?php echo $dd['customeraccounts'][0]["purokno"]; ?></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2" style="display: flex">
                                <h6 class="mt-1 col-md-4"><b>Connection Date:</b></h6>
                                <input required name="dateconnected" type="date" class="form-control" value="<?php echo $dd['customeraccounts'][0]["dateconnected"]; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-header">
                        <h5><b>CREDENTIALS</b></h5>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-6 mb-2" style="display: flex">
                            <h6 class="mt-1 col-md-4"><b>Username:</b></h6>
                            <input required name="username" type="text" class="form-control" value="<?php echo $dd['customeraccounts'][0]["username"]; ?>">
                        </div>
                        <div class="col-md-6 mb-2" style="display: flex">
                            <h6 class="mt-1 col-md-4"><b>Password:</b></h6>
                            <input required name="password" type="text" class="form-control" value="<?php echo $dd['customeraccounts'][0]["password"]; ?>">
                        </div>
                    </div>
                    <div class="modal-header">
                        <h5><b>BILLING INFORMATION</b></h5>
                    </div>
                    <div class="modal-body">
                        <?php if(count($dd['billingrecords'])){ ?>
                            <input name="billingupdate" type="hidden" value="true">
                            <div class="col-md-6" style="display: flex">
                                <h6 class="mt-1 col-md-4"><b>Billing Period:</b></h6>
                                <select required name="brid" id="" class="form-control" onchange="billingrecordedit(this.value)">
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
                                <div class="col-md-6">
                                    <div class="mb-2" style="display: flex">
                                        <h6 class="mt-1 col-md-6"><b>Previous Reading:</b></h6>
                                        <input required name="preading" id="preading" type="number" class="form-control" value="<?php echo $dd['billingrecords'][0]['preading'];?>">
                                    </div>
                                    <div class="mb-2" style="display: flex">
                                        <h6 class="mt-1 col-md-6"><b>Current Reading:</b></h6>
                                        <input required name="creading" id="creading" type="number" class="form-control" value="<?php echo $dd['billingrecords'][0]['creading'];?>">
                                    </div>
                                    <div class="mb-2" style="display: flex">
                                        <h6 class="mt-1 col-md-6"><b>Used:</b></h6>
                                        <input required name="used" id="used" type="number" class="form-control" value="<?php echo $dd['billingrecords'][0]['used'];?>">
                                    </div>
                                    <div class="mb-2" style="display: flex">
                                        <h6 class="mt-1 col-md-6"><b>Amount:</b></h6>
                                        <input required name="amount" id="amount" type="number" class="form-control" value="<?php echo $dd['billingrecords'][0]['amount'];?>">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-2" style="display: flex">
                                        <h6 class="mt-1 col-md-6"><b>Status: </b></h6>
                                        <select required name="status" id="" class="form-control">
                                            <option value="<?php echo $dd['billingrecords'][0]['status'];?>"><?php echo $dd['billingrecords'][0]['status'];?></option>
                                            <option value="PENDING">PENDING</option>
                                            <option value="PAID">PAID</option>
                                            <option value="OVERDUE">OVERDUE</option>
                                        </select>
                                    </div>
                                    <div class="mb-2" style="display: flex">
                                        <h6 class="mt-1 col-md-6"><b>Date: </b></h6>
                                        <input name="datepaid" id="datepaid" type="date" class="form-control" value="<?php if($dd['billingrecords'][0]['datepaid'] != "PENDING"){echo date('Y-m-d',strtotime($dd['billingrecords'][0]['datepaid']));}else{ echo $dd['billingrecords'][0]['datepaid'];};?>">
                                    </div>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <input name="billingupdate" type="hidden" value="false">
                            <h5>NO RECORD</h5>
                        <?php } ?>
                    </div>
                </div>    
                <div class="modal-footer">
                    <a href="AdminCustomerList" class="btn btn-sm btn-dark"><span class="fa fa-remove"></span> Cancel</a>
                    <button class="btn btn-sm btn-success"><span class="fa fa-save"></span> Save Changes</button>
                </div>
            </form>
        </div>
        <script>
            <?php if(Data::unload("sole-message")[0] == "true"){ ?>
                sole.<?php echo(Data::unload("sole-message")[1]); ?>("<?php echo(Data::unload("sole-message")[2]); ?>","bottom-right");
            <?php }?>
            <?php Data::load("sole-message",["false","",""]); ?>
        </script>
    </body>
</html>