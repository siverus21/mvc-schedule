<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EquipmentTypesSeeder extends Seeder
{
    public function run()
    {
        DB::table('equipment_types')->insert([
            "code" => "PROJECTOR",
            "name" => "Проектор",
            "description" => "HDMI, 4000 люмен",
        ]);
    }
}
