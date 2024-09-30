<?php
    $res = file_get_contents(".env");
    $conf = explode("
",$res);
    $APP_WATER_MARK_TEMP = FALSE;
    $APP_TITLE_TEMP = FALSE;
    $APP_ICON_TEMP = FALSE;

    if(strtolower(explode('=',$conf[3])[1]) == "true"){
        $APP_WATER_MARK_TEMP = TRUE; 
    }else{
        $APP_WATER_MARK_TEMP = FALSE;
    }
    if(strtolower(explode('=',$conf[4])[1]) == "true"){
        $APP_TITLE_TEMP = TRUE; 
    }else{
        $APP_TITLE_TEMP = FALSE;
    }
    if(strtolower(explode('=',$conf[5])[1]) == "true"){
        $APP_ICON_TEMP = TRUE; 
    }else{
        $APP_ICON_TEMP = FALSE;
    }
    /**
     * --------------------------------------------------------------------------------
     * Application Attributes
     * --------------------------------------------------------------------------------
     */
        $APP_NAME = explode('=',$conf[0])[1];
        $APP_DEV = explode('=',$conf[1])[1];
        
        $APP_WATER_MARK = $APP_WATER_MARK_TEMP;
        $APP_TITLE = $APP_TITLE_TEMP;
        $APP_ICON = $APP_ICON_TEMP;

        $DB_HOST = explode('=',$conf[7])[1];
        $DB_DATABASE = explode('=',$conf[8])[1];
        $DB_USERNAME= explode('=',$conf[9])[1];
        $DB_PASSWORD = explode('=',$conf[10])[1];
    /**
     * --------------------------------------------------------------------------------
     * Database Connection (Don't Modify)
     * --------------------------------------------------------------------------------
     */
    if($DB_HOST != "frameworkhost" &&  $DB_DATABASE != "sole_db"){
        try{
            $DB_CONN = new PDO( 'mysql:host='.$DB_HOST.';dbname='.$DB_DATABASE, $DB_USERNAME, $DB_PASSWORD);
            $DB_CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "\e[1;33;41mDatabase Connection Failed:\e[0m \e[1;33;40m". $e->getMessage()."\e[0m\n";
        }    
    }
?>