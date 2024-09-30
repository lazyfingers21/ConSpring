<?php
    /**
     * include_once('unite/database/db.php');
     * include_once('unite/migration/migrate.php');
     */
    include_once('app/migrations/Migrations.php');
    class Migrate{
        public static $stat = false;
        public static function default_run(){
            for ($i=0; $i < count(Migrate::$migration); $i++) { 
                Migrate::$migration[$i]::index();
                Migrate::id();
                Migrate::timestamp();
                Migrate::commit();
            }
            if(Migrate::$stat){
                echo "\e[1;32;40mNothing to migrate.\e[0m\n\e[1;33;41mNote:\e[0m \e[1;33;40mto migrate to remaining tables, please remove the model's class name that has already been migrated from the migration array (this only applies to sql database).\e[0m";
            }
        }
        public static function commit(){
            try{
                include('unite/database/dc.cli.php');
                $SEARCH = false;
                $SQL = $DB_CONN->prepare("SHOW TABLES");
                $SQL->execute();
                $fillable = $SQL->fetchAll(PDO::FETCH_ASSOC);
                foreach($fillable as $a){
                    if($a["Tables_in_".$DB_DATABASE] == "migrations"){
                        $SEARCH = true;
                    }
                }
                if(!$SEARCH){
                    try{
                        $MIGRATION_TABLE = "migrations";
                        $MIGRATION_BLUEPRINT = "`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT, `migration` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL";
                        $SQL = "CREATE TABLE `$DB_DATABASE`.`$MIGRATION_TABLE` ($MIGRATION_BLUEPRINT , PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
                        $DB_CONN->exec($SQL);
                    }catch(PDOException $e){
                        echo "\e[1;33;41mMigration Failed: " . $e->getMessage()."\e[0m\n";
                    }
                }
                $TABLE = Migrate::$table;
                $BLUEPRINT = Migrate::$attribute;
                $SQL = "CREATE TABLE `$DB_DATABASE`.`$TABLE` ($BLUEPRINT) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
                $DB_CONN->exec($SQL);
                $DATE = new DateTime();
                $VALUES = $DATE->format('Y')."_".$DATE->format('d')."_".$DATE->format('m')."_".$DATE->format('u')."_".Migrate::$table;
                $SQL = "INSERT INTO `migrations` (`migration`) VALUES ('$VALUES')";
                $DB_CONN->exec($SQL);
                Migrate::$attribute = "";
                Migrate::$table = "";
                
                echo("\e[1;32;40mMigrated\e[0m: \e[1;33;40m".$TABLE."\e[0m\n");
            }catch(PDOException $e){
                Migrate::$stat = true;
            }
        }
        public static function attrib_table($name){
            Migrate::$table = $name;
            Migrate::$table_json = $name;
        }
        public static function attrib_string($num){
            Migrate::$string = $num;
        }
        public static function id(){
            Migrate::$attribute = "`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT ".Migrate::$attribute;
            Migrate::$attribute_json = array_reverse(Migrate::$attribute_json);
            array_push(Migrate::$attribute_json,"id");
            Migrate::$attribute_json = array_reverse(Migrate::$attribute_json);
        }
        public static function timestamp(){
            Migrate::$attribute .= " , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)";
            array_push(Migrate::$attribute_json,"created_at");
            array_push(Migrate::$attribute_json,"updated_at");
        }
        public static function string($name){
            Migrate::$attribute .= " , `".$name."` VARCHAR(".Migrate::$string.") COLLATE utf8mb4_unicode_ci NOT NULL ";
            array_push(Migrate::$attribute_json,$name);
        }
        public static function date($name){
            Migrate::$attribute .= " , `".$name."` DATETIME NOT NULL";
            array_push(Migrate::$attribute_json,$name);
        }
        public static $migration = [];
        public static $attribute = "";
        public static $attribute_json = [];
        public static $table = "";
        public static $table_json = "";
        public static $string = 255;

        public static function json_run(){
            include('unite/database/dc.cli.php');
            if(is_dir("unite/database/json.db/".$DB_DATABASE) === false){
                echo("\e[1;33;41mMigration failed: $DB_DATABASE doesn't exist.\e[0m \e[1;33;40m\n");
            }else{
                for ($i=0; $i < count(Migrate::$migration); $i++) { 
                    Migrate::$migration[$i]::index();
                    Migrate::id();
                    Migrate::timestamp();
                    Migrate::commit_json($DB_DATABASE);
                }
            } 
        }
        public static function commit_json($DB_DATABASE){
            $json = [
                "table" => Migrate::$table_json,
                "attribute" => Migrate::$attribute_json,
                "index" => 0,
                "data" => [],
            ];
            $file = Migrate::$table_json.".json";
            if(is_file("unite/database/json.db/".$DB_DATABASE."/".$file) === false){
                $file_write = fopen("unite/database/json.db/".$DB_DATABASE."/".$file,"w");
                fwrite($file_write,json_encode($json));    
            }
            echo("\e[1;32;40mMigrated\e[0m: \e[1;33;40m".Migrate::$table_json."\e[0m\n");
            Migrate::$attribute_json = [];
            Migrate::$table_json = [];
        }
    }
?>