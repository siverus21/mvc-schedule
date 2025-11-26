<?php

namespace Youpi\Migrations;

use Youpi\Database;
use Closure;
use Exception;

class Migration
{
    protected Database $db;
    protected string $table = '';
    protected array $attributes = [];
    protected ?string $migrationFile = null;

    public function __construct(string $table, array $attributes)
    {
        $this->db = new Database();
        $this->table = $table;
        $this->attributes = $attributes;
    }

    protected function sanitizeIdentifier(string $name): string
    {
        if (!preg_match('/^[A-Za-z0-9_]+$/', $name)) {
            throw new Exception("Недопустимое имя идентификатора: {$name}");
        }
        return $name;
    }

    protected function ensureMigrationsTable(): void
    {
        // создаём таблицу, если её нет
        $create = "CREATE TABLE IF NOT EXISTS `migrations` (
        `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `table_name` VARCHAR(255) NOT NULL,
        `filename` VARCHAR(255) NULL,
        `batch` INT NOT NULL,
        `executed_at` DATETIME NOT NULL,
        `up_sql` TEXT NULL,
        `down_sql` TEXT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->db->exec($create);

        // проверяем есть ли столбец filename
        $col = $this->db->query("SHOW COLUMNS FROM `migrations` LIKE 'filename'")->getOne();
        if (!$col) {
            // добавляем колонку
            $this->db->exec("ALTER TABLE `migrations` ADD COLUMN `filename` VARCHAR(255) NULL AFTER `table_name`;");
        }

        // проверяем индекс по filename (избегаем повторного добавления)
        $idx = $this->db->query("SHOW INDEX FROM `migrations` WHERE Key_name = 'migration_filename_unique'")->getOne();
        if (!$idx) {
            // создаём уникальный индекс, но если в БД уже есть NULL-записи, unique может упасть — можно пропустить, если не хотите
            try {
                $this->db->exec("CREATE UNIQUE INDEX `migration_filename_unique` ON `migrations` (`filename`);");
            } catch (\Throwable $e) {
                // если не удалось (например, есть дубли или NULL) — проигнорируем, но логируем
                error_log("Could not create unique index migration_filename_unique: " . $e->getMessage());
            }
        }
    }

    /**
     * Выполнить миграцию (up)
     *
     * @return bool
     * @throws \Exception
     */
    public function up(): bool
    {
        // Валидация имени таблицы (если нужно)
        $this->sanitizeIdentifier($this->table);

        // Убедимся, что таблица migrations существует (и содержит filename)
        $this->ensureMigrationsTable();

        // Вычисляем следующий batch
        $row = $this->db->query("SELECT IFNULL(MAX(batch), 0) as maxbatch FROM `migrations`")->getOne();
        $maxBatch = (int)($row['maxbatch'] ?? 0);
        $batch = $maxBatch + 1;

        // Подготовим Blueprint (пользователь заполнит его, если передан Closure)
        $bp = new \Youpi\Migrations\Blueprint($this->table);

        // Получаем "up" атрибут
        $upAttr = $this->attributes['up'] ?? null;
        $sqlToExecute = null;   // string or array
        if ($upAttr instanceof \Closure) {
            // Колбэк должен заполнить Blueprint (или вернуть SQL)
            $maybe = $upAttr($bp);
            // Если колбэк вернул SQL строку — используем её, иначе берём из Blueprint
            if (is_string($maybe) && trim($maybe) !== '') {
                $sqlToExecute = $maybe;
            } else {
                // Blueprint генерирует SQL; toSql может вернуть string или array
                $sqlToExecute = $bp->toSql($this->db);
            }
        } elseif (is_string($upAttr) && trim($upAttr) !== '') {
            $sqlToExecute = $upAttr;
        } else {
            throw new \Exception("Атрибут 'up' не задан или неверного типа. Ожидается Closure(Blueprint) или SQL string.");
        }

        // Подготовим down_sql (чтобы сохранить для отката)
        $downSql = null;
        $downAttr = $this->attributes['down'] ?? null;
        if ($downAttr instanceof \Closure) {
            try {
                $maybeDown = $downAttr($this->table);
                if (is_string($maybeDown) && trim($maybeDown) !== '') {
                    $downSql = $maybeDown;
                }
            } catch (\Throwable $e) {
                // если down-closure выполняет действия вместо возврата SQL — игнорируем здесь
                $downSql = null;
            }
        } elseif (is_string($downAttr) && trim($downAttr) !== '') {
            $downSql = $downAttr;
        } else {
            $downSql = "DROP TABLE IF EXISTS `{$this->table}`;";
        }

        // Выполнение: в транзакции, если возможно и если мы её начинаем
        $startedTx = false;
        try {
            if (!$this->db->inTransaction()) {
                $this->db->beginTransaction();
                $startedTx = true;
            }

            // Выполняем SQL: может быть строка или массив строк
            if (is_array($sqlToExecute)) {
                foreach ($sqlToExecute as $s) {
                    $s = trim($s);
                    if ($s === '') continue;
                    // используем exec для DDL (без параметров)
                    $this->db->exec($s);
                }
                // Для записи в БД сохраним упрощённую версию up_sql — объединённую
                $upSqlForStore = implode("\n", array_map(fn($x) => trim($x), $sqlToExecute));
            } else {
                $sqlString = trim((string)$sqlToExecute);
                if ($sqlString !== '') {
                    // Многие DDL лучше выполнять через exec
                    $this->db->exec($sqlString);
                }
                $upSqlForStore = $sqlString;
            }

            // Сохраняем запись о миграции (prepared)
            $name = ($this->migrationFile ?? ($this->table . '_' . date('Ymd_His')));
            // используем prepared insert через query()
            $this->db->query(
                "INSERT INTO `migrations` (`name`,`table_name`,`filename`,`batch`,`executed_at`,`up_sql`,`down_sql`)
             VALUES (?, ?, ?, ?, ?, ?, ?)",
                [$name, $this->table, $this->migrationFile, $batch, date('Y-m-d H:i:s'), $upSqlForStore, $downSql]
            );

            // Commit только если мы начали транзакцию и она всё ещё активна
            if ($startedTx && $this->db->inTransaction()) {
                $this->db->commit();
            }

            return true;
        } catch (\Throwable $e) {
            // Если транзакция активна — откатываем
            if ($this->db->inTransaction()) {
                try {
                    $this->db->rollBack();
                } catch (\Throwable $_) { /* игнорировать */
                }
            }
            // Пробрасываем понятное исключение
            throw new \Exception("Ошибка при выполнении миграции up: " . $e->getMessage(), 0, $e);
        }
    }


    /**
     * Выполнить down для данной таблицы (последняя запись)
     * @return bool
     * @throws Exception
     */
    public function down(): bool
    {
        $this->sanitizeIdentifier($this->table);
        $this->ensureMigrationsTable();

        $row = $this->db->query("SELECT * FROM `migrations` WHERE `table_name` = ? ORDER BY id DESC LIMIT 1", [$this->table])->getOne();

        if (!$row) {
            $sql = "DROP TABLE IF EXISTS `{$this->table}`;";
        } else {
            $sql = $row['down_sql'] ?? "DROP TABLE IF EXISTS `{$this->table}`;";
        }

        try {
            if (!$this->db->inTransaction()) {
                $this->db->beginTransaction();
                $startedTx = true;
            } else {
                $startedTx = false;
            }

            $this->db->query($sql);

            if ($row) {
                $this->db->query("DELETE FROM `migrations` WHERE id = ?", [$row['id']]);
            }

            if ($startedTx && $this->db->inTransaction()) {
                $this->db->commit();
            }

            return true;
        } catch (\Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw new \Exception("Ошибка при выполнении миграции down: " . $e->getMessage(), 0, $e);
        }
    }


    /**
     * Откат последнего batch (rollback)
     * @return bool
     * @throws Exception
     */
    public function rollback(): bool
    {
        $this->ensureMigrationsTable();

        $row = $this->db->query("SELECT IFNULL(MAX(batch), 0) as maxbatch FROM `migrations`")->getOne();
        $maxBatch = (int)($row['maxbatch'] ?? 0);
        if ($maxBatch === 0) {
            return true;
        }

        $rows = $this->db->query("SELECT * FROM `migrations` WHERE `batch` = ? ORDER BY id DESC", [$maxBatch])->get();

        try {
            if (!$this->db->inTransaction()) {
                $this->db->beginTransaction();
                $startedTx = true;
            } else {
                $startedTx = false;
            }

            foreach ($rows as $r) {
                $tbl = $r['table_name'];
                $downSql = $r['down_sql'] ?? "DROP TABLE IF EXISTS `{$tbl}`;";
                $this->db->query($downSql);
                $this->db->query("DELETE FROM `migrations` WHERE id = ?", [$r['id']]);
            }

            if ($startedTx && $this->db->inTransaction()) {
                $this->db->commit();
            }

            return true;
        } catch (\Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw new \Exception("Ошибка при rollback: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Установить имя файла миграции (basename)
     */
    public function setMigrationFile(string $file): self
    {
        $this->migrationFile = basename($file);
        return $this;
    }
}
