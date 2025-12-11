<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            "name" => "test",
            "email" => "test@test.re",
            "password" => '$2y$12$L4nHB5/548Zo1HIE6aMmeexPa6wfe2N2cqtgk3pqvEL8GdtISXubi',
            "display_name" => "Admin",
            "phone" => NULL,
            "role_id" => 1,
            "is_active" => 1,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
    }
}
