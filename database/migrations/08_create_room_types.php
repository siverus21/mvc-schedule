<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('room_types')) {
            Capsule::schema()->create('room_types', function ($table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('name');
                $table->timestamps();
            });
            echo "Таблица room_types создана" . PHP_EOL;
        } else {
            echo "Таблица room_types уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('room_types');
    }
};
