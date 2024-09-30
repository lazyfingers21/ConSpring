<?php
    include('../../unite/invoker/invoke.php');
    class Login{
        public static function index(){
            Data::load("sole-message",["false","",""]);
            Data::load("admin-customer-sort","name");
            Data::load("admin-location","Login");
            Data::load("user-type","administrator");
            Data::load("user-location","Login");
            Data::load("admin-auth",false);
            Data::load("user-auth",false);
            Data::load("user-data","");
            Route::view("authentication.login");
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
        public static function handler(Request $request){
            //code here...
        }
    }
?>