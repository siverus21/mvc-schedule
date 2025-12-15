<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeachersSeeder extends Seeder
{
    public function run()
    {
        DB::table('teachers')->insert([
            "user_id" => "3",
            "department_id" => "2",
            "staff_number" => "12345",
            "academic_degree_id" => "1",
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
    }
}
