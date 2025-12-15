<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('equipment_types')) {
            Capsule::schema()->create('equipment_types', function ($table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('name');
                $table->text('description')->nullable();
                $table->timestamps();
            });
            echo "Таблица equipment_types создана" . PHP_EOL;
        } else {
            echo "Таблица equipment_types уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('equipment_types');
    }
};
