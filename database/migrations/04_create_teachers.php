<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('teachers')) {
            Capsule::schema()->create('teachers', function ($table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('department_id')->nullable();
                $table->string('staff_number')->unique()->nullable();
                $table->unsignedBigInteger('academic_degree_id')->nullable();

                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade');
                $table->foreign('academic_degree_id')->references('id')->on('academic_degrees')->onDelete('cascade');
            });
            echo "Таблица teachers создана" . PHP_EOL;
        } else {
            echo "Таблица teachers уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('teachers');
    }
};
