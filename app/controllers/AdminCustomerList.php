<?php
    include('../../unite/invoker/invoke.php');
    class AdminCustomerList{
        public static function index(){
            if(Data::unload("admin-auth")){
                Data::load("admin-location","AdminCustomerList");
                $customeraccount = new CustomerAccount;
                $customeraccounts = DB::all($customeraccount,Data::unload("admin-customer-sort"),"desc");
                Route::view("administrator.customer-list",compact('customeraccounts'));
            }else{
                Route::index("Login");
            }
        }
        public static function store(Request $request){
            $customeraccount = new CustomerAccount;
            if(DB::validate($customeraccount,"username",$request->username)){
                $customeraccount->name = $request->name;
                $customeraccount->contactno = $request->contactno;
                $customeraccount->purokno = $request->purokno;
                $customeraccount->dateconnected = $request->connectiondate;
                $customeraccount->username = $request->username;
                $customeraccount->password = $request->password;
                DB::save($customeraccount);

                $billingperiod = new BillingPeriod;
                if(count(DB::all($billingperiod))){
                    $billingrecord = new BillingRecord;
                    $billingrecord->bpid = DB::all($billingperiod,'id','desc')[0]["id"];
                    $billingrecord->caid = DB::where($customeraccount,'username','=',$request->username)[0]['id'];
                    $billingrecord->preading = 0;
                    $billingrecord->creading = 0;
                    $billingrecord->used = 0;
                    $billingrecord->amount = 0;
                    $billingrecord->status = "PENDING";
                    $billingrecord->datepaid = "PENDING";
                    DB::save($billingrecord);
                } 
                Data::load("sole-message",["true","success","Customer Added"]);  
            }else{
                Data::load("sole-message",["true","warning","Username Already Existed"]);
            }
            Route::index(Data::unload("admin-location"));
        }
        public static function show(Request $request){
            $customeraccount = new CustomerAccount;
            $customeraccounts = DB::find($customeraccount,$request->id);
            $billingperiod = new BillingPeriod;
            $billingperiods = DB::all($billingperiod);
            $billingrecord = new BillingRecord;
            $billingrecords = DB::where($billingrecord,"caid","=",$request->id,'id','desc');
            Route::view("administrator.customer-view",compact('customeraccounts','billingperiods','billingrecords'));
        }
        public static function update(Request $request){
            $update = false;
            $customeraccount = new CustomerAccount;
            if(DB::find($customeraccount,$request->id)[0]['username'] == $request->username){
                $update = true;
            }else{
                if(DB::validate($customeraccount,"username",$request->username)){
                    $update = true;
                }
            }
            if($update){
                $customeraccounttemp = DB::prepare($customeraccount,$request->id);
                $customeraccounttemp->name = $request->name;
                $customeraccounttemp->contactno = $request->contactno;
                $customeraccounttemp->purokno = $request->purokno;
                $customeraccounttemp->dateconnected = $request->dateconnected;
                $customeraccounttemp->username = $request->username;
                $customeraccounttemp->password = $request->password;
                DB::update($customeraccounttemp);
                if($request->billingupdate == "true"){
                    $billingrecord = new BillingRecord;
                    $billingrecordtemp = DB::prepare($billingrecord,$request->brid);
                    $billingrecordtemp->preading = $request->preading;
                    $billingrecordtemp->creading = $request->creading;
                    $billingrecordtemp->used = $request->used;
                    $billingrecordtemp->amount = $request->amount;
                    $billingrecordtemp->status = $request->status;
                    $billingrecordtemp->datepaid = $request->datepaid;
                    DB::update($billingrecordtemp);
                }
            }else{
                echo "username exist";
            }
            Data::load("sole-message",["true","success","Record Updated"]);
            header("location: AdminCustomerList?handler&id=".$request->id);
            //Route::index(Data::unload("admin-location"));
        }
        public static function destroy(Request $request){
            if($request->type == "solo"){
                $billingrecord = new BillingRecord;
                foreach(DB::where($billingrecord,'caid','=',$request->id) as $br){
                    DB::delete($billingrecord,$br['id']);
                }
                $customeraccount = new CustomerAccount;
                DB::delete($customeraccount,$request->id);
            }else{
                $customeraccount = new CustomerAccount;
                DB::wipe($customeraccount);
                $billingrecord = new BillingRecord;
                DB::wipe($billingrecord);
            }
            Data::load("sole-message",["true","success","Record Deleted"]);
            Route::index("AdminCustomerList");
        }
        public static function handler(Request $request){
            $customeraccount = new CustomerAccount;
            $customeraccounts = DB::find($customeraccount,$request->id);
            $billingperiod = new BillingPeriod;
            $billingperiods = DB::all($billingperiod);
            $billingrecord = new BillingRecord;
            $billingrecords = DB::where($billingrecord,"caid","=",$request->id,'id','desc');
            Route::view("administrator.customer-edit",compact('customeraccounts','billingperiods','billingrecords'));
        }
    }
?>