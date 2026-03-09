<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $teachers = [
            ['user_id' => 3, 'department_id' => 2, 'staff_number' => '12345', 'academic_degree_id' => 1],
            ['user_id' => 4, 'department_id' => 1, 'staff_number' => '12346', 'academic_degree_id' => 2],
            ['user_id' => 5, 'department_id' => 2, 'staff_number' => '12347', 'academic_degree_id' => 3],
            ['user_id' => 6, 'department_id' => 1, 'staff_number' => '12348', 'academic_degree_id' => 1],
            ['user_id' => 7, 'department_id' => 2, 'staff_number' => '12349', 'academic_degree_id' => 4],
            ['user_id' => 8, 'department_id' => 1, 'staff_number' => '12350', 'academic_degree_id' => 2],
            ['user_id' => 9, 'department_id' => 2, 'staff_number' => '12351', 'academic_degree_id' => 5],
            ['user_id' => 10, 'department_id' => 1, 'staff_number' => '12352', 'academic_degree_id' => 3],
            ['user_id' => 11, 'department_id' => 2, 'staff_number' => '12353', 'academic_degree_id' => 1],
            ['user_id' => 12, 'department_id' => 1, 'staff_number' => '12354', 'academic_degree_id' => 2],
        ];

        foreach ($teachers as $t) {
            DB::table('teachers')->insert([
                'user_id' => $t['user_id'],
                'department_id' => $t['department_id'],
                'staff_number' => $t['staff_number'],
                'academic_degree_id' => $t['academic_degree_id'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
