<div class="modal fade" id="addcustomer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6><b>Add New Customer</b></h6>
            </div>
            <form action="AdminCustomerList?store" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <label class="btn btn-dark col-md-4">Name: </label>
                            <input required type="text" name="name" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="btn btn-dark col-md-4">Contact No.: </label>
                            <input required type="number" name="contactno" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="btn btn-dark col-md-4">Purok No.: </label>
                            <select required name="purokno" id="" class="form-control">
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
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="btn btn-dark col-md-4">Connection Date: </label>
                            <input required type="date" name="connectiondate" id="" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="btn btn-dark col-md-4">Username: </label>
                            <input required type="text" name="username" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="btn btn-dark col-md-4">Password: </label>
                            <input required type="text" name="password" id="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-dark" data-dismiss="modal"><span class="fa fa-remove"></span> Cancel</button>
                    <button class="btn btn-sm btn-success"><span class="fa fa-save"></span> Save</button>
                </div>
            </form>
        </div>
    </div>
</div><div class="modal fade" id="addbilling">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6><b>Add New Billing Period</b></h6>
            </div>
            <form action="AdminBilling?store" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <label class="btn btn-dark col-md-4">Start: </label>
                            <input required type="date" name="start" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="btn btn-dark col-md-4">End: </label>
                            <input required type="date" name="end" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="btn btn-dark col-md-4">Collection Date: </label>
                            <input required type="date" name="collection" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <label class="btn btn-dark col-md-4">Due Date: </label>
                            <input required type="date" name="due" id="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-dark" data-dismiss="modal"><span class="fa fa-remove"></span> Cancel</button>
                    <button class="btn btn-sm btn-success"><span class="fa fa-save"></span> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="manageaccount">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6><b><span class="fa fa-gears"></span> Account Management</b></h6>
            </div>
            <form action="AdminLogin?update&id=<?php echo Data::unload('admin')[0]['id']; ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <h6>User Type: </h6>
                        <input readonly type="text" class="form-control" value="<?php echo strtoupper(Data::unload('admin')[0]['type']); ?>">
                    </div>
                    <div class="form-group">
                        <h6>Name: </h6>
                        <input required name="name" type="text" class="form-control" value="<?php echo Data::unload('admin')[0]['name']; ?>">
                    </div>
                    <div class="form-group">
                        <h6>Email Address: </h6>
                        <input required name="email" type="text" class="form-control" value="<?php echo Data::unload('admin')[0]['email']; ?>">
                    </div>
                    <div class="form-group">
                        <h6>Contact No.: </h6>
                        <input required name="contactno" type="text" class="form-control" value="<?php echo Data::unload('admin')[0]['contactno']; ?>">
                    </div>
                    <div class="form-group">
                        <h6>Username: </h6>
                        <input required name="username" type="text" class="form-control" value="<?php echo Data::unload('admin')[0]['username']; ?>">
                    </div>
                    <div class="form-group">
                        <h6>Password: </h6>
                        <input required name="password" type="text" class="form-control" value="<?php echo Data::unload('admin')[0]['password']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-sm btn-dark"><span class="fa fa-remove"></span> Cancel</button>
                    <button class="btn btn-sm btn-success"><span class="fa fa-save"></span> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="logout">
    <div class="modal-dialog">
        <div class="modal-content alert-primary">
            <div class="modal-body">
                <div class="m-4">
                    <h2><span class="fa fa-info"></span> Info</h2>
                    <hr>
                    <h5>Are you sure you want to logout?.</h5>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-dark btn-sm"><span class="fa fa-remove"></span> NO</button>
                        <a href="AdminLogin?destroy" class="btn btn-primary btn-sm"><span class="fa fa-check"></span> YES</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>