<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConSpring | Admin Login</title>
</head>
    <body>
        <div class="login-container">
            <form action="AdminLogin?show" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <h3><b>Hello, <?php if( Data::unload("user-type") == "administrator"){ echo "Admin"; }else{ echo "Treasurer"; }?>! <span class="fa fa-smile-o"></span></b></h3>
                        <h4>Please Enter Your Credentials</h4>    
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="input-group">
                            <label for="username" class="btn btn-dark col-md-3"><span class="fa fa-user"></span> Username: </label>
                            <input required type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="input-group">
                            <label for="password" class="btn btn-dark col-md-3"><span class="fa fa-lock"></span> Password: </label>
                            <input required type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="Login" class="btn btn-dark col-md-3"><span class="fa fa-home"></span> Cancel</a>
                    <button class="btn btn-primary col-md-3"><span class="fa fa-sign-in"></span> Login</button>
                </div>    
            </form>
        </div>
        <script>
            <?php if(Data::unload("sole-message")[0] == "true"){ ?>
                sole.<?php echo(Data::unload("sole-message")[1]); ?>("<?php echo(Data::unload("sole-message")[2]); ?>","top-right");
            <?php }?>
            <?php Data::load("sole-message",["false","",""]); ?>
        </script>
    </body>
</html>