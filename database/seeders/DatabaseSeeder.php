<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(RoomTypesSeeder::class);
        $this->call(EquipmentTypesSeeder::class);
        $this->call(BuildingsSeeder::class);
        $this->call(RoomsSeeder::class);
        $this->call(RoomEquipmentsSeeder::class);
        $this->call(DepartmentsSeeder::class);
        $this->call(AcademicDegreesSeeder::class);
        $this->call(TeachersSeeder::class);
    }
}
