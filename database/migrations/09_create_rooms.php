<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('rooms')) {
            Capsule::schema()->create('rooms', function ($table) {
                $table->id();
                $table->unsignedBigInteger('building_id');
                $table->string('code');
                $table->string('name')->nullable();
                $table->integer('capacity')->default(0);
                $table->unsignedBigInteger('room_type_id')->nullable();
                $table->integer('floor')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();

                $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
                $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('set null');
            });
            echo "Таблица rooms создана" . PHP_EOL;
        } else {
            echo "Таблица rooms уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('rooms');
    }
};
