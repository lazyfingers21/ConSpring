<?php
    include('../../unite/invoker/invoke.php');
    class UserLogin{
        public static function index(){
            if(!Data::unload("user-auth")){
                Data::load("admin-location","UserLogin");
                Route::view("authentication.user-login");    
            }else{
                Route::index(Data::unload("user-location"));
            }
        }
        public static function store(){
            //code here...
        }
        public static function show(Request $request){
            $customeraccount = new CustomerAccount;
            $customers = DB::where($customeraccount,"username","=",$request->username);
            if($customers){
                if($customers[0]['password'] == $request->password){
                    Data::load("user-auth",true);
                    Data::load("user-id",$customers[0]['id']);
                    Route::index("UserDashboard");    
                }else{
                    Data::load("sole-message",["true","warning","Incorrect Username or Password"]);
                    Route::index("UserLogin");
                }
            }else{
                Data::load("sole-message",["true","warning","Incorrect Username or Password"]);
                Route::index("UserLogin");
            }
        }
        public static function update(Request $request){
            $customeraccount = new CustomerAccount;
            $customer = DB::prepare($customeraccount,$request->id);
            $customer->name = $request->name;
            $customer->contactno = $request->contactno;
            $customer->purokno = $request->purokno;
            $customer->password = $request->password;
            DB::update($customer);
            $customer = DB::find($customeraccount,Data::unload("user-id"));
            Data::load("user-data",$customer);
            Data::load("sole-message",["true","success","Changes Saved!"]);
            Route::index(Data::unload("user-location"));
        }
        public static function destroy(){
            Data::load("user-auth",false);
            Data::load("user-id","");
            Data::load("user-data","");
            Route::index("Login");
        }
        public static function handler(Request $request){
            //code here...
        }
    }
?>