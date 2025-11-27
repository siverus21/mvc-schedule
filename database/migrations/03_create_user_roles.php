<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('user_roles')) {
            Capsule::schema()->create('user_roles', function ($table) {
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('role_id');

                $table->primary(['user_id', 'role_id']);

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            });
            echo "Таблица user_roles создана" . PHP_EOL;
        } else {
            echo "Таблица user_roles уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('user_roles');
    }
};
