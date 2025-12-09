<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('room_equipments')) {
            Capsule::schema()->create('room_equipments', function ($table) {
                $table->id();
                $table->unsignedBigInteger('room_id');
                $table->unsignedBigInteger('equipment_type_id');
                $table->integer('quantity')->default(1);
                $table->string('notes')->nullable();

                // уникальный индекс на пару (если нужна уникальность)
                $table->unique(['room_id', 'equipment_type_id']);

                $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
                $table->foreign('equipment_type_id')->references('id')->on('equipment_types')->onDelete('cascade');
            });
            echo "Таблица room_equipments создана" . PHP_EOL;
        } else {
            echo "Таблица room_equipments уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('room_equipments');
    }
};
