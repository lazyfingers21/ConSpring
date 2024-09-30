<?php
    Migrate::$migration = ["CustomerAccountMigration","BillingPeriodMigration","BillingRecordMigration","MessageMigration","AdminAccountMigration"];

    class CustomerAccountMigration
    {
        public static function index(){
            Migrate::attrib_table("customeraccount");
            Migrate::attrib_string(255);
            Migrate::string("name");
            Migrate::string("contactno");
            Migrate::string("purokno");
            Migrate::string("dateconnected");
            Migrate::string("username");
            Migrate::string("password");
        }
    }

    class BillingPeriodMigration
    {
        public static function index(){
            Migrate::attrib_table("billingperiod");
            Migrate::attrib_string(255);
            Migrate::string("start");
            Migrate::string("end");
            Migrate::string("collection");
            Migrate::string("due");
        }
    }

    class BillingRecordMigration
    {
        public static function index(){
            Migrate::attrib_table("billingrecord");
            Migrate::attrib_string(255);
            Migrate::string("caid");
            Migrate::string("bpid");
            Migrate::string("preading");
            Migrate::string("creading");
            Migrate::string("used");
            Migrate::string("amount");
            Migrate::string("status");
            Migrate::string("datepaid");
        }
    }

    class MessageMigration
    {
        public static function index(){
            Migrate::attrib_table("message");
            Migrate::attrib_string(500);
            Migrate::string("caid");
            Migrate::string("message");
            Migrate::string("status");
        }
    }

    class AdminAccountMigration
    {
        public static function index(){
            Migrate::attrib_table("adminaccount");
            Migrate::attrib_string(255);
            Migrate::string("type");
            Migrate::string("name");
            Migrate::string("email");
            Migrate::string("contactno");
            Migrate::string("username");
            Migrate::string("password");
        }
    }
?>