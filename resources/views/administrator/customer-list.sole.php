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
                    <h4>CUSTOMER LIST</h4>
                </div>
                <div class="modal-header">
                    <div class="col-md-6 input-group">
                        <input oninput="searchcustomer()" type="text" name="" id="customersearch" class="form-control" placeholder="Name">
                        <button onclick="searchcustomer()"  class="btn btn-primary"><span class="fa fa-search"></span> Search</button>
                    </div>
                    <div class="col-md-3 input-group">
                        <label class="btn btn-dark">Sort By: </label>
                        <select onchange="sortby(this.value)" id="sortby" class="form-control">
                            <option value="name">Name</option>
                            <option value="purokno">Purok</option>
                        </select>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Name</td>
                            <td>Contact No.</td>
                            <td>Purok No.</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody id="customerlist">
                        <?php foreach($dd["customeraccounts"] as $ca){ ?>
                            <tr>
                                <td><?php echo $ca["id"]; ?></td>
                                <td><?php echo $ca["name"]; ?></td>
                                <td><?php echo $ca["contactno"]; ?></td>
                                <td><?php echo $ca["purokno"]; ?></td>
                                <td style="width: 230px;">
                                    <div class="row">
                                        <a href="AdminCustomerList?show&id=<?php echo $ca["id"]; ?>" class="btn btn-sm btn-dark"><span class="fa fa-binoculars"></span> View</a>
                                        <a href="AdminCustomerList?handler&id=<?php echo $ca["id"]; ?>" c class="btn btn-sm btn-dark"><span class="fa fa-pencil"></span> Edit</a>
                                        <a data-toggle="modal" data-target="#deletesolorecord<?php echo $ca["id"]; ?>" href="#" c class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="deletesolorecord<?php echo $ca["id"]; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content alert-warning">
                                        <div class="modal-body">
                                            <div class="m-4">
                                                <h2><span class="fa fa-warning"></span> Warning</h2>
                                                <hr>
                                                <h5>Are you sure you want to delete this  record? This can't be undone.</h5>
                                                <div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-dark btn-sm"><span class="fa fa-remove"></span> Cancel</button>
                                                    <a href="AdminCustomerList?destroy&type=solo&id=<?php echo $ca["id"]; ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Yes</a>
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
                <a data-toggle="modal" data-target="#deleteallrecord" class="btn btn-sm btn-danger" href="#"><span class="fa fa-trash"></span> Delete All Customer</a>
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
                                    <a href="AdminCustomerList?destroy&type=all" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Yes</a>
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