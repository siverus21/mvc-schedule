<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('buildings')) {
            Capsule::schema()->create('buildings', function ($table) {
                $table->id();
                $table->string('code')->nullable();
                $table->string('name')->nullable();
                $table->string('address')->nullable();
                $table->timestamp('created_at')->useCurrent();
            });
            echo "Таблица buildings создана" . PHP_EOL;
        } else {
            echo "Таблица buildings уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('buildings');
    }
};
