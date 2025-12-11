<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            "code" => "admin",
            "name" => "Администратор",
            "description" => "Администратор системы",
            "created_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('roles')->insert([
            "code" => "redactor",
            "name" => "Редактор",
            "description" => "Редактор",
            "created_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('roles')->insert([
            "code" => "teacher",
            "name" => "Преподаватель",
            "description" => "Преподаватель",
            "created_at" => date('Y-m-d H:i:s'),
        ]);
    }
}
