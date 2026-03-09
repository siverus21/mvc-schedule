<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EquipmentTypesSeeder extends Seeder
{
    public function run()
    {
        DB::table('equipment_types')->insert([
            "code" => "PROJECTOR",
            "name" => "Проектор",
            "description" => "HDMI, 4000 люмен",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('equipment_types')->insert([
            "code" => "COMPUTER",
            "name" => "Компьютер",
            "description" => "Рабочая станция для занятий",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('equipment_types')->insert([
            "code" => "WHITEBOARD",
            "name" => "Интерактивная доска",
            "description" => "Сенсорная доска с проектором",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('equipment_types')->insert([
            "code" => "SOUND",
            "name" => "Акустическая система",
            "description" => "Колонки и микрофон для лекций",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('equipment_types')->insert([
            "code" => "VIDEO",
            "name" => "Видеоконференция",
            "description" => "Камера и ПО для онлайн-трансляций",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('equipment_types')->insert([
            "code" => "ROBOT",
            "name" => "Учебный робот",
            "description" => "Робототехнический набор для лабораторных",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('equipment_types')->insert([
            "code" => "OSCILLOSCOPE",
            "name" => "Осциллограф",
            "description" => "Измерительное оборудование для физики",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('equipment_types')->insert([
            "code" => "PRINTER",
            "name" => "Принтер",
            "description" => "Лазерный принтер для печати материалов",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('equipment_types')->insert([
            "code" => "SWITCH",
            "name" => "Коммутатор",
            "description" => "Сетевой коммутатор для практикумов",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('equipment_types')->insert([
            "code" => "SERVER",
            "name" => "Сервер",
            "description" => "Учебный сервер для курса администрирования",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
    }
}
