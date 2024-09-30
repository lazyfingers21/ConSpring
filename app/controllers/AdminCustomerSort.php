<?php
    include('../../unite/invoker/invoke.api.php');
    class AdminCustomerSort{
        public static function index(){
            //code here...
        }
        public static function store(){
            //code here...
        }
        public static function show(Request $request){
            Data::load("admin-customer-sort",$request->sortby);
            $customeraccount = new CustomerAccount;
            $customeraccounts = DB::all($customeraccount,Data::unload("admin-customer-sort"),"desc");
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