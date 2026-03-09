<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomEquipmentsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            ['room_id' => 1, 'equipment_type_id' => 1, 'quantity' => 2],
            ['room_id' => 1, 'equipment_type_id' => 2, 'quantity' => 25],
            ['room_id' => 2, 'equipment_type_id' => 1, 'quantity' => 1],
            ['room_id' => 2, 'equipment_type_id' => 2, 'quantity' => 20],
            ['room_id' => 3, 'equipment_type_id' => 3, 'quantity' => 1],
            ['room_id' => 4, 'equipment_type_id' => 4, 'quantity' => 1],
            ['room_id' => 5, 'equipment_type_id' => 2, 'quantity' => 25],
            ['room_id' => 5, 'equipment_type_id' => 1, 'quantity' => 1],
            ['room_id' => 6, 'equipment_type_id' => 2, 'quantity' => 25],
            ['room_id' => 7, 'equipment_type_id' => 7, 'quantity' => 5],
        ];

        foreach ($data as $row) {
            DB::table('room_equipments')->insert([
                'room_id' => $row['room_id'],
                'equipment_type_id' => $row['equipment_type_id'],
                'quantity' => $row['quantity'],
                'notes' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
