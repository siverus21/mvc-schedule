<?php

namespace Youpi;

use PDO;
use PDOStatement;
use PDOException;

class Database
{
    protected PDO $connection;
    protected PDOStatement $stmt;

    public function __construct()
    {
        $dsn = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_DATABASE . ";charset=" . DB_CHARSET . ";";
        try {
            $this->connection = new PDO($dsn, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
            // рекомендуемое поведение: выдавать ассоциативные массивы по умолчанию
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("[" . date('Y-m-d H:i:s') . "] DB Error: {$e->getMessage()}" . PHP_EOL, 3, ERROR_LOGS);
            abort('DB error connection', 500);
        }

        return $this;
    }

    /**
     * Подготовить и выполнить запрос (prepared)
     * @param string $query
     * @param array $params (позиционные или именованные)
     * @return $this
     * @throws PDOException
     */
    public function query(string $query, array $params = [])
    {
        $this->stmt = $this->connection->prepare($query);
        $this->stmt->execute($params);
        return $this;
    }

    /**
     * Выполнить "сырой" SQL без подготовки (exec)
     * Возвращает количество затронутых строк или false при ошибке
     */
    public function exec(string $sql)
    {
        try {
            return $this->connection->exec($sql);
        } catch (PDOException $e) {
            // логируем и пробрасываем дальше — миграции должны поймать исключение
            error_log("[" . date('Y-m-d H:i:s') . "] DB Exec Error: {$e->getMessage()}" . PHP_EOL, 3, ERROR_LOGS);
            throw $e;
        }
    }

    /**
     * Экранирование значения через PDO::quote
     */
    public function quote(string $value): string
    {
        return $this->connection->quote($value);
    }

    public function get(): array|false
    {
        return $this->stmt->fetchAll();
    }

    public function getAssoc($key = 'id')
    {
        $data = [];
        while ($row = $this->stmt->fetch()) {
            $data[$row[$key]] = $row;
        }
        return $data;
    }

    public function getOne()
    {
        return $this->stmt->fetch();
    }

    public function getColumn()
    {
        return $this->stmt->fetchColumn();
    }

    public function findAll($tbl): array|false
    {
        $this->query("select * from {$tbl}");
        return $this->stmt->fetchAll();
    }

    public function findOne($tbl, $value, $key = 'id')
    {
        $this->query("select * from {$tbl} where $key = ? LIMIT 1", [$value]);
        return $this->stmt->fetch();
    }

    public function findOrFail($tbl, $value, $key = 'id')
    {
        $res = $this->findOne($tbl, $value, $key);
        if (!$res) {
            if ($_SERVER['HTTP_ACCEPT'] == 'application/json') {
                response()->json([
                    'status' => 'error',
                    'data' => 'Not found',
                ], 404);
            }
            abort();
        }
        return $res;
    }

    public function getInsertId(): false|string
    {
        return $this->connection->lastInsertId();
    }

    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    public function beginTransaction(): bool
    {
        return $this->connection->beginTransaction();
    }

    public function commit(): bool
    {
        return $this->connection->commit();
    }

    public function rollBack(): bool
    {
        return $this->connection->rollBack();
    }

    /**
     * Возвращает true если в транзакции
     */
    public function inTransaction(): bool
    {
        return $this->connection->inTransaction();
    }

    public function count($tbl): int
    {
        $this->query("select count(*) as c from {$tbl}");
        $r = $this->stmt->fetch();
        return (int)($r['c'] ?? 0);
    }

    public function tableIsExists($tbl): bool
    {
        try {
            $this->query("SELECT 1 FROM `{$tbl}` LIMIT 1");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
