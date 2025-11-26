<?php

namespace Youpi\Migrations;

use Youpi\Database;
use Exception;

class Migrator
{
    protected string $migrationsPath;
    protected Database $db;

    public function __construct(string $migrationsPath = __DIR__ . '/../../../../database/migrations/')
    {
        $this->migrationsPath = rtrim($migrationsPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $this->db = new Database();

        // при создании удостоверимся, что папка существует
        if (!is_dir($this->migrationsPath)) {
            throw new Exception("Migrations path not found: {$this->migrationsPath}");
        }
    }

    /**
     * Убедиться, что таблица migrations существует
     */
    public function ensureMigrationsTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `migrations` (
            `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(255) NOT NULL,
            `table_name` VARCHAR(255) NOT NULL,
            `batch` INT NOT NULL,
            `executed_at` DATETIME NOT NULL,
            `up_sql` TEXT NULL,
            `down_sql` TEXT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        // exec через Database
        $this->db->exec($sql);
    }

    /**
     * Сканирует папку, сортирует файлы по алфавиту и возвращает полный путь-список
     * @return string[]
     */
    protected function scanMigrationFiles(): array
    {
        $files = glob($this->migrationsPath . '*.php');
        sort($files, SORT_STRING); // алфавитная сортировка
        return $files;
    }

    /**
     * Выполнить все миграции (алфавитно)
     */
    public function runAll(): void
    {
        $this->ensureMigrationsTable();
        $files = $this->scanMigrationFiles();

        if (empty($files)) {
            echo "No migration files in {$this->migrationsPath}\n";
            return;
        }

        foreach ($files as $file) {
            $this->runFile($file);
        }

        echo "All migrations executed.\n";
    }

    /**
     * Выполнить конкретный файл. $name может быть именем файла (с расширением или без)
     */
    public function runOne(string $name): void
    {
        $this->ensureMigrationsTable();

        // попытка найти файл: если передано без пути — ищем в каталоге миграций
        $path = $name;
        if (!file_exists($path)) {
            // попробовать добавить .php
            $attempts = [
                $this->migrationsPath . $name,
                $this->migrationsPath . $name . '.php',
            ];
            $found = null;
            foreach ($attempts as $a) {
                if (file_exists($a)) {
                    $found = $a;
                    break;
                }
            }
            if (!$found) {
                // также поиск по полному совпадению имени в каталоге
                foreach ($this->scanMigrationFiles() as $f) {
                    if (basename($f) === $name || basename($f) === $name . '.php') {
                        $found = $f;
                        break;
                    }
                }
            }
            if (!$found) {
                throw new Exception("Migration file not found: {$name}");
            }
            $path = $found;
        }

        $this->runFile($path);
        echo "Migration {$path} executed.\n";
    }

    /**
     * Выполнить файл миграции по полному пути
     */
    protected function runFile(string $filePath): void
    {
        $basename = basename($filePath);
        echo "Running migration: {$basename}\n";

        // попытка проверить по filename — оборачиваем в try
        try {
            $row = $this->db->query("SELECT id FROM `migrations` WHERE `filename` = ? LIMIT 1", [$basename])->getOne();
        } catch (\Throwable $e) {
            // Если ошибка про неизвестный столбец - попытаемся починить таблицу сами
            if (
                stripos($e->getMessage(), 'Unknown column') !== false
                || stripos($e->getMessage(), "1054") !== false
            ) {

                echo "  Notice: column `filename` not found, attempting to repair migrations table...\n";

                // Проверим, есть ли поле filename
                $col = $this->db->query("SHOW COLUMNS FROM `migrations` LIKE 'filename'")->getOne();
                if (!$col) {
                    // добавляем колонку
                    try {
                        $this->db->exec("ALTER TABLE `migrations` ADD COLUMN `filename` VARCHAR(255) NULL AFTER `table_name`;");
                        echo "  Notice: column `filename` added.\n";
                    } catch (\Throwable $ex) {
                        // лог и выброс, если не удалось
                        echo "  Warning: failed to add column `filename`: " . $ex->getMessage() . "\n";
                        throw $ex;
                    }
                }

                // Попытаемся создать уникальный индекс (если это важно)
                try {
                    $idx = $this->db->query("SHOW INDEX FROM `migrations` WHERE Key_name = 'migration_filename_unique'")->getOne();
                    if (!$idx) {
                        // создание индекса может упасть, если в таблице уже есть дубли/NULL
                        $this->db->exec("CREATE UNIQUE INDEX `migration_filename_unique` ON `migrations` (`filename`);");
                    }
                } catch (\Throwable $ex) {
                    // не критично — просто логируем
                    error_log("Could not create unique index migration_filename_unique: " . $ex->getMessage());
                }

                // повторная попытка SELECT
                $row = $this->db->query("SELECT id FROM `migrations` WHERE `filename` = ? LIMIT 1", [$basename])->getOne();
            } else {
                // иная ошибка — пробрасываем
                throw $e;
            }
        }

        if ($row) {
            echo "  SKIPPED (already applied)\n";
            return;
        }

        // Загружаем объект миграции (файл должен return new Migration(...))
        $obj = require $filePath;
        if (!is_object($obj) || !is_a($obj, Migration::class)) {
            throw new \Exception("Migration file must return instance of Youpi\\Migrations\\Migration — {$filePath}");
        }

        // Установим имя файла у объекта миграции, чтобы он записал filename при вставке
        if (method_exists($obj, 'setMigrationFile')) {
            $obj->setMigrationFile($basename);
        }

        try {
            $obj->up();
            echo "  OK\n";
        } catch (\Throwable $e) {
            echo "  ERROR: " . $e->getMessage() . "\n";
            throw $e;
        }
    }


    /**
     * Rollback — откат последнего batch (все миграции с max(batch))
     */
    public function rollbackLastBatch(): void
    {
        // можно использовать Migration::rollback(), он не использует конкретное имя таблицы
        // создаём временный экземпляр (table name не важен)
        $m = new Migration('migrations_manager_placeholder', []);
        try {
            $m->rollback();
            echo "Rollback last batch completed.\n";
        } catch (Exception $e) {
            echo "Rollback error: " . $e->getMessage() . "\n";
            throw $e;
        }
    }
}
