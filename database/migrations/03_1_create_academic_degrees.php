<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('academic_degrees')) {
            Capsule::schema()->create('academic_degrees', function ($table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('name');
                $table->string('notes')->nullable();
                $table->timestamps();
            });
            echo "Таблица academic_degrees создана" . PHP_EOL;
        } else {
            echo "Таблица academic_degrees уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('academic_degrees');
    }
};
