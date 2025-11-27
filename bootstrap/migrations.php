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
use Illuminate\Database\QueryException;

// 1) Настройка подключения к БД
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

// 2) Создаем контейнер и настраиваем фасады
$container = new Container;

// Устанавливаем диспетчер событий
$capsule->setEventDispatcher(new Dispatcher($container));

// Делаем capsule глобальной и запускаем Eloquent
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Устанавливаем контейнер для фасадов
Facade::setFacadeApplication($container);

// Регистрируем основные сервисы в контейнере
$container->instance('db', $capsule->getDatabaseManager());
$container->instance('files', new Filesystem);
$container->instance('schema', $capsule->schema());

// 3) Настраиваем репозиторий миграций
$repository = new DatabaseMigrationRepository($capsule->getDatabaseManager(), 'migrations');

// Создаем таблицу для миграций, если она не существует
if (!$repository->repositoryExists()) {
    $repository->createRepository();
    echo "Таблица миграций создана" . PHP_EOL;
}

// 4) Создаем мигратор
$migrator = new Migrator($repository, $capsule->getDatabaseManager(), $container['files']);

// 5) Путь к миграциям
$migrationsPath = ROOT . '/database/migrations';

// 6) Получаем статус миграций правильным способом
$migrationFiles = $migrator->getMigrationFiles($migrationsPath);
$ranMigrations = $migrator->getRepository()->getRan();

// Преобразуем полные пути в имена файлов для сравнения
$migrationFileNames = array_map(function ($file) {
    return basename($file, '.php');
}, $migrationFiles);

$pendingMigrations = array_diff($migrationFileNames, $ranMigrations);

echo "Выполненные миграции: " . count($ranMigrations) . PHP_EOL;
echo "Ожидающие миграции: " . count($pendingMigrations) . PHP_EOL;

if (count($pendingMigrations) > 0) {
    echo "Запуск миграций..." . PHP_EOL;

    try {
        // Запускаем миграции БЕЗ setOutput()
        $migrator->run($migrationsPath);

        echo "Миграции выполнены успешно!" . PHP_EOL;

        // Показываем какие миграции были выполнены
        $newRanMigrations = $migrator->getRepository()->getRan();
        $newMigrations = array_diff($newRanMigrations, $ranMigrations);

        if (!empty($newMigrations)) {
            echo "Выполненные миграции:" . PHP_EOL;
            foreach ($newMigrations as $migration) {
                echo "  - " . $migration . PHP_EOL;
            }
        }
    } catch (QueryException $e) {
        // Обрабатываем ошибку существующей таблицы
        if (str_contains($e->getMessage(), 'already exists')) {
            echo "Ошибка: Таблица уже существует." . PHP_EOL;
            echo "Чтобы исправить это, выполните одно из следующих действий:" . PHP_EOL;
            echo "1. Удалите существующие таблицы: php bootstrap/fresh_migrate.php" . PHP_EOL;
            echo "2. Или добавьте существующие миграции в таблицу миграций: php bootstrap/fix_migrations.php" . PHP_EOL;
        } else {
            // Другие ошибки БД
            echo "Ошибка базы данных: " . $e->getMessage() . PHP_EOL;
        }
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage() . PHP_EOL;
    }
} else {
    echo "Нет новых миграций для выполнения." . PHP_EOL;
}
