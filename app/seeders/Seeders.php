<?php
    Seed::$seeders = ["AdminAccountSeeder"];

    class UserSeeder
    {
        public static function index(){
            for ($i=0; $i < 10; $i++) { 
                $faker = new Faker;
                Seed::table("user");
                Seed::insert([
                    "name" => $faker->name(),
                    "address" => $faker->address(),
                    "email" => $faker->email(),
                    "no" => $faker->no(),
                ]);
            }
        }
    }

    class AdminAccountSeeder
    {
        public static function index(){
            Seed::table("adminaccount");
            Seed::insert([
                "type" => "administrator",
                "name" => "Administrator",
                "email" => "admin.conalum@sole.ph",
                "contactno" => "09123456789",
                "username" => "administrator",
                "password" => "administrator"
            ]);

            Seed::table("adminaccount");
            Seed::insert([
                "type" => "treasurer",
                "name" => "Treasurer",
                "email" => "treasurer.conalum@sole.ph",
                "contactno" => "09123456789",
                "username" => "treasurer",
                "password" => "treasurer"
            ]);
        }
    }
?>