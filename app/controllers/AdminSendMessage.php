<?php
    include('../../unite/invoker/invoke.php');
    class AdminSendMessage{
        public static function index(){
            if(Data::unload("admin-auth")){
                Data::load("admin-location","AdminCustomerList");
                $customeraccount = new CustomerAccount;
                $customeraccounts = DB::all($customeraccount);
                Route::view("administrator.send-message",compact('customeraccounts'));
            }else{
                Route::index("Login");
            }
        }
        public static function store(Request $request){
            $customeraccount = new CustomerAccount;
            if($request->sendto == "all"){
                foreach(DB::all($customeraccount) as $ca){
                    $message = new Message;
                    $message->caid = $ca['id'];
                    $message->message = $request->message;
                    $message->status = 0;
                    DB::save($message);
                }
            }else{
                $message = new Message;
                $message->caid = DB::find($customeraccount,$request->caid)[0]['id'];
                $message->message = $request->message;
                $message->status = 0;
                DB::save($message);
            }
            Data::load("sole-message",["true","success","Message Sent"]);
            Route::index("AdminSendMessage");
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