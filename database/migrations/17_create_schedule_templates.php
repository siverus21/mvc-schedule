<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('schedule_templates')) {
            Capsule::schema()->create('schedule_templates', function ($table) {
                $table->id();
                $table->unsignedBigInteger('student_group_id');
                $table->unsignedBigInteger('semester_id')->nullable();
                $table->unsignedBigInteger('subject_id');
                $table->unsignedBigInteger('teacher_id')->nullable();
                $table->unsignedBigInteger('room_id')->nullable();
                $table->unsignedBigInteger('lesson_type_id')->nullable();
                $table->tinyInteger('day_of_week');
                $table->tinyInteger('week_parity')->default(0);
                $table->time('start_time');
                $table->time('end_time');
                $table->tinyInteger('ordinal')->nullable();
                $table->text('notes')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->foreign('student_group_id')->references('id')->on('student_groups')->onDelete('cascade');
                $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('set null');
                $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('restrict');
                $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
                $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
                $table->foreign('lesson_type_id')->references('id')->on('lesson_types')->onDelete('set null');
            });
            echo "Таблица schedule_templates создана" . PHP_EOL;
        } else {
            echo "Таблица schedule_templates уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('schedule_templates');
    }
};
