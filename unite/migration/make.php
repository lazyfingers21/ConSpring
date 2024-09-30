<?php
    class MakeMigration{
        public static function make($m){
            $migration = file_get_contents("app/migrations/Migrations.php");
            $res = explode('
',$migration);
            $a = explode(' = ',$res[1]);
            
            $b = str_replace(['["','"];','","','[','];'],['','','/','',''],$a);
            $c = explode("/",$b[1]);
            if($b[1]==""){
                $c = [];   
            }
            if(!in_array($m,$c)){
                array_push($c,$m);

                $mtemp = '    Migrate::$migration = ["';
                for ($i=0; $i < count($c); $i++) { 
                    $mtemp .= $c[$i];
                    if($i==count($c)-1){
                        $mtemp .= '"';    
                    }else{
                        $mtemp .= '","';    
                    }
                }
                $mtemp .= '];'; 
                $res[1] = $mtemp;
                array_pop($res);
                $restemp = '';

                for ($i=0; $i < count($res); $i++) { 
                    $restemp .= $res[$i];
                    $restemp .= '
';
                    if($i == count($res)-1){
                        $restemp .= '
    class '.$m.'
    {
        public static function index(){
            Migrate::attrib_table("'.strtolower($m).'");
            Migrate::attrib_string(255);
        }
    }';
                    }
                }
                $restemp .= '
?>';
                file_put_contents("app/migrations/Migrations.php",$restemp);   
                echo("\e[1;32;40mMigration ".$m." created successfully.\e[0m");
            }else{
                echo("\e[1;33;40mMigration ".$m." already exist.\e[0m");
            }
        }
    }
?>