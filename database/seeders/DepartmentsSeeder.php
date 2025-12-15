<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepartmentsSeeder extends Seeder
{
    public function run()
    {
        DB::table('department')->insert([
            "code" => "ISIT",
            "name" => "Информационные системы и технологии",
            "notes" => "",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('department')->insert([
            "code" => "BIO",
            "name" => "Биология",
            "notes" => "Биология",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
    }
}
