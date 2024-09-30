
<?php
    class Route{
        public static function load($name){
            header('location: app/controllers/'.$name);
        }
        public static function view($name, $dd = null){
            $arr = explode('.',$name);
            $location = "";
            for ($i=0; $i <= count($arr)-1; $i++) { 
                $location .= '/'.$arr[$i];
            }
            require_once("../../resources/views".$location.".sole.php");
            Auto::index();
        }
        public static function index($name){
            header('location: ../controllers/'.$name);
        }
        public static function redirect($url){
            header("location: ".$url);  
        }
        public static function return($name){
            $_SESSION['Route_Location'] = $name;
            header('location: ../controllers/'.$name);
        }
        public static function view_extend($name){
            $arr = explode('.',$name);
            $location = "";
            for ($i=0; $i <= count($arr)-1; $i++) { 
                $location .= '/'.$arr[$i];
            }
            require_once("../../resources/views".$location.".sole.php");
        }
        public static function error($name){
            $arr = explode('.',$name);
            $location = "";
            for ($i=0; $i <= count($arr)-1; $i++) { 
                $location .= '/'.$arr[$i];
            }
            if(file_exists("../../resources/temp/error".$location.".sole.php")){
                require_once("../../resources/temp/error".$location.".sole.php");    
            }else{
                echo "<h6><b>File doesn't exist in: </b> resources/temp/error$location.sole.php</h6>";
                echo "<b>Error: </b>";
            }
            Auto::index();
        }
    }
?>