<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('academic_years')) {
            Capsule::schema()->create('academic_years', function ($table) {
                $table->id();
                $table->string('code')->unique();
                $table->date('start_date');
                $table->date('end_date');
                $table->string('description')->nullable();
            });
            echo "Таблица academic_years создана" . PHP_EOL;
        } else {
            echo "Таблица academic_years уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('academic_years');
    }
};
