<?php
// bootstrap/seed.php
require_once __DIR__ . '/../config/config.php';
require_once ROOT . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Facade;

// 1) Настройка подключения к БД (копия из Вашего файла миграций)
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

// 2) Путь до сидеров
$seedersPath = ROOT . '/database/seeders';

if (!is_dir($seedersPath)) {
    echo "Папка сидеров не найдена: {$seedersPath}" . PHP_EOL;
    exit(1);
}

$argv = $_SERVER['argv'] ?? [];
$requestedSeeder = $argv[1] ?? null; // можно передать имя сида как аргумент

// 3) Подключаем все файлы сидеров и определяем появившиеся классы
$before = get_declared_classes();
$files = glob($seedersPath . '/*.php');

foreach ($files as $file) {
    require_once $file;
}
$after = get_declared_classes();

$newClasses = array_diff($after, $before);

// 4) Отбираем классы-сидеры
$seeders = [];
foreach ($newClasses as $class) {
    // Берём тех, чей имя оканчивается на "Seeder" и которые можно инстанцировать
    if (substr($class, -6) === 'Seeder' && class_exists($class)) {
        $ref = new ReflectionClass($class);
        if ($ref->isInstantiable()) {
            $seeders[$class] = $class;
        }
    }
}

if (empty($seeders)) {
    echo "Не найдено классов сидеров в {$seedersPath}" . PHP_EOL;
    exit(0);
}

// 5) Решаем, что запускать
$toRun = [];

if ($requestedSeeder) {
    // если указан конкретный сидер — ищем полное имя класса среди найденных
    // позволим и короткое имя (UsersTableSeeder) и полное (если используется namespace)
    $found = null;
    foreach ($seeders as $class) {
        if ($class === $requestedSeeder || str_ends_with($class, '\\' . $requestedSeeder)) {
            $found = $class;
            break;
        }
    }
    if (!$found) {
        echo "Себер '{$requestedSeeder}' не найден. Доступные: " . implode(', ', array_keys($seeders)) . PHP_EOL;
        exit(1);
    }
    $toRun[] = $found;
} elseif (class_exists('DatabaseSeeder')) {
    // если есть DatabaseSeeder — выполняем только его
    $toRun[] = 'DatabaseSeeder';
} else {
    // иначе выполняем все найденные сидеры в алфавитном порядке
    $toRun = array_keys($seeders);
    sort($toRun, SORT_STRING);
}

// 6) Запуск
echo "Будут запущены сидеры: " . implode(', ', $toRun) . PHP_EOL;

foreach ($toRun as $class) {
    try {
        if (!class_exists($class)) {
            echo "Класс {$class} не найден, пропуск..." . PHP_EOL;
            continue;
        }

        $seeder = new $class();

        // Если сидер наследует Illuminate\Database\Seeder — установим контейнер, чтобы работал $this->call()
        if (method_exists($seeder, 'setContainer')) {
            $seeder->setContainer($container);
        }

        echo "Запуск {$class}..." . PHP_EOL;

        if (!method_exists($seeder, 'run')) {
            echo "  Ошибка: у {$class} нет метода run(), пропуск." . PHP_EOL;
            continue;
        }

        $seeder->run();

        echo "  OK: {$class} выполнен." . PHP_EOL;
    } catch (Throwable $e) {
        echo "Ошибка при выполнении {$class}: " . $e->getMessage() . PHP_EOL;
        echo $e->getTraceAsString() . PHP_EOL;
    }
}

echo "Сиды завершены." . PHP_EOL;
