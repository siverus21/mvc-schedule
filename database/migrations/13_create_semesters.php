<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('semesters')) {
            Capsule::schema()->create('semesters', function ($table) {
                $table->id();
                $table->unsignedBigInteger('academic_year_id');
                $table->tinyInteger('number');
                $table->date('start_date');
                $table->date('end_date');
                $table->string('name')->nullable();
                $table->timestamps();

                $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('cascade');
            });
            echo "Таблица semesters создана" . PHP_EOL;
        } else {
            echo "Таблица semesters уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('semesters');
    }
};
