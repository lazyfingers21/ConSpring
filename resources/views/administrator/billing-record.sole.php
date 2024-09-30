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
                    <h4>BILLING RECORDS</h4>
                </div>
                <div class="modal-header">
                    <div class="col-md-6 input-group">
                        <input oninput="searchbr()" type="text" name="" id="billingsearch" class="form-control" placeholder="Collection Date (YYYY-MM-DD)">
                        <button onclick="searchbr()"  class="btn btn-primary"><span class="fa fa-search"></span> Search</button>
                    </div>
                    <div class="col-md-3 input-group">
                        <label class="btn btn-dark">Sort By: </label>
                        <select onchange="sortbybr(this.value)" id="sortby" class="form-control">
                            <option value="start">DATE</option>
                            <option value="status">STATUS</option>
                        </select>
                    </div>
                </div>
                <div class="modal-body">
                    <table class="table">
                    <h5><b><span class="fa fa-list"></span> BILLING PERIODS</b></h5>
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td>Start Date</td>
                                <td>End Date</td>
                                <td>Collection Date</td>
                                <td>Due Date</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody id="billingrecordlist">
                            <?php foreach($dd['billingperiods'] as $bp){ ?>
                                <tr>
                                    <td><?php echo $bp['id']; ?></td>
                                    <td><?php echo $bp['start']; ?></td>
                                    <td><?php echo $bp['end']; ?></td>
                                    <td><?php echo $bp['collection']; ?></td>
                                    <td><?php echo $bp['due']; ?></td>
                                    <td>
                                        <?php
                                            $status = "COMPLETE";
                                            $billingrecords = new BillingRecord;
                                            foreach(DB::where($billingrecords,'bpid','=',$bp['id']) as $br){
                                                if($br['status'] == 'PENDING' || $br['status'] == 'OVERDUE'){
                                                    $status = 'INCOMPLETE';
                                                }
                                            }
                                            
                                            echo $status;
                                        ?>
                                    </td>
                                    <td style="width: 230px;">
                                        <div class="row">
                                            <a href="AdminBillingRecord?show&id=<?php echo $bp["id"]; ?>" class="btn btn-sm btn-dark"><span class="fa fa-binoculars"></span> View</a>
                                            <a data-toggle="modal" data-target="#editbilling<?php echo $bp["id"]; ?>" href="#" c class="btn btn-sm btn-dark"><span class="fa fa-pencil"></span> Edit</a>
                                            <a data-toggle="modal" data-target="#deletesolorecord<?php echo $bp["id"]; ?>" href="#" c class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editbilling<?php echo $bp["id"]; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6>Edit Billing Period</h6>
                                            </div>
                                            <form action="AdminBillingRecord?update&id=<?php echo $bp["id"]; ?>" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <label class="btn btn-dark col-md-4">Start: </label>
                                                            <input required type="date" name="start" id="" class="form-control" value="<?php echo $bp["start"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <label class="btn btn-dark col-md-4">End: </label>
                                                            <input required type="date" name="end" id="" class="form-control" value="<?php echo $bp["end"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <label class="btn btn-dark col-md-4">Collection Date: </label>
                                                            <input required type="date" name="collection" id="" class="form-control" value="<?php echo $bp["collection"]; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <label class="btn btn-dark col-md-4">Due Date: </label>
                                                            <input required type="date" name="due" id="" class="form-control" value="<?php echo $bp["due"]; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-sm btn-dark" data-dismiss="modal"><span class="fa fa-remove"></span> Cancel</button>
                                                    <button class="btn btn-sm btn-success"><span class="fa fa-save"></span> Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="deletesolorecord<?php echo $bp["id"]; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content alert-warning">
                                            <div class="modal-body">
                                                <div class="m-4">
                                                    <h2><span class="fa fa-warning"></span> Warning</h2>
                                                    <hr>
                                                    <h5>Are you sure you want to delete this  record? This can't be undone.</h5>
                                                    <div class="modal-footer">
                                                        <button data-dismiss="modal" class="btn btn-dark btn-sm"><span class="fa fa-remove"></span> Cancel</button>
                                                        <a href="AdminBillingRecord?destroy&type=solo&id=<?php echo $bp["id"]; ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Yes</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>    
                </div>
                <div class="modal-footer">
                    <a data-toggle="modal" data-target="#deleteallrecord" class="btn btn-sm btn-danger" href="#"><span class="fa fa-trash"></span> Delete All Records</a>
                </div>
                <div class="modal fade" id="deleteallrecord">
                    <div class="modal-dialog">
                        <div class="modal-content alert-warning">
                            <div class="modal-body">
                                <div class="m-4">
                                    <h2><span class="fa fa-warning"></span> Warning</h2>
                                    <hr>
                                    <h5>Are you sure you want to delete all this records? This can't be undone.</h5>
                                    <div class="modal-footer">
                                        <button data-dismiss="modal" class="btn btn-dark btn-sm"><span class="fa fa-remove"></span> Cancel</button>
                                        <a href="AdminBillingRecord?destroy&type=all" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Yes</a>
                                    </div>
                                </div>
                            </div>
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