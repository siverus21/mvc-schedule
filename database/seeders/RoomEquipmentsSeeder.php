<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomEquipmentsSeeder extends Seeder
{
    public function run()
    {
        DB::table('room_equipments')->insert([
            "room_id" => "1",
            "equipment_type_id" => "1",
            "quantity" => "10",
            "notes" => "",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
    }
}
