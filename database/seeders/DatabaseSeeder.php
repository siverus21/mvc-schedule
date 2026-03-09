<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

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
        $this->call(SubjectsSeeder::class);
        $this->call(LessonTypesSeeder::class);
        $this->call(StudentGroupsSeeder::class);
        $this->call(SemestersSeeder::class);
        $this->call(ScheduleTemplatesSeeder::class);
    }

    /**
     * Run the given seeder with console output after each (like migrations).
     */
    public function call($class, $silent = false, array $parameters = [])
    {
        $classes = Arr::wrap($class);

        foreach ($classes as $seederClass) {
            $name = is_string($seederClass) ? $seederClass : $seederClass;
            parent::call($seederClass, true, $parameters);
            echo "  - " . $name . " выполнен успешно." . PHP_EOL;
        }

        return $this;
    }
}
