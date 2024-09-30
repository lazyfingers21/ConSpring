<div class="modal fade" id="manageaccount">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6><b><span class="fa fa-gears"></span> Account Management</b></h6>
            </div>
            <form action="UserLogin?update&id=<?php echo Data::unload('user-data')[0]['id']; ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <h6>Name: </h6>
                        <input required name="name" type="text" class="form-control" value="<?php echo Data::unload('user-data')[0]['name']; ?>">
                    </div>
                    <div class="form-group">
                        <h6>Contact No: </h6>
                        <input required name="contactno" type="text" class="form-control" value="<?php echo Data::unload('user-data')[0]['contactno']; ?>">
                    </div>
                    <div class="form-group">
                        <h6>Purok No.: </h6>
                        <input required name="purokno" type="number" class="form-control" value="<?php echo Data::unload('user-data')[0]['purokno']; ?>">
                    </div>
                    <div class="form-group">
                        <h6>Username (You Can't Update Username): </h6>
                        <input required readonly name="username" type="text" class="form-control" value="<?php echo Data::unload('user-data')[0]['username']; ?>">
                    </div>
                    <div class="form-group">
                        <h6>Password: </h6>
                        <input required name="password" type="text" class="form-control" value="<?php echo Data::unload('user-data')[0]['password']; ?>">
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
                        <a href="UserLogin?destroy" class="btn btn-primary btn-sm"><span class="fa fa-check"></span> YES</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>