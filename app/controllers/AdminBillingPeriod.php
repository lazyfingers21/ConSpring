<?php
    include('../../unite/invoker/invoke.api.php');
    class AdminBillingPeriod{
        public static function index(){
            //code here...
        }
        public static function store(){
            //code here...
        }
        public static function show(Request $request){
            $billingrecord = new BillingRecord;
            $billingrecords = DB::find($billingrecord,$request->id);
            if($billingrecords[0]['datepaid'] != "PENDING"){
                $billingrecords[0]['datepaid'] = date('Y-m-d',strtotime($billingrecords[0]['datepaid']));
            }
            Data::json_response($billingrecords);
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