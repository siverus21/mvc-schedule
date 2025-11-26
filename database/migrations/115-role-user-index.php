<?php

use Youpi\Migrations\Migration;
use Youpi\Migrations\Blueprint;

return new Migration('users', [
    'up' => function (Blueprint $table) {
        // переключаемся в режим ALTER
        $table->alter();

        // добавляем колонку role_id (unsigned bigint)
        $table->integer('role_id')->unsigned()->nullable();

        // создаём индекс (имя не обязательно)
        $table->index('role_id');

        // создаём внешний ключ: note — foreign() возвращает объект ForeignKey,
        // поэтому мы его настраиваем и явно добавляем в blueprint через addForeign()
        $fk = $table->foreign('role_id')->references('id')->on('role')->onDelete('CASCADE');
        $table->addForeign($fk);
    },
    'down' => function (string $tableName) {
        // на down обычно удаляем fk, индекс и колонку
        return "
            ALTER TABLE `{$tableName}` DROP FOREIGN KEY `fk_{$tableName}_role_id`;
            ALTER TABLE `{$tableName}` DROP INDEX `idx_{$tableName}_role_id`;
            ALTER TABLE `{$tableName}` DROP COLUMN `role_id`;
        ";
    }
]);
