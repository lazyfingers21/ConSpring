<?php
    include('../../unite/invoker/invoke.php');
    class UserPaymentRecord{
        public static function index(){
            if(Data::unload("user-auth")){
                Data::load("user-location","UserPaymentRecord");
                $customeraccount = new CustomerAccount;
                $customeraccounts = DB::find($customeraccount,Data::unload("user-id"));
                $billingperiod = new BillingPeriod;
                $billingperiods = DB::all($billingperiod);
                $billingrecord = new BillingRecord;
                $billingrecords = DB::where($billingrecord,"caid","=",Data::unload("user-id"),'id','desc');
                Route::view("public.records",compact('customeraccounts','billingperiods','billingrecords'));    
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