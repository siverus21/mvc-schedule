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
                $table->string('staff_number')->unique()->nullable();
                $table->string('academic_title')->nullable();
                $table->string('department')->nullable();
                $table->text('bio')->nullable();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
