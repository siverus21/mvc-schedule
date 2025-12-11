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

// Снижение риска: если используете MySQL — временно отключаем проверку внешних ключей
$driver = strtolower(DB_DRIVER);

try {
    if ($driver === 'mysql') {
        Capsule::statement('SET FOREIGN_KEY_CHECKS = 0;');
    } elseif ($driver === 'sqlite') {
        // Для SQLite (если когда-нибудь захотите) можно отключать PRAGMA
        Capsule::statement('PRAGMA foreign_keys = OFF;');
    }

    // Получаем все таблицы в базе данных (работает для MySQL)
    $tables = Capsule::select('SHOW TABLES');
    $databaseName = DB_DATABASE;
    $key = 'Tables_in_' . $databaseName;

    foreach ($tables as $table) {
        $tableName = $table->$key;
        Capsule::statement("DROP TABLE IF EXISTS `$tableName`");
        echo "Удалена таблица: $tableName" . PHP_EOL;
    }

    echo "Все таблицы удалены. Теперь запустите миграции заново." . PHP_EOL;
} catch (\Exception $e) {
    // Выводим ошибку для отладки
    fwrite(STDERR, "Ошибка при удалении таблиц: " . $e->getMessage() . PHP_EOL);
} finally {
    // Обязательно включаем проверку внешних ключей обратно
    try {
        if ($driver === 'mysql') {
            Capsule::statement('SET FOREIGN_KEY_CHECKS = 1;');
        } elseif ($driver === 'sqlite') {
            Capsule::statement('PRAGMA foreign_keys = ON;');
        }
    } catch (\Exception $e) {
        // если даже восстановление упало — сообщим, но не бросаем дальше
        fwrite(STDERR, "Не удалось восстановить проверку FK: " . $e->getMessage() . PHP_EOL);
    }
}
