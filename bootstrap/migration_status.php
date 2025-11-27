<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Support\Facades\Facade;

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

$container = new Container;
$capsule->setEventDispatcher(new Dispatcher($container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

Facade::setFacadeApplication($container);
$container->instance('db', $capsule->getDatabaseManager());
$container->instance('files', new Filesystem);
$container->instance('schema', $capsule->schema());

// Настраиваем мигратор
$repository = new DatabaseMigrationRepository($capsule->getDatabaseManager(), 'migrations');
$migrator = new Migrator($repository, $capsule->getDatabaseManager(), $container['files']);

$migrationsPath = ROOT . '/database/migrations';

// Получаем статус миграций
$migrationFiles = $migrator->getMigrationFiles($migrationsPath);
$ranMigrations = $migrator->getRepository()->getRan();

// Преобразуем полные пути в имена файлов
$migrationFileNames = array_map(function ($file) {
    return basename($file, '.php');
}, $migrationFiles);

$pendingMigrations = array_diff($migrationFileNames, $ranMigrations);

echo "=== Статус миграций ===" . PHP_EOL;
echo "Выполненные миграции (" . count($ranMigrations) . "):" . PHP_EOL;
foreach ($ranMigrations as $migration) {
    echo "  ✓ " . $migration . PHP_EOL;
}

echo "Ожидающие миграции (" . count($pendingMigrations) . "):" . PHP_EOL;
foreach ($pendingMigrations as $migration) {
    echo "  ✗ " . $migration . PHP_EOL;
}

if (empty($pendingMigrations)) {
    echo "Все миграции выполнены!" . PHP_EOL;
} else {
    echo "Есть " . count($pendingMigrations) . " миграций, ожидающих выполнения." . PHP_EOL;
}
