<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConSpring | Admin Send Message</title>
</head>
    <body>
        <?php Route::view_extend("administrator.navigation"); ?>
        <?php Route::view_extend("administrator.modal"); ?>
        <div class="admin-display-container">
            <form action="AdminSendMessage?store" method="post">
                <div class="modal-body">
                    <div class="pane-header sticky-top">
                        <h4>SEND MESSAGE</h4>
                    </div>
                    <div class="modal-body">
                        <h6><b>Enter Message: </b></h6>
                        <textarea required name="message" rows="6" class="form-control" placeholder="Aa"></textarea>
                    </div>
                    <div class="modal-body">
                        <h6><b>Sent To: </b></h6>
                        <div class="row">
                            <div class="row col-md-2">
                                <input onclick="recipient(this.value)" value="one" checked class="mt-1 mr-2" type="radio" name="sendto" id="one">
                                <label for="one">One</h6>
                            </div>
                            <div class="row col-md-2">
                                <input onclick="recipient(this.value)" value="all" class="mt-1 mr-2" type="radio" name="sendto" id="all">
                                <label for="all">All</h6>
                            </div>    
                        </div>
                    </div>
                    <div class="modal-body" id="recipient" style="display: block">
                        <h6><b>Select Recipient(s): </b></h6>
                        <select name="caid" id="" class="form-control col-md-5">
                            <?php foreach($dd['customeraccounts'] as $ca){ ?>
                                <option value="<?php echo $ca['id']; ?>"><?php echo $ca['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>    
                <div class="modal-footer">
                    <button class="btn btn-sm btn-success"><span class="fa fa-send"></span> Send</button>
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