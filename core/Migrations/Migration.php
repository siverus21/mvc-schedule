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
        $sql = "CREATE TABLE IF NOT EXISTS `migrations` (
            `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(255) NOT NULL,
            `table_name` VARCHAR(255) NOT NULL,
            `batch` INT NOT NULL,
            `executed_at` DATETIME NOT NULL,
            `up_sql` TEXT NULL,
            `down_sql` TEXT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->db->exec($sql);
    }

    /**
     * Выполнить up миграцию
     * @return bool
     * @throws Exception
     */
    public function up(): bool
    {
        $this->sanitizeIdentifier($this->table);
        $this->ensureMigrationsTable();

        $row = $this->db->query("SELECT IFNULL(MAX(batch), 0) as maxbatch FROM `migrations`")->getOne();
        $maxBatch = (int)($row['maxbatch'] ?? 0);
        $batch = $maxBatch + 1;

        $bp = new Blueprint($this->table);

        $upAttr = $this->attributes['up'] ?? null;
        if ($upAttr instanceof \Closure) {
            $upAttr($bp);
            $sql = $bp->toSql($this->db);
        } elseif (is_string($upAttr) && trim($upAttr) !== '') {
            $sql = $upAttr;
        } else {
            throw new \Exception("Атрибут 'up' не задан или неверного типа. Ожидается Closure(Blueprint) или SQL string.");
        }

        $downSql = null;
        $downAttr = $this->attributes['down'] ?? null;
        if ($downAttr instanceof \Closure) {
            $maybe = $downAttr($this->table);
            if (is_string($maybe) && trim($maybe) !== '') $downSql = $maybe;
        } elseif (is_string($downAttr) && trim($downAttr) !== '') {
            $downSql = $downAttr;
        } else {
            $downSql = "DROP TABLE IF EXISTS `{$this->table}`;";
        }

        try {
            // начинаем транзакцию, если её нет
            if (!$this->db->inTransaction()) {
                $this->db->beginTransaction();
                $startedTx = true;
            } else {
                $startedTx = false;
            }

            // Выполняем DDL / SQL
            $this->db->query($sql);

            // Сохраняем запись о миграции
            $name = $this->table . '_' . date('Ymd_His');
            $this->db->query(
                "INSERT INTO `migrations` (`name`,`table_name`,`batch`,`executed_at`,`up_sql`,`down_sql`) VALUES (?, ?, ?, ?, ?, ?)",
                [$name, $this->table, $batch, date('Y-m-d H:i:s'), $sql, $downSql]
            );

            // commit только если транзакция всё ещё активна
            if ($startedTx && $this->db->inTransaction()) {
                $this->db->commit();
            }

            return true;
        } catch (\Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
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
}
