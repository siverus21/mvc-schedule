<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RoomTypesSeeder::class);
        $this->call(EquipmentTypesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(BuildingsSeeder::class);
    }
}
