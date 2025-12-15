<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('department')) {
            Capsule::schema()->create('department', function ($table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('name');
                $table->string('notes')->nullable();
                $table->timestamps();
            });
            echo "Таблица department создана" . PHP_EOL;
        } else {
            echo "Таблица department уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('department');
    }
};
