<?php
    include('../../unite/invoker/invoke.php');
    class AdminLogin{
        public static function index(){
            if(!Data::unload("admin-auth")){
                Data::load("admin-location","AdminLogin");
                Route::view("authentication.admin-login");
            }else{
                Route::index(Data::unload("admin-location"));
            }
        }
        public static function store(){
            //code here...
        }
        public static function show(Request $request){
            $adminaccount = new AdminAccount;
            if(Data::unload("user-type") == "administrator"){
                $admin = DB::find($adminaccount,1);
                if($admin[0]['username'] == $request->username && $admin[0]['password'] == $request->password){
                    Data::load("sole-message",["true","info","Welcome Admin!"]);
                    Data::load("admin-auth",true);
                    Data::load("admin",$admin);
                    Route::index("AdminDashboard");
                }else{
                    Data::load("sole-message",["true","warning","Incorrect Username & Password"]);
                    Route::index("AdminLogin");
                }
            }else{
                $admin = DB::find($adminaccount,2);
                if($admin[0]['username'] == $request->username && $admin[0]['password'] == $request->password){
                    Data::load("sole-message",["true","info","Welcome Treasurer!"]);
                    Data::load("admin-auth",true);
                    Data::load("admin",$admin);
                    Route::index("AdminDashboard",compact("admin"));
                }else{
                    Data::load("sole-message",["true","warning","Incorrect Username & Password"]);
                    Route::index("AdminLogin");
                }
            }
        }
        public static function update(Request $request){
            $adminaccount = new AdminAccount;
            $temp = DB::prepare($adminaccount,$request->id);
            $temp->name = $request->name;
            $temp->email = $request->email;
            $temp->contactno = $request->contactno;
            $temp->username = $request->username;
            $temp->password = $request->password;
            DB::update($temp);
            Data::load("admin",DB::find($adminaccount,$request->id));
            Data::load("sole-message",["true","success","Changes Saved!"]);
            Route::index(Data::unload("admin-location"));
        }
        public static function destroy(){
            Data::load("user-type","administrator");
            Data::load("admin-auth",false);
            Route::index("Login");
        }
        public static function handler(Request $request){
            if($request->type){
                Data::load("user-type","administrator");
            }else{
                Data::load("user-type","treasurer");
            }
            Route::index("AdminLogin");
        }
    }
?>