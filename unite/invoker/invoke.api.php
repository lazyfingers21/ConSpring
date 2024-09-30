<?php
    /**Note: do not interchange code arrangement */
    include_once('../../unite/exception/exception.php');
    include_once('../../unite/database/db.php');
    include_once('../models/Models.php');
    include_once('../../unite/data/data.php');
    include_once('../../unite/data/log.php');
    include_once('../../unite/session/session.php');

    $res = file_get_contents("../../.env");
    $conf = explode("
",$res);
    for ($i=0; $i < count($conf); $i++) { 
        if(explode('=',$conf[$i])[0]=="Extension"){
            if(file_exists('../../unite/libs/'.explode('=',$conf[$i])[1].'/loader.php')){
                include_once('../../unite/libs/'.explode('=',$conf[$i])[1].'/loader.php');
            }
        }
    }

    class Extend_Route{
        public static function er(){
            try {
                $func = array("store","show","update","destroy","handler");
                $Controller = $_SERVER["PHP_SELF"];
                $arr = explode('/',$Controller);
                $arr = explode('.',end($arr));
                $Controller = $arr[0];

                if(count($_GET)){
                    $request_data = new Request;
                    $request_keys = array_keys($_GET);

                    for ($i=0; $i < count($request_keys); $i++) { 
                        $temp = $request_keys[$i];
                        $request_data->$temp = $_GET[$temp];
                    }

                    $request_keys = array_keys($_POST);
                    
                    for ($i=0; $i < count($request_keys); $i++) { 
                        $temp = $request_keys[$i];
                        $request_data->$temp = $_POST[$temp];
                    }

                    if(in_array(array_keys($_GET)[0],$func)){
                        $method = array_keys($_GET)[0];
                        $Controller::$method($request_data);
                    }else{
                        $method = array_keys($_GET)[0];
                        $Controller::$method($request_data);
                    }
                }else{
                    $Controller::index();
                }
            } catch (Throwable | SoleException $e) {
                $_SESSION["soleexceptionerror"] = $e;
                exception_handler(0,$e->getMessage(),$e->getFile(),$e->getLine());
                echo $e->getMessage();
            }
        }
    }
    class Request{}
    Extend_Route::er();
?>