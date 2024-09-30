<?php
    include('../../unite/invoker/invoke.php');
    class UserDashboard{
        public static function index(){
            if(Data::unload("user-auth")){
                Data::load("user-location","UserDashboard");
                $billingperiod = new BillingPeriod;
                $billingperiods = DB::all($billingperiod,'id','desc');
                $billingrecord = new BillingRecord;
                $records = DB::where($billingrecord,'caid','=',Data::unload("user-id"));
                $pending = 0;
                $overdue = 0;
                foreach($records as $r){
                    if($r['status'] == "PENDING"){
                        $pending++;
                    }
                    if($r['status'] == "OVERDUE"){
                        $overdue++;
                    }
                }
                $statistic = array($pending,$overdue);
                $customeraccount = new CustomerAccount;
                $customer = DB::find($customeraccount,Data::unload("user-id"));
                Data::load("user-data",$customer);
                Route::view("public.dashboard",compact('billingperiods','statistic'));    
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