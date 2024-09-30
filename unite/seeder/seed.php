<?php
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
    include_once('app/seeders/Seeders.php');
    class Seed{
        public static function default_run(){
            for ($i=0; $i < count(Seed::$seeders); $i++) {
                echo "\e[1;33;40mSeeding: " . Seed::$seeders[$i] ."\e[0m\n";
                Seed::$seeders[$i]::index();
                if(!Seed::$err){
                    echo "\e[1;32;40mDone\e[0m\n";
                }
            }
        }
        public static function json_run(){
            for ($i=0; $i < count(Seed::$seeders); $i++) {
                echo "\e[1;33;40mSeeding: " . Seed::$seeders[$i] ."\e[0m\n";
                Seed::$seeders[$i]::index();
                if(!Seed::$err){
                    echo "\e[1;32;40mDone\e[0m\n";
                }
            }
        }
        public static function table($t){
            Seed::$table = $t;
        }
        public static function insert($d){
            include('unite/database/dc.cli.php');
            if(Seed::$dbtype){
                for ($i=0; $i < count(array_keys($d)); $i++) {
                    if($i==count(array_keys($d))-1){
                        Seed::$attributes .= "`".array_keys($d)[$i]."`";
                        Seed::$values .= "'".$d[array_keys($d)[$i]]."'";
                    }else{
                        Seed::$attributes .= "`".array_keys($d)[$i]."`,";
                        Seed::$values .= "'".$d[array_keys($d)[$i]]."',";
                    }
                }
                try{
                    $SQL = "INSERT INTO `".Seed::$table."` (".Seed::$attributes.") VALUES (".Seed::$values.")";
                    $DB_CONN->exec($SQL);
                    Seed::$attributes = "";
                    Seed::$values = "";
                    Seed::$err = false;
                }catch(PDOException $e){
                    echo "\e[1;33;41mSeeding Failed: " . $e->getMessage()."\e[0m\n";
                    Seed::$err = true;
                }
            }else{
                if(file_exists("unite/database/json.db/".$DB_DATABASE."/".Seed::$table.".json")){
                    $res = json_decode(file_get_contents("unite/database/json.db/".$DB_DATABASE."/".Seed::$table.".json"));
                    for ($i=count(array_keys($d)) -1; $i >= 0; $i--) { 
                        if(!in_array(array_keys($d)[$i],$res->attribute)){
                            Seed::$attribute_err = array_keys($d)[$i];
                            Seed::$err = true;
                        }
                    }
                    if(!Seed::$err){
                        $date = new DateTime();
                        $y = ((int) $date->format('Y'));
                        $m = ((int) $date->format('m'));
                        if($m < 10){$m = "0".$m;}
                        $day = ((int) $date->format('d'));
                        if($day < 10){$day = "0".$day;}
                        $h = ((int) $date->format('h'));
                        if($h < 10){$h = "0".$h;}
                        $i = ((int) $date->format('i'));
                        if($i < 10){$i = "0".$i;}
                        $s = ((int) $date->format('s'));
                        if($s < 10){$s = "0".$s;}
                        $created_at = "$y-$m-$day $h:$i:$s";
                        $updated_at = "$y-$m-$day $h:$i:$s";
                        $id = ["id" => $res->index];
                        $timestamp = ["created_at" => $created_at, "updated_at" => $updated_at];
                        $d = array_merge(array_merge($id,$d),$timestamp);
                        array_push($res->data,$d);
                        $res->index++;
                        file_put_contents("unite/database/json.db/".$DB_DATABASE."/".Seed::$table.".json",json_encode($res));
                    }else{
                        Seed::$err = true;
                        echo("\e[1;33;41mSeeding Failed: Column not found: Unknown column '".Seed::$attribute_err."' in 'field list'.\e[0m\n");
                    }
                }else{
                    Seed::$err = true;
                    echo("\e[1;33;41mSeeding Failed: Base table or view not found: Table '$DB_DATABASE.".Seed::$table."' doesn't exist.\e[0m\n");
                }
            }
        }
        public static $dbtype = false;
        public static $attribute_err = "";
        public static $seeders = [];
        public static $table = "";
        public static $attributes = "";
        public static $values = "";
        public static $err = false;
    }
?>