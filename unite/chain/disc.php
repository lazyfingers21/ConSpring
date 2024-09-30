<?php
    include_once('unite/database/db.cli.php');
    include_once('app/models/Models.php');
    include_once('unite/data/data.php');

    $res = file_get_contents(".env");
    $conf = explode("
",$res);
    for ($i=0; $i < count($conf); $i++) { 
        if(explode('=',$conf[$i])[0]=="Extension"){
            if(file_exists('unite/libs/'.explode('=',$conf[$i])[1].'/loader_root.php')){
                include_once('unite/libs/'.explode('=',$conf[$i])[1].'/loader_root.php');
            }
        }
    }
    class Disc{
        public static function index(){
            include("unite/chain/disc");
        }
    }
?>