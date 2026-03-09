<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $departments = [
            ['code' => 'ISIT', 'name' => 'Информационные системы и технологии', 'notes' => ''],
            ['code' => 'BIO', 'name' => 'Биология', 'notes' => ''],
            ['code' => 'MATH', 'name' => 'Высшая математика', 'notes' => ''],
            ['code' => 'PHYS', 'name' => 'Общая физика', 'notes' => ''],
            ['code' => 'PROG', 'name' => 'Программирования', 'notes' => ''],
            ['code' => 'DB', 'name' => 'Информационных систем и баз данных', 'notes' => ''],
            ['code' => 'NET', 'name' => 'Компьютерных сетей', 'notes' => ''],
            ['code' => 'SEC', 'name' => 'Информационной безопасности', 'notes' => ''],
            ['code' => 'AI', 'name' => 'Искусственного интеллекта', 'notes' => ''],
            ['code' => 'SOFT', 'name' => 'Программной инженерии', 'notes' => ''],
        ];

        foreach ($departments as $d) {
            DB::table('department')->insert([
                'code' => $d['code'],
                'name' => $d['name'],
                'notes' => $d['notes'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
