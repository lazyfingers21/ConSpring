<?php
    class SoleException extends Exception{}
    function exception_handler($errNo, $errMessage, $errFile, $errLine){
        $_SESSION["soleexceptionerror"] = [$errNo,$errMessage,$errFile,$errLine];
        $_SESSION["soleexceptionserver"] = $_SERVER;
        $_SESSION["soleexceptionstatus"] = true;

        $res = file_get_contents('../../.env');
        $conf = explode('
',$res);
        if(explode('=',$conf[14])[1] == "true"){
            Route::error(explode('=',$conf[15])[1]);
        }else{
            header("location: ../../unite/exception/exceptionErr");
        }
    }
    set_error_handler('exception_handler');
?>