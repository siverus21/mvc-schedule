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
        $now = date('Y-m-d H:i:s');
        $teacherPassword = '$argon2id$v=19$m=65536,t=4,p=1$cVBWbHN5V21oUzg1MEpqNA$ePrRCk1kvgZ1hXMGWAFBTm24veqrhtr1YP7ng5tlodg';

        $teachers = [
            ['name' => 'Иванов Иван Иванович', 'email' => 'ivanov@mail.ru', 'display_name' => 'Иванов И.И.', 'phone' => '+71111111111'],
            ['name' => 'Петрова Мария Сергеевна', 'email' => 'petrova@mail.ru', 'display_name' => 'Петрова М.С.', 'phone' => '+72222222222'],
            ['name' => 'Сидоров Алексей Петрович', 'email' => 'sidorov@mail.ru', 'display_name' => 'Сидоров А.П.', 'phone' => '+73333333333'],
            ['name' => 'Козлова Елена Викторовна', 'email' => 'kozlova@mail.ru', 'display_name' => 'Козлова Е.В.', 'phone' => '+74444444444'],
            ['name' => 'Новиков Дмитрий Олегович', 'email' => 'novikov@mail.ru', 'display_name' => 'Новиков Д.О.', 'phone' => '+75555555555'],
            ['name' => 'Морозова Анна Александровна', 'email' => 'morozova@mail.ru', 'display_name' => 'Морозова А.А.', 'phone' => '+76666666666'],
            ['name' => 'Волков Игорь Николаевич', 'email' => 'volkov@mail.ru', 'display_name' => 'Волков И.Н.', 'phone' => '+77777777777'],
            ['name' => 'Соколова Ольга Дмитриевна', 'email' => 'sokolova@mail.ru', 'display_name' => 'Соколова О.Д.', 'phone' => '+78888888888'],
            ['name' => 'Лебедев Сергей Андреевич', 'email' => 'lebedev@mail.ru', 'display_name' => 'Лебедев С.А.', 'phone' => '+79999999999'],
            ['name' => 'Кузнецова Татьяна Павловна', 'email' => 'kuznetsova@mail.ru', 'display_name' => 'Кузнецова Т.П.', 'phone' => '+70000000000'],
        ];

        foreach ($teachers as $t) {
            DB::table('users')->insert([
                'name' => $t['name'],
                'email' => $t['email'],
                'password' => $teacherPassword,
                'display_name' => $t['display_name'],
                'phone' => $t['phone'],
                'role_id' => 3,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
