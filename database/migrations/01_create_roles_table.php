<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('roles')) {
            Capsule::schema()->create('roles', function ($table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('name');
                $table->text('description')->nullable();
                $table->timestamps();
            });
            echo "Таблица roles создана" . PHP_EOL;
        } else {
            echo "Таблица roles уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('roles');
    }
};
