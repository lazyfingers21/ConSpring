<?php
    include('../../unite/invoker/invoke.php');
    class UserMessage{
        public static function index(){
            if(Data::unload("user-auth")){
                Data::load("user-location","UserMessage");
                $message = new Message;
                $messages = Data::reverse(DB::where($message,"caid","=",Data::unload("user-id")));
                Route::view("public.message",compact('messages'));    
            }else{
                Route::index("Login");
            }
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