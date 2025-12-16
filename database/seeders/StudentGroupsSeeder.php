<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentGroupsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        DB::table('student_groups')->insert([
            [
                'code' => 'PI-21',
                'name' => 'ПИ-21',
                'program' => 'Программная инженерия',
                'notes' => 'Очная, 2 курс',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'IS-22',
                'name' => 'ИС-22',
                'program' => 'Информационные системы',
                'notes' => 'Очная, 2 курс',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'PM-20',
                'name' => 'ПМ-20',
                'program' => 'Прикладная математика',
                'notes' => 'Заочная, 3 курс',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'CS-23',
                'name' => 'CS-23',
                'program' => 'Компьютерные науки',
                'notes' => 'Очная, 1 курс, англ. поток',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'SE-21A',
                'name' => 'SE-21A',
                'program' => 'Разработка ПО (Software Engineering)',
                'notes' => 'Очная, 2 курс, подгруппа A',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'SE-21B',
                'name' => 'SE-21B',
                'program' => 'Разработка ПО (Software Engineering)',
                'notes' => 'Очная, 2 курс, подгруппа B',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'AI-24',
                'name' => 'AI-24',
                'program' => 'Искусственный интеллект и анализ данных',
                'notes' => 'Очная, 1 курс',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'WD-22',
                'name' => 'WD-22',
                'program' => 'Веб-разработка',
                'notes' => 'Очная, 2 курс',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'DB-23',
                'name' => 'DB-23',
                'program' => 'Базы данных',
                'notes' => 'Очная, 1 курс',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'NET-20',
                'name' => 'NET-20',
                'program' => 'Компьютерные сети и кибербезопасность',
                'notes' => 'Заочная, 3 курс',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'UX-22',
                'name' => 'UX-22',
                'program' => 'Дизайн интерфейсов и взаимодействия',
                'notes' => 'Очная, 2 курс',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'DS-21',
                'name' => 'DS-21',
                'program' => 'Data Science',
                'notes' => 'Очная, 2 курс',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'DEVOPS-23',
                'name' => 'DEVOPS-23',
                'program' => 'DevOps и облачные технологии',
                'notes' => 'Очная, 1 курс',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'MM-20',
                'name' => 'MM-20',
                'program' => 'Мультимедиа и компьютерная графика',
                'notes' => 'Заочная, 3 курс',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ENG-INTL-22',
                'name' => 'ENG-INTL-22',
                'program' => 'Международная программа (англ.)',
                'notes' => 'Очная, 2 курс, международный поток',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
