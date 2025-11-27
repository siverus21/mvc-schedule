<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

// Настройка подключения
$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => DB_DRIVER,
    'host'      => DB_HOST,
    'database'  => DB_DATABASE,
    'username'  => DB_USERNAME,
    'password'  => DB_PASSWORD,
    'charset'   => DB_CHARSET,
    'collation' => DB_COLLATION,
    'prefix'    => DB_PREFIX,
]);

$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();

// Добавляем запись о выполненной миграции
try {
    $migrationName = '2024_01_01_000001_create_roles_table';

    $exists = Capsule::table('migrations')
        ->where('migration', $migrationName)
        ->exists();

    if (!$exists) {
        Capsule::table('migrations')->insert([
            'migration' => $migrationName,
            'batch' => 1
        ]);
        echo "Миграция {$migrationName} добавлена в таблицу миграций\n";
    } else {
        echo "Миграция {$migrationName} уже существует в таблице миграций\n";
    }
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage() . "\n";
}
