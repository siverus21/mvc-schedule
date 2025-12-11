<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('users')) {
            Capsule::schema()->create('users', function ($table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('display_name')->nullable();
                $table->string('phone')->nullable();

                $table->unsignedBigInteger('role_id')->default(3);

                $table->boolean('is_active')->default(true);
                $table->timestamps();

                $table->foreign('role_id')->references('id')->on('roles');
            });
            echo "Таблица users создана" . PHP_EOL;
        } else {
            echo "Таблица users уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('users');
    }
};
