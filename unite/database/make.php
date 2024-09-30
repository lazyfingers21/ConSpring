<?php
    class MakeDatabase{
        public static function make_default($database){
            if(strtolower($database) != "sole_db"){
                try{
                    $res = file_get_contents(".env");
                    $conf = explode("
",$res);
                    $DB_HOST = explode('=',$conf[7])[1];
                    $DB_USERNAME= explode('=',$conf[9])[1];
                    $DB_PASSWORD = explode('=',$conf[10])[1];
                    
                    $DB_CONN = new PDO( 'mysql:host='.$DB_HOST.';', $DB_USERNAME, $DB_PASSWORD);
                    $DB_CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $SEARCH = false;
                    $SQL = $DB_CONN->prepare("SHOW DATABASES");
                    $SQL->execute();
                    $fillable = $SQL->fetchAll(PDO::FETCH_ASSOC);
                    foreach($fillable as $a){
                        if($database == $a["Database"]){
                            $SEARCH = TRUE;
                        }
                    }
                    if(!$SEARCH){
                        $DB_CONN = new PDO( 'mysql:host='.$DB_HOST.';', $DB_USERNAME, $DB_PASSWORD);
                        $DB_CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $SQL = $DB_CONN->prepare("CREATE DATABASE `$database`");
                        $SQL->execute();
                        echo("\e[1;32;40mDatabase ".$database." created successfully.\e[0m\n");
                    }else{
                        echo("\e[1;33;40mDatabase ".$database." already exist.\e[0m\n");
                    }
                    
                }catch(PDOException $e){
                    echo("\e[1;33;41mDatabase Connection Failed:\e[0m \e[1;33;40m".$e->getMessage()."\e[0m");
                }    
            }else{
                echo("\e[1;33;41mYou can't use $database as database name.\e[0m\n");
            }
        }
        public static function make_json($database){
            if(strtolower($database) != "sole_db"){
                if(MakeDatabase::$a){
                    if(explode(':',MakeDatabase::$u)[0] == "-u" && explode(':',MakeDatabase::$p)[0] == "-p"){
                        if(is_dir("unite/database/json.db/".$database) === false){
                            mkdir("unite/database/json.db/".$database);
                            $db_account = [
                                "username" => md5(explode(':',MakeDatabase::$u)[1]),
                                "password" => md5(explode(':',MakeDatabase::$p)[1])
                            ];
                            file_put_contents("unite/database/json.db/".$database."/db_account.json",json_encode($db_account));
                            echo("\e[1;32;40mDatabase ".$database." created successfully.\e[0m\n");
                        }else{
                            echo("\e[1;33;40mDatabase ".$database." already exist.\e[0m\n");
                        }
                    }else{
                        echo("\e[1;33;41mCredentials should be -u:any -p:any\e[0m\n");
                    }
                }else{
                    if(is_dir("unite/database/json.db/".$database) === false){
                        mkdir("unite/database/json.db/".$database);
                        $db_account = [
                            "username" => md5(MakeDatabase::$u),
                            "password" => md5(MakeDatabase::$p)
                        ];
                        file_put_contents("unite/database/json.db/".$database."/db_account.json",json_encode($db_account));
                        echo("\e[1;32;40mDatabase ".$database." created successfully.\e[0m\n");
                    }else{
                        echo("\e[1;33;40mDatabase ".$database." already exist.\e[0m\n");
                    }
                }    
            }else{
                echo("\e[1;33;41mYou can't use $database as database name.\e[0m\n");
            }
        }
        public static $a = false;
        public static $u = "root";
        public static $p = "";
    }
?>