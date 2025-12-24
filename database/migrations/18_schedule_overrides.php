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

                $table->timestamps();
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
