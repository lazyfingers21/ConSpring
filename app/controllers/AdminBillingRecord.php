<?php
    include('../../unite/invoker/invoke.php');
    class AdminBillingRecord{
        public static function index(){
            if(Data::unload("admin-auth")){
                Data::load("admin-location","AdminBillingRecord");
                $billingperiod = new BillingPeriod;
                $billingperiods = DB::all($billingperiod,'id','desc');
                Route::view("administrator.billing-record",compact('billingperiods'));
            }else{
                Route::index("Login");
            }
        }
        public static function store(){
            //code here...
        }
        public static function show(Request $request){
            $billingperiod = new BillingPeriod;
            $billingperiods = DB::find($billingperiod,$request->id);
            $billingrecord = new BillingRecord;
            $billingrecords = DB::where($billingrecord,'bpid','=',$request->id);
            $customeraccount = new CustomerAccount;
            $customeraccounts = DB::all($customeraccount);
            Route::view("administrator.billing-view",compact('billingperiods','billingrecords','customeraccounts'));
        }
        public static function update(Request $request){
            $billingperiod = new BillingPeriod;
            $billingperiodtemp = DB::prepare($billingperiod,$request->id);
            $billingperiodtemp->start = $request->start;
            $billingperiodtemp->end = $request->end;
            $billingperiodtemp->collection = $request->collection;
            $billingperiodtemp->due = $request->due;
            DB::update($billingperiodtemp);
            Data::load("sole-message",["true","success","Billing Period Updated"]);
            Route::index("AdminBillingRecord");
        }
        public static function destroy(Request $request){
            if($request->type == "solo"){
                $billingrecord = new BillingRecord;
                foreach(DB::where($billingrecord,'bpid','=',$request->id) as $br){
                    DB::delete($billingrecord,$br['id']);
                }
                $billingperiod = new BillingPeriod;
                DB::delete($billingperiod,$request->id);
            }else{
                $billingrecord = new BillingRecord;
                DB::wipe($billingrecord);
                $billingperiod = new BillingPeriod;
                DB::wipe($billingperiod);
            }
            Data::load("sole-message",["true","success","Record Deleted"]);
            Route::index("AdminBillingRecord");
        }
        public static function handler(Request $request){
            //code here...
        }
    }
?>