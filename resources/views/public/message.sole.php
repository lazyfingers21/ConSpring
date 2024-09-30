<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConSpring | User Payment Records</title>
</head>
    <body>
        <?php Route::view_extend("public.navigation"); ?>
        <?php Route::view_extend("public.modal"); ?>
        <div class="admin-display-container">
            <div class="modal-body">
                <div class="pane-header sticky-top">
                    <h4>MESSAGES</h4>
                </div>
            </div>
            <div class="modal-body">
                <?php foreach($dd['messages'] as $m){ ?>
                <div class="col alert alert-primary">
                    <h6><b>Data Recieved:</b> <?php echo date("M d, Y", strtotime($m['created_at'])); ?></h6>
                    <h6><b>Body:</b></h6>
                    <textarea readonly name="" id="" cols="30" rows="5" class="form-control"><?php echo $m['message']; ?></textarea>
                </div>
                <?php } ?>
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