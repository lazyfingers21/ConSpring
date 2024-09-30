<?php
    class DB{
        public static $br = "</br>";
        /**
         * --------------------------------------------------------------------------------
         * Read Table Data
         * --------------------------------------------------------------------------------
         */
        public static function all($data,$on=null,$or=null){
            try{
                include "../../unite/database/dc.php";
                $table = $data->table;
                $fillable = [];
                if($on && $or){
                    $SQL = $DB_CONN->prepare("SELECT * FROM `$table` ORDER BY `$table`.`$on` ".strtoupper($or));
                }else{
                    $SQL = $DB_CONN->prepare("SELECT * FROM `$table`");    
                }
                $SQL->execute();
                $fillable = $SQL->fetchAll(PDO::FETCH_ASSOC);
                return $fillable;    
            }catch(Exception $e){
                Data::load("soleexceptionerror",$e);
                echo "<b>Fetch all error: </b>".$e->getMessage().DB::$br;
            }
        }
        public static function where($data,$col,$op,$val,$on=null,$or=null){
            try{
                include "../../unite/database/dc.php";
                $table = $data->table;
                $fillable = [];
                if(strtoupper($op) == "LIKE"){
                    if($on && $or){
                        $SQL = $DB_CONN->prepare("SELECT * FROM `$table` WHERE `$col` $op '%$val%' ORDER BY `$table`.`$on` ".strtoupper($or));     
                    }else{
                        $SQL = $DB_CONN->prepare("SELECT * FROM `$table` WHERE `$col` $op '%$val%'");
                    }   
                }else{
                    if($on && $or){
                        $SQL = $DB_CONN->prepare("SELECT * FROM `$table` WHERE `$col` $op '$val' ORDER BY `$table`.`$on` ".strtoupper($or));
                    }else{
                        $SQL = $DB_CONN->prepare("SELECT * FROM `$table` WHERE `$col` $op '$val'");
                    } 
                }
                $SQL->execute();
                $fillable = $SQL->fetchAll(PDO::FETCH_ASSOC);
                return $fillable;    
            }catch(Exception $e){
                Data::load("soleexceptionerror",$e);
                echo "<b>Fetch where error: </b>".$e->getMessage().DB::$br;
            }
        }
        public static function find($data,$row){
            try{
                include "../../unite/database/dc.php";
                $table = $data->table;
                
                $SQL = $DB_CONN->prepare("SELECT * FROM `$table` WHERE `id` = '$row'");
                $SQL->execute();
                $fillable = $SQL->fetchAll(PDO::FETCH_ASSOC);
                return $fillable; 
            }catch(Exception $e){
                Data::load("soleexceptionerror",$e);
                echo "<b>Fetch find error: </b>".$e->getMessage().DB::$br;
            }

        }
        /**
         * --------------------------------------------------------------------------------
         * Create Table Data
         * --------------------------------------------------------------------------------
         */
        public static function save($data){
            $saveerror = false;
            $savemessage = "";
            try{
                include "../../unite/database/dc.php";
                $fillable = [];
                $table = $data->table;
                $columns = "";
                $values = "";
                $temp = "";
                
                for ($i=0; $i <= count($data->fillable)-1; $i++) { 
                    if($i == count($data->fillable)-1){
                        $columns .= "`".$data->fillable[$i]."`";
                        $temp = $data->fillable[$i];
                        $values .= "'".$data->$temp."'";
                        if($data->$temp == ""){
                            $saveerror = true;
                            $savemessage .= "Column ".$data->fillable[$i]." doesn't have a default value".DB::$br; 
                        }
                    }else{
                        $columns .= "`".$data->fillable[$i]."`,";
                        $temp = $data->fillable[$i];
                        $values .= "'".$data->$temp."',";
                        if($data->$temp == ""){
                            $saveerror = true;
                            $savemessage .= "Column ".$data->fillable[$i]." doesn't have a default value, ".DB::$br; 
                        }
                    }
                }
                if(!$saveerror){
                    $SQL = "INSERT INTO `$table` ($columns) VALUES ($values)";
                    $DB_CONN->exec($SQL);
                }else{
                    echo $savemessage;
                } 
            }catch(Exception $e){
                Data::load("soleexceptionerror",$e);
                echo "<b>Save error: </b>".$e->getMessage().DB::$br;
            }
        }
        /**
         * --------------------------------------------------------------------------------
         * Prepare Table Data
         * --------------------------------------------------------------------------------
         */
        public static function prepare($data, $row){
            try{
                include "../../unite/database/dc.php";
                $get = DB::find($data, $row);
                if($get != ""){
                    if(count($get) > 0){
                        for ($i=0; $i <= count($data->fillable)-1; $i++) { 
                            $temp = $data->fillable[$i];
                            $data->$temp = $get[0][$temp];
                        }
                        $data->status = TRUE;
                    }
                    else{
                        $data->status = FALSE;
                    }
                    $data->id = $row;
                    return $data;
                }else{
                    for ($i=0; $i <= count($data->fillable)-1; $i++) { 
                        $temp = $data->fillable[$i];
                        $data->$temp = "";
                    }
                    $data->id = $row;
                    return $data;  
                }
            }catch(Exception $e){
                Data::load("soleexceptionerror",$e);
                echo "<b>Prepare error: </b>".$e->getMessage().DB::$br;
            }
        }
        /**
         * --------------------------------------------------------------------------------
         * Update Table Data
         * --------------------------------------------------------------------------------
         */
        public static function update($data){
            $saveerror = false;
            $savemessage = "";
            try{
                include "../../unite/database/dc.php";
                $table = $data->table;
                $id = $data->id;
                $set = "";
                if($data->status){
                    for ($i=0; $i <= count($data->fillable)-1; $i++) { 
                        if($i == count($data->fillable)-1){
                            $temp = $data->fillable[$i];
                            $set .= "`".$data->fillable[$i]."`"." = "."'".$data->$temp."'";
                            if($data->$temp == ""){
                                $saveerror = true;
                                $savemessage .= "Column ".$data->fillable[$i]." doesn't have a default value".DB::$br; 
                            }
                        }else{
                            $temp = $data->fillable[$i];
                            $set .= "`".$data->fillable[$i]."`"." = "."'".$data->$temp."',"; 
                            if($data->$temp == ""){
                                $saveerror = true;
                                $savemessage .= "Column ".$data->fillable[$i]." doesn't have a default value, ".DB::$br; 
                            }
                        }
                    }
                    if(!$saveerror){
                        $SQL = "UPDATE `$table` SET $set WHERE `id` = '$id'";
                        $DB_CONN->exec($SQL);
                    }else{
                        echo $savemessage;
                    }     
                }
                else{
                    if($id == ""){
                        $id = "NULL";
                    }
                    echo "<b>Update error: </b> Could not find a match id.".DB::$br;
                    echo "<b>Note: </b>ID <i><b>'".$id."'</b></i> doesn't match any row data in column ID inside table <i><b>'".$table."'</i></b>".DB::$br;
                } 
            }catch(Exception $e){
                Data::load("soleexceptionerror",$e);
                echo "<b>Update error: </b>".$e->getMessage().DB::$br;
            }
        }
        /**
         * --------------------------------------------------------------------------------
         * Remove Table Data
         * --------------------------------------------------------------------------------
         */
        public static function delete($data, $row){
            try{
                include "../../unite/database/dc.php";
                $table = $data->table;
                $id = $row;
                $SQL = $DB_CONN->prepare("DELETE from `$table` WHERE `$table`.`id`='$id'");
		        $SQL->execute();
            }catch(Exception $e){
                Data::load("soleexceptionerror",$e);
                echo "<b>Delete error: </b>".$e->getMessage().DB::$br;
            }
        }
        /**
         * --------------------------------------------------------------------------------
         * Truncate Table Data
         * --------------------------------------------------------------------------------
         */
        public static function wipe($data){
            try{
                include "../../unite/database/dc.php";
                $table = $data->table;
                $SQL = $DB_CONN->prepare("TRUNCATE `$table`");
		        $SQL->execute();
            }catch(Exception $e){
                Data::load("soleexceptionerror",$e);
                echo "<b>Wipe error: </b>".$e->getMessage().DB::$br;
            }
        }
        /**
         * --------------------------------------------------------------------------------
         * Authenticate Username and Password
         * --------------------------------------------------------------------------------
         */
        public static function auth($data,$a,$b){
            try{
                include "../../unite/database/dc.php";
                $table = $data->table;
                $fillable = [];
                $bool = false;
                $SQL = $DB_CONN->prepare("SELECT * FROM `$table` WHERE `username` = '$a' AND `password` = '$b'");
                $SQL->execute();
                $fillable = $SQL->fetchAll(PDO::FETCH_ASSOC);
                if($fillable){
                    $bool = true;
                }else{
                    $bool = false;
                }
                return $bool;
            }catch(Exception $e){
                Data::load("soleexceptionerror",$e);
                echo "<b>Authenticate error: </b>".$e->getMessage().DB::$br;
                echo "<b>Note: </b>table should have a default <i>username</i> and <i>password</i> column.".DB::$br;
            }
        }
        /**
         * --------------------------------------------------------------------------------
         * Validate Table Row Data
         * --------------------------------------------------------------------------------
         */
        public static function validate($data,$col,$val){
            try{
                include "../../unite/database/dc.php";
                $table = $data->table;
                $fillable = [];
                $bool = false;
                $SQL = $DB_CONN->prepare("SELECT * FROM `$table` WHERE `$col` = '$val'");
                $SQL->execute();
                $fillable = $SQL->fetchAll(PDO::FETCH_ASSOC);
                if($fillable){
                    $bool = false;
                }else{
                    $bool = true;
                }
                return $bool;
            }catch(Exception $e){
                Data::load("soleexceptionerror",$e);
                echo "<b>Validate error: </b>".$e->getMessage().DB::$br;
            }
        }
        /**
         * --------------------------------------------------------------------------------
         * Read Table Data JSON
         * --------------------------------------------------------------------------------
         */
        public static function json_all($data){
            $json = DB::json($data);
            $res = $json->data;
            return $res;
        }
        public static function json_find($data,$id){
            $json = DB::json($data);
            $res = $json->data;
            if(array_key_exists($id,$res)){
                return array($res[$id]);
            }else{
                return array();
            }
        }
        public static function json_where($data,$col,$op,$val){
            $json = DB::json($data);
            $res = $json->data;
            $resindex = 0;
            $restemp = [];
            if($op == "LIKE"){
                /**this is WIP*/
                return array();
            }else{
                for ($i=0; $i < count($res); $i++) { 
                    if($res[$i]->$col == $val){
                        array_push($restemp,$res[$i]);
                    }
                }
                return $restemp;
            }
        }
        /**
         * --------------------------------------------------------------------------------
         * Create Table Data JSON
         * --------------------------------------------------------------------------------
         */
        public static function json_save($data){
            include "../../unite/database/dc.php";
            $res = DB::json($data);
            $data->id = $res->index;
            $date = new DateTime();
            $y = ((int) $date->format('Y'));
            $m = ((int) $date->format('m'));
            if($m < 10){$m = "0".$m;}
            $d = ((int) $date->format('d'));
            if($d < 10){$d = "0".$d;}
            $h = ((int) $date->format('h'));
            if($h < 10){$h = "0".$h;}
            $i = ((int) $date->format('i'));
            if($i < 10){$i = "0".$i;}
            $s = ((int) $date->format('s'));
            if($s < 10){$s = "0".$s;}
            $data->created_at = "$y-$m-$d $h:$i:$s";
            $data->updated_at = "$y-$m-$d $h:$i:$s";
            $res->data[$res->index] = [];
            for ($i=0; $i <= count($res->attribute)-1; $i++) {
                if($i == count($res->attribute)-1){
                    $temp = $res->attribute[$i];
                    $res->data[$res->index][$temp] = $data->$temp;
                }else{
                    $temp = $res->attribute[$i];
                    $res->data[$res->index][$temp] = $data->$temp;
                } 
            }
            //array_push($res->data,$values);
            $res->index++;
            file_put_contents("../../unite/database/json.db/".$DB_DATABASE."/".$data->table.".json",json_encode($res));
        }
        /**
         * --------------------------------------------------------------------------------
         * Prepare Table Data JSON
         * --------------------------------------------------------------------------------
         */
        public static function json_prepare($data, $id){
            include "../../unite/database/dc.php";
            $get = DB::json_find($data, $id);
            if($get){
                for ($i=0; $i <= count($data->fillable)-1; $i++) { 
                    $temp = $data->fillable[$i];
                    $data->$temp = $get[0]->$temp;
                }
                $data->id = $id;
                $data->status = TRUE;
                return $data;
            }else{
                for ($i=0; $i <= count($data->fillable)-1; $i++) { 
                    $temp = $data->fillable[$i];
                    $data->$temp = "";
                }
                $data->id = $id;
                $data->status = FALSE;
                return $data; 
            }
        }
        /**
         * --------------------------------------------------------------------------------
         * Update Table Data JSON
         * --------------------------------------------------------------------------------
         */
        public static function json_update($data){
            include "../../unite/database/dc.php";
            $res = DB::json($data);
            $date = new DateTime();
            $y = ((int) $date->format('Y'));
            $m = ((int) $date->format('m'));
            if($m < 10){$m = "0".$m;}
            $d = ((int) $date->format('d'));
            if($d < 10){$d = "0".$d;}
            $h = ((int) $date->format('h'));
            if($h < 10){$h = "0".$h;}
            $i = ((int) $date->format('i'));
            if($i < 10){$i = "0".$i;}
            $s = ((int) $date->format('s'));
            if($s < 10){$s = "0".$s;}
            $data->updated_at = "$y-$m-$d $h:$i:$s";
            array_push($data->fillable,"updated_at");
            if($data->status){
                for ($i=0; $i < count($data->fillable); $i++) {
                    $temp =  $data->fillable[$i];
                    $res->data[$data->id]->$temp = $data->$temp;
                }
                file_put_contents("../../unite/database/json.db/".$DB_DATABASE."/".$data->table.".json",json_encode($res));
            }
        }
        /**
         * --------------------------------------------------------------------------------
         * Remove Table Data JSON
         * --------------------------------------------------------------------------------
         */
        public static function json_delete($data, $id){
            include "../../unite/database/dc.php";
            $res = DB::json($data);
            $get = DB::json_find($data, $id);
            $arr_temp = [];
            $index = 0;
            if($get){
                for ($i=0; $i < count($res->data); $i++) { 
                    if($i != $id){
                        $res->data[$index] = $res->data[$i];
                        $res->data[$index]->id = $index;
                        $index++;
                    }
                }
                array_pop($res->data);
                file_put_contents("../../unite/database/json.db/".$DB_DATABASE."/".$data->table.".json",json_encode($res));
            }
        }
        /**
         * --------------------------------------------------------------------------------
         * Truncate Table Data JSON
         * --------------------------------------------------------------------------------
         */
        public static function json_wipe($data){
            include "../../unite/database/dc.php";
            $res = DB::json($data);
            $res->index = 0;
            $res->data = [];
            file_put_contents("../../unite/database/json.db/".$DB_DATABASE."/".$data->table.".json",json_encode($res));
        }
        /**
         * --------------------------------------------------------------------------------
         * Validate Table Row Data JSON
         * --------------------------------------------------------------------------------
         */
        public static function json_validate($data,$col,$val){
            include "../../unite/database/dc.php";
            $res = DB::json($data);
            $bool = true;
            for ($i=0; $i < count($res->data); $i++) { 
                if($res->data[$i]->$col == $val){
                    $bool = false;    
                }
            }
            return $bool;
        }
        /**
         * --------------------------------------------------------------------------------
         * Authenticate Username and Password JSON
         * --------------------------------------------------------------------------------
         */
        public static function json_auth($data,$a,$b){
            include "../../unite/database/dc.php";
            $res = DB::json($data);
            $bool = false;
            for ($i=0; $i < count($res->data); $i++) { 
                if($res->data[$i]->username == $a && $res->data[$i]->password == $b){
                    $bool = true;    
                }
            }
            return $bool;
        }
        /**
         * --------------------------------------------------------------------------------
         * Fetch JSON
         * --------------------------------------------------------------------------------
         */
        public static function json($data){
            include "../../unite/database/dc.php";
            if($DB_HOST == "frameworkhost"){
                if(!file_exists("../../unite/database/json.db/".$DB_DATABASE."/".$data->table.".json")){
                    echo("<b>Database error: </b> Base table or view not found: Table '$DB_DATABASE.$data->table' doesn't exist.");
                }else{
                    $db_account = json_decode(file_get_contents("../../unite/database/json.db/".$DB_DATABASE."/db_account.json"));
                    if(md5($DB_USERNAME) == $db_account->username && md5($DB_PASSWORD) == $db_account->password){
                        $json = file_get_contents("../../unite/database/json.db/".$DB_DATABASE."/".$data->table.".json");
                        $res = json_decode($json);
                        return $res;
                    }else{
                        echo "<b>Database Connection Failed: </b>Access denied for user '$DB_USERNAME'@'frameworkhost' (using password: '$DB_PASSWORD')";
                    }
                }
            }else{
                echo "<b>Database Connection Failed: </b>php_network_getaddresses: getaddrinfo failed: No such host is known.";
            }
        }
    }
?>