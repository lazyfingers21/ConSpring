<?php
    class MakeController{
        public static function make_default($controller){
            if(!is_file("app/controllers/".$controller.".php")){
                $file = $controller.".php";
                $content = "<?php
    include('../../unite/invoker/invoke.php');
    class ".$controller."{
        public static function index(){
            //code here...
        }
        public static function store(){
            //code here...
        }
        public static function show(){
            //code here...
        }
        public static function update(){
            //code here...
        }
        public static function destroy(){
            //code here...
        }
        public static function handler(Request \$request){
            //code here...
        }
    }
?>";
                $system = fopen("app/controllers/".$file,"w");
                fwrite($system,$content);
                echo("\e[1;32;40mController ".$controller." created successfully."."\e[0m");
            }else{
                echo("\e[1;33;40mController ".$controller." already exist."."\e[0m");
            }
        }
        public static function make_api($controller){
            if(!is_file("app/controllers/".$controller.".php")){
                $file = $controller.".php";
                $content = "<?php
    include('../../unite/invoker/invoke.api.php');
    class ".$controller."{
        public static function index(){
            //code here...
        }
        public static function store(){
            //code here...
        }
        public static function show(){
            //code here...
        }
        public static function update(){
            //code here...
        }
        public static function destroy(){
            //code here...
        }
        public static function handler(Request \$request){
            //code here...
        }
    }
?>";
                $system = fopen("app/controllers/".$file,"w");
                fwrite($system,$content);
                echo("\e[1;32;40mController ".$controller." created successfully.\e[0m");
            }else{
                echo("\e[1;33;40mController ".$controller." already exist."."\e[0m");
            }
        }
    }
?>