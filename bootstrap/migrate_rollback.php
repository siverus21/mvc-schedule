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

// Проверяем существование таблицы миграций
if (!$repository->repositoryExists()) {
    echo "Таблица миграций не существует. Нет миграций для отката." . PHP_EOL;
    exit(0);
}

echo "Откат миграций..." . PHP_EOL;

// Получаем миграции до отката
$ranMigrationsBefore = $migrator->getRepository()->getRan();

// Выполняем откат БЕЗ setOutput()
$migrator->rollback($migrationsPath);

// Получаем миграции после отката
$ranMigrationsAfter = $migrator->getRepository()->getRan();

// Определяем какие миграции были откатаны
$rolledBackMigrations = array_diff($ranMigrationsBefore, $ranMigrationsAfter);

if (!empty($rolledBackMigrations)) {
    echo "Откатаны следующие миграции:" . PHP_EOL;
    foreach ($rolledBackMigrations as $migration) {
        echo "  - " . $migration . PHP_EOL;
    }
} else {
    echo "Нет миграций для отката." . PHP_EOL;
}

echo "Откат миграций завершен." . PHP_EOL;
