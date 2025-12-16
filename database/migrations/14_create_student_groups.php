<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('student_groups')) {
            Capsule::schema()->create('student_groups', function ($table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('name')->nullable();
                $table->string('program')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
            });
            echo "Таблица student_groups создана" . PHP_EOL;
        } else {
            echo "Таблица student_groups уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('student_groups');
    }
};
