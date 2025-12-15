<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomTypesSeeder extends Seeder
{
    public function run()
    {
        DB::table('room_types')->insert([
            "code" => "LECT",
            "name" => "Лекционная",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('room_types')->insert([
            "code" => "SEMINAR",
            "name" => "Семинарская",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('room_types')->insert([
            "code" => "COMP",
            "name" => "Компьютерный класс",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('room_types')->insert([
            "code" => "LAB",
            "name" => "Лаборатория",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('room_types')->insert([
            "code" => "SPORT",
            "name" => "Спортзал",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
    }
}
