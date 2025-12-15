<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('lesson_types')) {
            Capsule::schema()->create('lesson_types', function ($table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('name');
                $table->timestamps();
            });
            echo "Таблица lesson_types создана" . PHP_EOL;
        } else {
            echo "Таблица lesson_types уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('lesson_types');
    }
};
