<?php
    class Auto{
        public static $file = "../../unite/assets loader/link.php";
        public static function index(){
            $document = file_get_contents(Auto::$file);
            $document = "";
            for ($i=0; $i < count(Load::$CSS); $i++) { 
                $document .= '<link rel="stylesheet" href="../../public/'.Load::$CSS[$i].'">'.'
';
            }
            $css = glob("../../public/assets/css/sole.*");
            foreach($css as $ca){
                if(is_dir($ca)){
                    foreach(glob($ca."/*") as $cb){
                        if(is_file($cb)){
                            $document .= '<link rel="stylesheet" href="'.$cb.'">'.'
';                            
                        }
                    }
                }else{
                    $document .= '<link rel="stylesheet" href="'.$ca.'">'.'
';     
                }
            }

            $document .= '<link rel="stylesheet" href="../../public/app/app.css">'.'
';
            for ($i=0; $i < count(Load::$JS); $i++) { 
                $document .= '<script src="../../public/'.Load::$JS[$i].'"></script>'.'
';
            }
            $js = glob("../../public/assets/js/sole.*");
            foreach($js as $ca){
                if(is_dir($ca)){
                    foreach(glob($ca."/*") as $cb){
                        if(is_file($cb)){
                            $document .= '<script src="'.$cb.'"></script>'.'
';                            
                        }
                    }
                }else{
                    $document .= '<script src="'.$ca.'"></script>'.'
';     
                }
            }
            $document .= '<script src="../../public/app/app.js"></script>'.'
';
            file_put_contents(Auto::$file,$document); 
            include(Auto::$file);
        }
    }
    Auto::index();
?>
<?php if($APP_TITLE){?>
    <title><?php echo $APP_NAME;?></title>
<?php }?>
<?php if($APP_ICON){?>
    <link rel="shortcut icon" href="../../public/assets/icons/favicon.ico" type="image/x-icon">
<?php }?>
<?php if($APP_WATER_MARK){?>
<div class="wm">
    <img src="../../public/assets/icons/favicon.ico" alt="">
    <div>
        <h5>Sole PHP Framework</h5>
        <h6><i>Learn & Create</i></h6>    
    </div>
</div>
<style>
    .wm{
        display: flex;
        position: fixed;
        bottom: 0;
        right: 0;
        padding: 10px;
        padding-bottom: 4px;
        border: solid 1px white;
        border-radius: 5px;
        z-index: 1050;
        overflow: hidden;
        outline: 0;
        background-color: #07052bf3;
        color: white;
    }
    .wm img{
        width: 40px;
        height: 40px;
    }
    .wm div{
        margin-top: 2px;
        margin-left: 8px;
    }
    .wm h5{
        font-size: 15px;
        font-weight: bolder;
    }
    .wm h6{
        margin-bottom: 14px;
        margin-top: -10px;
        font-size: 13px;
        font-weight: bolder;
    }
</style>
<?php }?>