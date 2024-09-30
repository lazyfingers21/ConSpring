<?php
    $models = ["CustomerAccount","BillingPeriod","BillingRecord","Message","AdminAccount"];

    class CustomerAccount
    {
        public $table = "customeraccount";
        public $fillable = [
            "name",
            "contactno",
            "purokno",
            "dateconnected",
            "username",
            "password"
        ];
    }

    class BillingPeriod
    {
        public $table = "billingperiod";
        public $fillable = [
            "start",
            "end",
            "collection",
            "due"
        ];
    }

    class BillingRecord
    {
        public $table = "billingrecord";
        public $fillable = [
            "caid",
            "bpid",
            "preading",
            "creading",
            "used",
            "amount",
            "status",
            "datepaid"
        ];
    }

    class Message
    {
        public $table = "message";
        public $fillable = [
            "caid",
            "message",
            "status"
        ];
    }

    class AdminAccount
    {
        public $table = "adminaccount";
        public $fillable = [
            "type",
            "name",
            "email",
            "contactno",
            "username",
            "password"
        ];
    }
?>