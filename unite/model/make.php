<?php
    class MakeModel{
        public static function make($m){
            $migration = file_get_contents("app/models/Models.php");
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

                $mtemp = '    $models = ["';
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
        public $table = "'.strtolower($m).'";
        public $fillable = [];
    }';
                    }
                }
                $restemp .= '
?>';
                file_put_contents("app/models/Models.php",$restemp);   
                echo("\e[1;32;40mModel ".$m." created successfully.\e[0m");
            }else{
                echo("\e[1;33;40mModel ".$m." already exist.\e[0m");
            }
            
        }
    }
?>