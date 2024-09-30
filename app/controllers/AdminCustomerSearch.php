<?php
    include('../../unite/invoker/invoke.api.php');
    class AdminCustomerSearch{
        public static function index(){
            //code here...
        }
        public static function store(){
            //code here...
        }
        public static function show(Request $request){
            $customeraccount = new CustomerAccount;
            $customeraccounts = DB::where($customeraccount,'name','like',$request->name,Data::unload("admin-customer-sort"),"asc");
            Data::json_response($customeraccounts);
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