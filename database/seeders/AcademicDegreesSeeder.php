<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AcademicDegreesSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        DB::table('academic_degrees')->insert([
            [
                'code' => 'CANDIDATE_OF_SCIENCE',
                'name' => 'Кандидат наук',
                'notes' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'DOCTOR_OF_SCIENCE',
                'name' => 'Доктор наук',
                'notes' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'PHD',
                'name' => 'PhD (Доктор философии)',
                'notes' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'DOCENT',
                'name' => 'Доцент',
                'notes' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'PROFESSOR',
                'name' => 'Профессор',
                'notes' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'MASTER',
                'name' => 'Магистр',
                'notes' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'BACHELOR',
                'name' => 'Бакалавр',
                'notes' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'NO_DEGREE',
                'name' => 'Без степени',
                'notes' => '',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
