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
        DB::table('users')->insert([
            "name" => "Test",
            "email" => "test1@test1.re",
            "password" => '$argon2id$v=19$m=65536,t=4,p=1$dTF5L3NBU0tnY0NRRzRKeg$u9TVOkjhJ31hDMM4G2fHe5m2y35DERbmptN0wNWMEpw',
            "display_name" => "Test",
            "phone" => '+79999999999',
            "role_id" => 2,
            "is_active" => 1,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            "name" => "Иванов Иван Иванович",
            "email" => "ivanov@mail.ru",
            "password" => '$argon2id$v=19$m=65536,t=4,p=1$cVBWbHN5V21oUzg1MEpqNA$ePrRCk1kvgZ1hXMGWAFBTm24veqrhtr1YP7ng5tlodg',
            "display_name" => "Иванов А.А.",
            "phone" => "+71111111111",
            "role_id" => 3,
            "is_active" => 1,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
    }
}
