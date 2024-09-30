<?php
    include('../../unite/invoker/invoke.php');
    class AdminDashboard{
        public static function index(){
            if(Data::unload("admin-auth")){
                Data::load("admin-location","AdminDashboard");
                $billingperiod = new BillingPeriod;
                $billingperiods = DB::all($billingperiod,'id','desc');
                $billingrecord = new BillingRecord;
                $paid = count(DB::where($billingrecord,'status','=','PAID'));
                $pending = count(DB::where($billingrecord,'status','=','PENDING'));
                $overdue = count(DB::where($billingrecord,'status','=','OVERDUE'));
                $statistic = array($paid,$pending,$overdue);
                Route::view("administrator.dashboard",compact('billingperiods','statistic'));
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