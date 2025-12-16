<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemestersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        DB::table('semesters')->insert([
            [
                'name' => '1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
