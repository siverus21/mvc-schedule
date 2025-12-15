<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('schedule_overrides')) {
            Capsule::schema()->create('schedule_overrides', function ($table) {
                $table->id();
                $table->unsignedBigInteger('template_id');
                $table->date('date');
                $table->enum('action', ['cancel', 'replace', 'move'])->default('cancel');
                $table->unsignedBigInteger('subject_id')->nullable();
                $table->unsignedBigInteger('teacher_id')->nullable();
                $table->unsignedBigInteger('room_id')->nullable();
                $table->time('start_time')->nullable();
                $table->time('end_time')->nullable();
                $table->string('reason')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();

                // Исправляем имена индексов
                $table->index(['template_id', 'date'], 'sch_ovr_template_date_idx');
                $table->index(['date'], 'sch_ovr_date_idx');

                $table->foreign('template_id')->references('id')->on('schedule_templates')->onDelete('cascade');
                $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('set null');
                $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
                $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
            });
            echo "Таблица schedule_overrides создана" . PHP_EOL;
        } else {
            echo "Таблица schedule_overrides уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('schedule_overrides');
    }
};
