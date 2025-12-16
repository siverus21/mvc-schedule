<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        DB::table('subjects')->insert([
            [
                'code' => 'MATH',
                'name' => 'Математика',
                'description' => 'Базовые разделы высшей математики: анализ, линейная алгебра, теория вероятностей.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'DISCRETE_MATH',
                'name' => 'Дискретная математика',
                'description' => 'Логика, множества, комбинаторика, графы и булевы функции, применяемые в информатике.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'PHYSICS',
                'name' => 'Физика',
                'description' => 'Классическая механика, электромагнетизм, основы современной физики.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'PROGRAMMING',
                'name' => 'Программирование',
                'description' => 'Введение в алгоритмы и программирование на высокоуровневом языке (структуры данных, ООП).',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ALGORITHMS',
                'name' => 'Алгоритмы и структуры данных',
                'description' => 'Анализ алгоритмов, сортировки, деревья, хеширование, сложность по времени и памяти.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'DATABASES',
                'name' => 'Базы данных',
                'description' => 'Реляционные СУБД, SQL, нормализация, индексы, транзакции, основы NoSQL.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'OPERATING_SYSTEMS',
                'name' => 'Операционные системы',
                'description' => 'Процессы, планирование, управление памятью, файловые системы, синхронизация.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'NETWORKS',
                'name' => 'Компьютерные сети',
                'description' => 'Модели OSI/TCP-IP, маршрутизация, протоколы, безопасность и практические сети.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'SOFTWARE_ENG',
                'name' => 'Разработка программного обеспечения',
                'description' => 'Жизненный цикл ПО, методологии (Agile, Scrum), проектирование, тестирование и развёртывание.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'WEB_DEVELOPMENT',
                'name' => 'Веб-разработка',
                'description' => 'HTML, CSS, JavaScript, серверная разработка, REST API, основы безопасности веб-приложений.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'MACHINE_LEARNING',
                'name' => 'Машинное обучение',
                'description' => 'Методы обучения с учителем/без учителя, регрессия, классификация, нейронные сети и оценка моделей.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ARTIFICIAL_INTELLIGENCE',
                'name' => 'Искусственный интеллект',
                'description' => 'Поиск, представление знаний, планирование, логическое выводу и основы современных ИИ-систем.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'STATISTICS',
                'name' => 'Статистика',
                'description' => 'Описательная статистика, вероятностные распределения, методы оценивания и проверка гипотез.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'SOFTWARE_TESTING',
                'name' => 'Тестирование программного обеспечения',
                'description' => 'Методы и подходы тестирования: модульное, интеграционное, системное, автоматизация тестов.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'SECURITY',
                'name' => 'Информационная безопасность',
                'description' => 'Криптография, аутентификация, контроль доступа, защита сетей и приложений.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
