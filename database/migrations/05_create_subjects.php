<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('subjects')) {
            Capsule::schema()->create('subjects', function ($table) {
                $table->id();
                $table->string('code')->unique()->nullable();
                $table->string('title');
                $table->integer('credits')->default(0);
                $table->text('description')->nullable();
            });
            echo "Таблица subjects создана" . PHP_EOL;
        } else {
            echo "Таблица subjects уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('subjects');
    }
};
