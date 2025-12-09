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
        ]);
        DB::table('room_types')->insert([
            "code" => "SEMINAR",
            "name" => "Семинарская",
        ]);
        DB::table('room_types')->insert([
            "code" => "COMP",
            "name" => "Компьютерный класс",
        ]);
        DB::table('room_types')->insert([
            "code" => "LAB",
            "name" => "Лаборатория",
        ]);
        DB::table('room_types')->insert([
            "code" => "SPORT",
            "name" => "Спортзал",
        ]);
    }
}
