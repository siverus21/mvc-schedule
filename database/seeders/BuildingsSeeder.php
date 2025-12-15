<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BuildingsSeeder extends Seeder
{
    public function run()
    {
        DB::table('buildings')->insert([
            "code" => "MAIN",
            "name" => "Главный корпус",
            "address" => "ул. Пушкина, д. 1",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('buildings')->insert([
            "code" => "SECOND",
            "name" => "Корпус 2",
            "address" => "ул. Пушкина д. 2",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('buildings')->insert([
            "code" => "THIRD",
            "name" => "Корпус 3",
            "address" => "ул. Пушкина д.3",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('buildings')->insert([
            "code" => "SPORT",
            "name" => "Спортивный комплекс",
            "address" => "ул. Пушкина д.4",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
    }
}
