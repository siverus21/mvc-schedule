<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('schedule_instances')) {
            Capsule::schema()->create('schedule_instances', function ($table) {
                $table->id();
                $table->unsignedBigInteger('student_group_id');
                $table->unsignedBigInteger('subject_id');
                $table->unsignedBigInteger('teacher_id')->nullable();
                $table->unsignedBigInteger('room_id')->nullable();
                $table->unsignedBigInteger('lesson_type_id')->nullable();
                $table->date('date');
                $table->time('start_time');
                $table->time('end_time');
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->text('notes')->nullable();

                // Исправляем имя индекса
                $table->index(['student_group_id', 'date', 'start_time'], 'sch_inst_group_date_time_idx');

                $table->foreign('student_group_id')->references('id')->on('student_groups')->onDelete('cascade');
                $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('restrict');
                $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
                $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
                $table->foreign('lesson_type_id')->references('id')->on('lesson_types')->onDelete('set null');
            });
            echo "Таблица schedule_instances создана" . PHP_EOL;
        } else {
            echo "Таблица schedule_instances уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('schedule_instances');
    }
};
