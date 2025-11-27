<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

// Настройка подключения к БД
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

// Получаем все таблицы в базе данных
$tables = Capsule::select('SHOW TABLES');
$databaseName = DB_DATABASE;
$key = 'Tables_in_' . $databaseName;

foreach ($tables as $table) {
    $tableName = $table->$key;
    Capsule::statement("DROP TABLE IF EXISTS `$tableName`");
    echo "Удалена таблица: $tableName" . PHP_EOL;
}

echo "Все таблицы удалены. Теперь запустите миграции заново." . PHP_EOL;
