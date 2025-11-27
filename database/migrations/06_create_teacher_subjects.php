<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('teacher_subjects')) {
            Capsule::schema()->create('teacher_subjects', function ($table) {
                $table->unsignedBigInteger('teacher_id');
                $table->unsignedBigInteger('subject_id');

                $table->primary(['teacher_id', 'subject_id']);

                $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
                $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            });
            echo "Таблица teacher_subjects создана" . PHP_EOL;
        } else {
            echo "Таблица teacher_subjects уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('teacher_subjects');
    }
};
