<?php
    include('../../unite/invoker/invoke.php');
    class AdminReport{
        public static function index(){
            if(Data::unload("admin-auth")){
                Data::load("admin-location","AdminReport");
                $billingrecord = new BillingRecord;
                $billingrecords = DB::all($billingrecord);
                $billingperiod = new BillingPeriod;
                $billingperiods = DB::all($billingperiod);
                Route::view('administrator.report',compact('billingrecords','billingperiods'));
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