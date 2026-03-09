<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $rooms = [
            ['building_id' => 1, 'code' => '101', 'name' => '101', 'capacity' => 80, 'room_type_id' => 1, 'floor' => 1],
            ['building_id' => 1, 'code' => '102', 'name' => '102', 'capacity' => 60, 'room_type_id' => 1, 'floor' => 1],
            ['building_id' => 1, 'code' => '201', 'name' => '201', 'capacity' => 40, 'room_type_id' => 2, 'floor' => 2],
            ['building_id' => 1, 'code' => '202', 'name' => '202', 'capacity' => 40, 'room_type_id' => 2, 'floor' => 2],
            ['building_id' => 1, 'code' => '301', 'name' => 'Компьютерный класс 1', 'capacity' => 25, 'room_type_id' => 3, 'floor' => 3],
            ['building_id' => 1, 'code' => '302', 'name' => 'Компьютерный класс 2', 'capacity' => 25, 'room_type_id' => 3, 'floor' => 3],
            ['building_id' => 1, 'code' => '401', 'name' => 'Лаборатория физики', 'capacity' => 20, 'room_type_id' => 4, 'floor' => 4],
            ['building_id' => 1, 'code' => '501', 'name' => 'Спортзал', 'capacity' => 50, 'room_type_id' => 5, 'floor' => 5],
            ['building_id' => 1, 'code' => '601', 'name' => 'Конференц-зал', 'capacity' => 30, 'room_type_id' => 8, 'floor' => 6],
            ['building_id' => 1, 'code' => '602', 'name' => 'Читальный зал', 'capacity' => 60, 'room_type_id' => 10, 'floor' => 6],
        ];

        foreach ($rooms as $r) {
            DB::table('rooms')->insert([
                'building_id' => $r['building_id'],
                'code' => $r['code'],
                'name' => $r['name'],
                'capacity' => $r['capacity'],
                'room_type_id' => $r['room_type_id'],
                'floor' => $r['floor'],
                'notes' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
