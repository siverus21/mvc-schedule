<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        if (!Capsule::schema()->hasTable('audit_logs')) {
            Capsule::schema()->create('audit_logs', function ($table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('action')->nullable();
                $table->string('object_type')->nullable();
                $table->string('object_id')->nullable();
                $table->json('data')->nullable();
                $table->timestamp('created_at')->useCurrent();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            });
            echo "Таблица audit_logs создана" . PHP_EOL;
        } else {
            echo "Таблица audit_logs уже существует, пропускаем создание" . PHP_EOL;
        }
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('audit_logs');
    }
};
