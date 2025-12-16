<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonTypesSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        DB::table('lesson_types')->insert([
            [
                'code' => 'LECTION',
                'name' => 'Лекция',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'SEMINAR',
                'name' => 'Семинар',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'LAB',
                'name' => 'Лабораторная работа',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'PRACTICAL',
                'name' => 'Практическое занятие',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'PRACTICUM',
                'name' => 'Практикум',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'CONSULTATION',
                'name' => 'Консультация',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'EXAM',
                'name' => 'Экзамен',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'CREDIT',
                'name' => 'Зачёт',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'WORKSHOP',
                'name' => 'Мастерская / Workshop',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ONLINE',
                'name' => 'Онлайн-занятие',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'INDEPENDENT',
                'name' => 'Самостоятельная работа',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'INTERNSHIP',
                'name' => 'Производственная практика',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'CONTROL',
                'name' => 'Контрольная работа',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'COLLOQUIUM',
                'name' => 'Коллоквиум',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'COURSE_PROJECT',
                'name' => 'Курсовой проект / защита',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
