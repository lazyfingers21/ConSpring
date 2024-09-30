<?php
    class SelfDestruct{
        public static function destruct(){
            echo "\e[1;32;40mInformation:\e[0m \e[1;33;40mSelf destruct is in progress...\e[0m\n";
            $pass = glob("*",0);
            $exceed = glob(".*",0);
            array_shift($exceed);
            array_shift($exceed);
            $pass = array_merge($pass,$exceed);

            SelfDestruct::destruct_support_file($pass);
            SelfDestruct::destruct_support_folder($pass);
            echo "\e[1;32;40mInformation:\e[0m \e[1;33;40mSelf destruction complete.\e[0m\n";
            echo "\e[1;32;40m----------------------------------------------------------------------------------------\e[0m\e[1;33;40m\e[0m\n";
            echo "\e[1;32;40mSole Framework:\e[0m \e[1;33;40mv5.1\e[0m\n";
            echo "\e[1;32;40mDeveloper:\e[0m \e[1;33;40mPaul Ian Dumdum\e[0m\n";
            echo "\e[1;32;40mCopyright © 2021 PID_SoloLeveler\e[0m\e[1;33;40m\e[0m\n";
            echo "\e[1;32;40mMessage:\e[0m \e[1;33;40mThank you for using this framework, if you have any concerns kindly email us.\e[0m\n";
            echo "\e[1;32;40m----------------------------------------------------------------------------------------\e[0m\e[1;33;40m\e[0m\n";
            file_put_contents("message.txt",
"----------------------------------------------------------------------------------------
Sole Framework: v5.1
Developer: Paul Ian Dumdum
Copyright © 2021 PID_SoloLeveler
Message: Thank you for using this framework, if you have any concerns kindly email us.
----------------------------------------------------------------------------------------");
            file_put_contents("sole",
"<?php
    echo '\e[1;32;40mInformation: \e[0m\e[1;33;40mFramework is unavailable.\e[0m';
?>");
            echo "\e[1;32;40m\e[0m\e[1;33;40mPress any key to continue...\e[0m\n";
            exec("pause");
        }
        public static function destruct_support_file($data = null){
            for ($i=0; $i < count($data); $i++) { 
                if(is_dir($data[$i])){
                    $pass = glob($data[$i]."/*",0);
                    $exceed = glob($data[$i]."/.*",0);
                    array_shift($exceed);
                    array_shift($exceed);
                    $pass = array_merge($pass,$exceed);
                    SelfDestruct::destruct_support_file($pass);
                }else{
                    echo "\e[1;33;40mRemoving File: \e[0m".$data[$i]."\n";
                    unlink($data[$i]);
                    echo "\e[1;31;40mRemoved File: \e[0m".$data[$i]."\n";
                }
            }
        }
        public static function destruct_support_folder($data = null){
            for ($i=0; $i < count($data); $i++) { 
                if(is_dir($data[$i])){
                    $pass = glob($data[$i]."/*",0);
                    $exceed = glob($data[$i]."/.*",0);
                    array_shift($exceed);
                    array_shift($exceed);
                    $pass = array_merge($pass,$exceed);
                    if((count($pass)) > 0){
                        SelfDestruct::destruct_support_folder($pass);
                    }else{
                        echo "\e[1;33;40mRemoving Directory: \e[0m".$data[$i]."\n";
                        rmdir($data[$i]);
                        echo "\e[1;31;40mRemoved Directory: \e[0m".$data[$i]."\n";
                    }
                }
            }
            if(count(glob("*",0)) > 0){
                SelfDestruct::destruct_support_folder(glob("*",0));
            }
        }
    }
?>