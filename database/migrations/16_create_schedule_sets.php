<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('schedule_sets')) {
            Capsule::schema()->create('schedule_sets', function ($table) {
                $table->id();
                $table->unsignedBigInteger('student_group_id');
                $table->unsignedBigInteger('semester_id');
                $table->unsignedBigInteger('academic_year_id');
                $table->string('name')->nullable();
                $table->integer('version')->default(1);
                $table->boolean('is_active')->default(false);
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamp('created_at')->useCurrent();

                // Исправляем имя индекса
                $table->index(['student_group_id', 'semester_id', 'academic_year_id'], 'sch_sets_group_sem_year_idx');

                $table->foreign('student_group_id')->references('id')->on('student_groups')->onDelete('cascade');
                $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');
                $table->foreign('academic_year_id')->references('id')->on('academic_years')->onDelete('cascade');
            });
            echo "Таблица schedule_sets создана" . PHP_EOL;
        } else {
            echo "Таблица schedule_sets уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('schedule_sets');
    }
};
