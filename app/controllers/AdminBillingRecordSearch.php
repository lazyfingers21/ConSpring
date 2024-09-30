<?php
    include('../../unite/invoker/invoke.api.php');
    class AdminBillingRecordSearch{
        public static function index(){
            //code here...
        }
        public static function store(){
            //code here...
        }
        public static function show(Request $request){
            $billingperiod = new BillingPeriod;
            $billingperiods = DB::where($billingperiod,'collection','like',$request->date,'asc');
            for ($i=0; $i < count($billingperiods); $i++) { 
                $billingperiods[$i]["status"] = "COMPLETE";
                $billingrecord = new BillingRecord;
                foreach(DB::where($billingrecord,'bpid','=',$billingperiods[$i]["id"]) as $br){
                    if($br['status'] == 'PENDING' || $br['status'] == 'OVERDUE'){
                        $billingperiods[$i]["status"] = "INCOMPLETE";
                    }
                }
            }
            Data::json_response($billingperiods);
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