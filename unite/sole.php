<?php
    include_once('migration/migrate.php');
    include_once('migration/make.php');
    include_once('model/make.php');
    include_once('seeder/make.php');
    include_once('seeder/seed.php');
    include_once('controller/make.php');
    include_once('database/make.php');
    include_once('chain/chain.php');
    include_once('chain/disc.php');
    include_once('self destruct/self destruct.php');

    class AppLoad{
        public static function index(){
            $res = file_get_contents(".env");
            $conf = explode("
",$res);
            if($_SERVER["argc"] >= 2){
                if($_SERVER["argv"][1] == "migrate:database"){
                    if($_SERVER["argc"] > 2){
                        if($_SERVER["argv"][2] == "json"){
                            if(explode('=',$conf[7])[1] != "frameworkhost"){
                                echo "\e[1;33;40mPlease configure database host to frameworkhost.\e[0m";
                            }else{
                                if(explode('=',$conf[8])[1] != "sole_db"){
                                    Migrate::json_run();   
                                    echo "\e[1;33;40mThis JSON database management is under testing phase, you might encounter errors. Email us your concers enable for us to fix and update JSON database management.\e[0m";    
                                }else{
                                    echo "\e[1;33;40mPlease configure database name to your project database name.\e[0m";
                                }
                            }
                        }elseif($_SERVER["argv"][2] == "sql"){
                            if(explode('=',$conf[7])[1] != "localhost"){
                                echo "\e[1;33;40mPlease configure database host to localhost.\e[0m";
                            }else{
                                if(explode('=',$conf[8])[1] != "sole_db"){
                                    Migrate::default_run();     
                                }else{
                                    echo "\e[1;33;40mPlease configure database name to your project database name.\e[0m";
                                } 
                            }
                        }else{
                            echo "\e[1;31;40mInvalid script ".$_SERVER["argv"][2]."\e[0m\n";   
                        }
                    }else{
                        echo "\e[1;33;40mPlease specify database type.\e[0m";   
                    }
                }elseif($_SERVER["argv"][1] == "seed:database"){
                    if(explode('=',$conf[7])[1] != "frameworkhost"){
                        Seed::$dbtype = true;
                        Seed::default_run();
                    }else{
                        Seed::$dbtype = false;
                        Seed::json_run();   
                    }
                }elseif($_SERVER["argv"][1] == "make:database"){
                    if($_SERVER["argc"] > 2){
                        if($_SERVER["argv"][2] == "json"){
                            if(explode('=',$conf[7])[1] != "frameworkhost"){
                                echo "\e[1;33;40mPlease configure database host to frameworkhost.\e[0m";
                            }else{
                                if($_SERVER["argc"] == 6){
                                    MakeDatabase::$a = true;
                                    MakeDatabase::$u = $_SERVER["argv"][4];
                                    MakeDatabase::$p = $_SERVER["argv"][5];
                                    MakeDatabase::make_json($_SERVER["argv"][3]); 
                                    echo "\e[1;33;40mThis JSON database management is under testing phase, you might encounter errors. Email us your concers enable for us to fix and update JSON database management.\e[0m";
                                }else{
                                    if($_SERVER["argc"] >= 4){
                                        MakeDatabase::$a = false;
                                        MakeDatabase::make_json($_SERVER["argv"][3]);
                                        echo "\e[1;33;40mThis JSON database management is under testing phase, you might encounter errors. Email us your concers enable for us to fix and update JSON database management.\e[0m";
                                    }else{
                                        echo "\e[1;33;40mPlease specify database name.\e[0m\n";
                                    } 
                                }
                            }
                        }elseif($_SERVER["argv"][2] == "sql"){
                            if(explode('=',$conf[7])[1] != "localhost"){
                                echo "\e[1;33;40mPlease configure database host to localhost.\e[0m";
                            }else{
                                if($_SERVER["argc"] >= 4){
                                    MakeDatabase::make_default($_SERVER["argv"][3]);     
                                }else{
                                    echo "\e[1;33;40mPlease specify database name.\e[0m\n";
                                }  
                            }
                        }else{
                            echo "\e[1;31;40mInvalid script ".$_SERVER["argv"][2]."\e[0m\n";   
                        }
                    }else{
                        echo "\e[1;33;40mPlease specify database type.\e[0m";   
                    }
                }elseif($_SERVER["argv"][1] == "import:database"){
                    //ImportDatabase::index();
                }elseif($_SERVER["argv"][1] == "export:database"){
                    //ExportDatabase::index();
                }elseif($_SERVER["argv"][1] == "make:controller"){
                    if($_SERVER["argc"] >= 4){
                        if($_SERVER["argv"][3] == "api"){
                            MakeController::make_api($_SERVER["argv"][2]);    
                        }else{
                            echo "\e[1;31;40mInvalid script ".$_SERVER["argv"][3]."\e[0m\n";
                        }
                    }else{
                        MakeController::make_default($_SERVER["argv"][2]);
                    }
                }elseif($_SERVER["argv"][1] == "make:migration"){
                    MakeMigration::make($_SERVER["argv"][2]);
                }elseif($_SERVER["argv"][1] == "make:model"){
                    MakeModel::make($_SERVER["argv"][2]);
                }elseif($_SERVER["argv"][1] == "make:seeder"){
                    MakeSeeder::make($_SERVER["argv"][2]);
                }elseif($_SERVER["argv"][1] == "chain"){
                    Chain::index();
                }elseif($_SERVER["argv"][1] == "framework"){
                    if($_SERVER["argv"][2] == "--version"){
                        echo "\e[1;32;40mSole PHP Framework Version:\e[0m  \e[1;33;40mv5.1\e[0m\n";
                        echo "\e[1;32;40mRequired PHP Version:\e[0m  \e[1;33;40mv8.0.0^\e[0m\n";
                        echo "\e[1;32;40mCurrent PHP Version:\e[0m \e[1;33;40mv".phpversion()."\e[0m";
                    }else{
                        echo "\e[1;31;41mInvalid script ".$_SERVER["argv"][2]."\e[0m\n";   
                    }
                }elseif($_SERVER["argv"][1] == "self:destruct"){
                    echo "\e[1;33;41mWarning:\e[0m \e[1;33;40mThis will destroy the framework, and this will also delete your project.\e[0m\n";
                    echo "\e[1;33;41mWarning:\e[0m \e[1;33;40mThis can't be undone, if you wish to proceed type framework password...\e[0m\n";
                    echo "\e[1;33;41mPassword:\e[0m ";
                    $input = readline();
                    if(md5($input) == "beb7f7a395dc21ad97425bbc061afbaf"){
                        echo "\e[1;32;40mInformation:\e[0m \e[1;33;40mPassword match. Press any key to continue...\e[0m\n";
                        exec("pause");
                        SelfDestruct::destruct();
                    }
                    else{
                        echo "\e[1;32;40mInformation:\e[0m \e[1;33;40mPassword did not match, self destruct failed.\e[0m";
                    }
                }else{
                    echo "\e[1;31;40mInvalid script ".$_SERVER["argv"][1]."\e[0m\n";
                }
            }else{
                echo "\e[1;33;40mphp sole ... (please refer to the documentation for script commands)."."\e[0m\n";
            }
        }
    }
    Appload::index();
?>