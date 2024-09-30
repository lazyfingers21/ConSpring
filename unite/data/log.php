<?php
    class Logs{
        public static $file = "../../unite/log/sole.log";
        public static function index(){
            if(is_file(Logs::$file) === false){
                file_put_contents(Logs::$file,"");
                Logs::log();
            }else{
                Logs::log();
            } 
        }
        public static function clear(){
            if(is_file(Logs::$file) === false){
                file_put_contents(Logs::$file,"");
            }else{
                file_put_contents(Logs::$file,"");  
                Data::load("log","0");
            } 
        }
        public static function show(){
            if(is_file(Logs::$file) === false){
                file_put_contents(Logs::$file,"");
            }else{
                $document = file_get_contents(Logs::$file);
                $document = explode('
',$document);
                for ($i=0; $i < count($document); $i++) { 
                    echo $document[$i];
                    echo "<br>";
                }
            } 
        }
        public static function log(){
            include('../../unite/database/dc.php');
            $index = Data::unload("log");
            $document = file_get_contents(Logs::$file);
            $sf = explode('/',$_SERVER["SCRIPT_FILENAME"]);
            $SCRIPT_FILENAME = "";
            for ($i=0; $i < count($sf) ; $i++) {
                if($i == 0){
                    $SCRIPT_FILENAME .= $sf[$i]; 
                }else{
                    $SCRIPT_FILENAME .= "//".$sf[$i];    
                }
            }
            if($_SERVER["QUERY_STRING"]){
                $QUERY_STRING = "?".$_SERVER["QUERY_STRING"]; 
            }else{
                $QUERY_STRING = $_SERVER["QUERY_STRING"];    
            }
            $date = new DateTime();
            $y = ((int) $date->format('Y'));
            $m = ((int) $date->format('m'));
            if($m < 10){$m = "0".$m;}
            $d = ((int) $date->format('d'));
            if($d < 10){$d = "0".$d;}
            $h = ((int) $date->format('h'));
            if($h < 10){$h = "0".$h;}
            $i = ((int) $date->format('i'));
            if($i < 10){$i = "0".$i;}
            $s = ((int) $date->format('s'));
            if($s < 10){$s = "0".$s;}
            if($index == 0){
                $document .= "--------------------------------------------------------------------------------------------------------
"."[".$y."-".$m."-".$d." ".$h.":".$i.":".$s."]"." - System Start"."
"."Sole Framework : v".Data::unload("APP_FRAMEWORK_VERSION")."
"."Application: ".$APP_NAME."
"."Developer/s: ".$APP_DEV."
"."--------------------------------------------------------------------------------------------------------
"."#".$index." ".$SCRIPT_FILENAME.$QUERY_STRING."
";
            }else{
            $document .= "#".$index." ".$SCRIPT_FILENAME.$QUERY_STRING."
"; 
            }
            file_put_contents(Logs::$file,$document);   
            $index++;
            Data::load("log",$index);
        }
    }
    $res = file_get_contents("../../.env");
    $conf = explode("
",$res);
    if(explode("=",$conf[13])[1] == "true"){
        Logs::index();
    }else{
        Logs::clear();
    }
?>