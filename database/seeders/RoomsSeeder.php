<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomsSeeder extends Seeder
{
    public function run()
    {
        DB::table('rooms')->insert([
            "building_id" => "1",
            "code" => "101",
            "name" => "101",
            "capacity" => "80",
            "room_type_id" => "1",
            "floor" => "1",
            "notes" => "",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
    }
}
