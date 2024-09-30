<?php
    include('../../unite/invoker/invoke.php');
    class AdminBilling{
        public static function index(){
            //code here...
        }
        public static function store(Request $request){
            $billingperiod = new BillingPeriod;
            $billingperiod->start = $request->start;
            $billingperiod->end = $request->end;
            $billingperiod->collection = $request->collection;
            $billingperiod->due = $request->due;
            DB::save($billingperiod);

            if(count(DB::all($billingperiod))){
                $bpid = DB::all($billingperiod,'id','desc')[0]["id"];
                $customeraccount = new CustomerAccount;
                foreach(DB::all($customeraccount) as $ca){
                    $caid = $ca["id"];
                    $billingrecord = new BillingRecord;
                    $billingrecord->caid = $caid;
                    $billingrecord->bpid = $bpid;
                    $billingrecord->preading = 0;
                    $billingrecord->creading = 0;
                    $billingrecord->used = 0;
                    $billingrecord->amount = 0;
                    $billingrecord->status = "PENDING";
                    $billingrecord->datepaid = "PENDING";
                    DB::save($billingrecord);
                }
            }
            Data::load("sole-message",["true","success","Added Successfully"]);
            Route::index(Data::unload("admin-location"));
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