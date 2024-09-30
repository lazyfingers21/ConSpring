<?php 
    session_start();
    $res = file_get_contents('../../.env');
    $conf = explode('
',$res);
    $link = $_SESSION["soleexceptionserver"]["REQUEST_SCHEME"]."://".$_SESSION["soleexceptionserver"]["SERVER_NAME"].":".$_SESSION["soleexceptionserver"]["SERVER_PORT"].$_SESSION["soleexceptionserver"]["REDIRECT_URL"];
    if($_SESSION["soleexceptionstatus"]){
        $_SESSION["soleexceptionstatus"] = false;
?>
<title><?php echo explode('=',$conf[0])[1];?></title>
<link rel="shortcut icon" href="../../public/assets/icons/favicon.ico" type="image/x-icon">
<div class="main_card">
    <div class="card_head">
        <img src="../../public/assets/icons/favicon.ico" alt="">
        <h5><?php echo($_SESSION["soleexceptionserver"]["SCRIPT_FILENAME"]);?></h5>    
    </div>
    <hr>
    <div class="message_card">
        <h2><?php echo($_SESSION["soleexceptionerror"][1]);?></h2>
        <a target="_blank" href="<?php echo($link);?>"><?php echo($link);?></a>
    </div>
</div>
<div class="main_card">
    <div class="bottom_card">
        <h4>Stack Trace</h4>
        <hr>
        <div class="stack_trace">
            <table>
                <th>
                    <tr>
                        <td class="ltd">Message</td>
                        <td class="rtd"><?php echo $_SESSION["soleexceptionerror"][1];?></td>
                    </tr>
                    <tr>
                        <td class="ltd">File</td>
                        <td class="rtd"><?php echo $_SESSION["soleexceptionerror"][2];?></td>
                    </tr>
                    <tr>
                        <td class="ltd">Line</td>
                        <td class="rtd"><?php echo $_SESSION["soleexceptionerror"][3];?></td>
                    </tr>
                </th>
            </table>
        </div>
        <h4>Server</h4>
        <hr>
        <div class="stack_trace">
            <table>
                <th>
                    <tr>
                        <td class="ltd">SERVER_NAME</td>
                        <td class="rtd"><?php echo $_SESSION["soleexceptionserver"]["SERVER_NAME"];?></td>
                    </tr>
                    <tr>
                        <td class="ltd">SERVER_PORT</td>
                        <td class="rtd"><?php echo $_SESSION["soleexceptionserver"]["SERVER_PORT"];?></td>
                    </tr>
                    <tr>
                        <td class="ltd">HTTP_CONNECTION</td>
                        <td class="rtd"><?php echo $_SESSION["soleexceptionserver"]["HTTP_CONNECTION"];?></td>
                    </tr>
                    <tr>
                        <td class="ltd">HTTP_USER_AGENT</td>
                        <td class="rtd"><?php echo $_SESSION["soleexceptionserver"]["HTTP_USER_AGENT"];?></td>
                    </tr>
                    <tr>
                        <td class="ltd">REDIRECT_URL</td>
                        <td class="rtd"><?php echo $_SESSION["soleexceptionserver"]["REDIRECT_URL"];?></td>
                    </tr>
                    <tr>
                        <td class="ltd">REQUEST_METHOD</td>
                        <td class="rtd"><?php echo $_SESSION["soleexceptionserver"]["REQUEST_METHOD"];?></td>
                    </tr>
                </th>
            </table>
        </div>
    </div>
</div>
<style>
    body{
        font-family: arial;
        background: #dadada;
        color: #3d3d3d;
    }
    .main_card{
        width: 85%;
        padding: 30px;
        margin: auto;
        margin-top: 20px;
        background: white;
        border-radius: 3px;
    }
    .main_card a{
        text-decoration: none;
        color: #2b007a;
    }
    .main_card a:hover{
        color: orangered;
    }
    .card_head{
        padding: 3px;
        display: flex;
    }
    .card_head img{
        margin-top: 15px;
        padding-right: 10px;
        width: 25px;
        height: 25px;
    }
    .card_head textarea{
        width: 100%;
        outline: 0px;
        font-size: 15px;
    }
    .message_card{
        padding: 10px;
        color: #2b007a;
    }
    .stack_trace{
        width: 90%;
        margin: auto;
    }
    .stack_trace table{
        width: 100%;
    }
    .ltd{
        text-align: right; 
        border-right: solid 1px gray; 
        padding-right: 20px;
        font-weight: bolder;
        padding-bottom: 20px;
        width: 200px;
    }
    .rtd{
        text-align: left; 
        padding-left: 20px;
        font-weight: bolder;
        padding-bottom: 20px;
        font-style: italic;
        color: orangered;
    }
</style>
<?php
    }else{
        header("location: $link");
    }
?>