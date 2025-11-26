<?php

namespace Youpi\Migrations;

use Youpi\Database;
use Youpi\Migrations\ForeignKey;

/**
 * Blueprint - собирает колонки, индексы и генерирует CREATE TABLE SQL
 */
class Blueprint
{
    protected string $table;
    /** @var Column[] */
    protected array $columns = [];
    protected array $extraLines = [];

    // для ALTER: массив SQL-операций (каждый — отдельная строка)
    protected array $alterLines = [];

    // флаг режима
    protected bool $isAlter = false;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Пометить blueprint как alter (будут генерироваться ALTER TABLE ... строки)
     */
    public function alter(): self
    {
        $this->isAlter = true;
        return $this;
    }

    // ---------- column factories (создаёт Column и возвращает его fluent) ----------
    public function id(): Column
    {
        $col = new Column('id', 'int');
        $col->unsigned()->autoIncrement()->primary();
        $this->columns[] = $col;
        return $col;
    }

    public function increments(string $name = 'id'): Column
    {
        $col = new Column($name, 'int');
        $col->unsigned()->autoIncrement()->primary();
        $this->columns[] = $col;
        return $col;
    }

    public function string(string $name, int $length = 255): Column
    {
        $col = new Column($name, 'string', $length);
        $this->columns[] = $col;
        return $col;
    }

    public function integer(string $name): Column
    {
        $col = new Column($name, 'int', null);
        $this->columns[] = $col;
        return $col;
    }

    public function unsignedBigInteger(string $name): Column
    {
        $col = new Column($name, 'bigint', null);
        $col->unsigned();
        $this->columns[] = $col;
        return $col;
    }

    public function timestamp(string $name): Column
    {
        $col = new Column($name, 'timestamp', null);
        $this->columns[] = $col;
        return $col;
    }

    public function tinyInteger(string $name, int $length = 1): Column
    {
        $col = new Column($name, 'tinyint', $length);
        $this->columns[] = $col;
        return $col;
    }

    public function unsignedTinyInteger(string $name): Column
    {
        return $this->tinyInteger($name)->unsigned();
    }

    public function text(string $name): Column
    {
        $col = new Column($name, 'text');
        $this->columns[] = $col;
        return $col;
    }

    public function rememberToken(): Column
    {
        return $this->string('remember_token', 100)->nullable();
    }

    public function timestamps(): void
    {
        $this->timestamp('created_at')->nullable();
        $this->timestamp('updated_at')->nullable();
    }

    public function raw(string $sqlLine): void
    {
        if ($this->isAlter) {
            $this->alterLines[] = $sqlLine;
        } else {
            $this->extraLines[] = $sqlLine;
        }
    }

    // ---------------- ALTER helpers ----------------

    /**
     * Добавить колонку (в режиме alter используем ADD COLUMN)
     * Пример в миграции:
     *   $table->alter()->string('role_id');
     */
    protected function addColumnSql(Column $col, Database $db): string
    {
        return "ALTER TABLE `{$this->table}` ADD COLUMN " . $col->toSql($db);
    }

    /**
     * Удалить колонку
     */
    public function dropColumn(string $name): void
    {
        $this->isAlter = true;
        $this->alterLines[] = "ALTER TABLE `{$this->table}` DROP COLUMN `{$name}`;";
    }

    /**
     * Добавить индекс (INDEX)
     * $columns — строка или массив
     */
    public function index($columns, ?string $name = null): void
    {
        $this->isAlter = true;
        $cols = is_array($columns) ? $columns : [$columns];
        $colsSql = implode(', ', array_map(fn($c) => "`{$c}`", $cols));
        $idxName = $name ?? ("idx_{$this->table}_" . implode('_', $cols));
        $this->alterLines[] = "ALTER TABLE `{$this->table}` ADD INDEX `{$idxName}` ({$colsSql});";
    }

    /**
     * Уникальный индекс
     */
    public function unique($columns, ?string $name = null): void
    {
        $this->isAlter = true;
        $cols = is_array($columns) ? $columns : [$columns];
        $colsSql = implode(', ', array_map(fn($c) => "`{$c}`", $cols));
        $idxName = $name ?? ("ux_{$this->table}_" . implode('_', $cols));
        $this->alterLines[] = "ALTER TABLE `{$this->table}` ADD UNIQUE INDEX `{$idxName}` ({$colsSql});";
    }

    /**
     * Удалить индекс по имени
     */
    public function dropIndex(string $name): void
    {
        $this->isAlter = true;
        $this->alterLines[] = "ALTER TABLE `{$this->table}` DROP INDEX `{$name}`;";
    }

    /**
     * Создать внешний ключ (fluent)
     * Пример:
     *  $table->alter()->unsignedBigInteger('role_id');
     *  $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
     */
    public function foreign(string $column): ForeignKey
    {
        $this->isAlter = true;
        $fk = new ForeignKey($column);
        // при finalization — пользователь должен вызвать ->on(...) и т.д.
        // но мы сохраняем объект в alterLines только когда он завершён: мы вернём FK объект,
        // и когда пользователь вызовет ->on(...), мы соберём SQL и добавим в alterLines.
        // Для простоты — добавим трюковый обработчик: возвращаем объект, а on() сам добавит sql? Нет — он просто задаёт свойства.
        // Нам нужен способ зарегистрировать завершённый FK: будем полагаться на то, что пользователь вызовет ->on()
        // и затем we will require them to call ->buildForeign($fk) manually — но это неудобно.
        // Вместо этого: вернём FK, и добавим магию: в on() мы не имеем доступа к Blueprint.
        // Поэтому сделаем так: тут возвращаем FK, а пользователь в миграции после on(...) должен вызвать $table->addForeign($fk)
        // Это явнее и безопаснее.
        return $fk;
    }

    /**
     * Добавляет уже настроенный ForeignKey объект в alterLines
     */
    public function addForeign(ForeignKey $fk): void
    {
        if (!$fk->refTable || !$fk->refColumn) {
            throw new \Exception("ForeignKey must have references() and on() set before adding.");
        }
        $name = $fk->getName($this->table);
        $colsSql = "`{$fk->column}`";
        $ref = "`{$fk->refTable}` (`{$fk->refColumn}`)";
        $line = "ALTER TABLE `{$this->table}` ADD CONSTRAINT `{$name}` FOREIGN KEY ({$colsSql}) REFERENCES {$ref}";
        if ($fk->onDelete) $line .= " ON DELETE {$fk->onDelete}";
        if ($fk->onUpdate) $line .= " ON UPDATE {$fk->onUpdate}";
        $line .= ";";
        $this->alterLines[] = $line;
    }

    /**
     * Удалить внешний ключ (по имени) и индекс (если нужно)
     */
    public function dropForeign(string $name): void
    {
        $this->isAlter = true;
        $this->alterLines[] = "ALTER TABLE `{$this->table}` DROP FOREIGN KEY `{$name}`;";
    }

    // ---------------- SQL генерация ----------------

    /**
     * Возвращает либо string (CREATE TABLE), либо array (список ALTER TABLE ...)
     *
     * @param Database $db
     * @param string $engine
     * @param string $charset
     * @return string|string[]
     */
    public function toSql(Database $db, string $engine = 'InnoDB', string $charset = 'utf8mb4')
    {
        if ($this->isAlter) {
            // собрать ALTER ARRAY: добавление колонок + alterLines
            $sqls = [];
            // добавление колонок
            foreach ($this->columns as $col) {
                $sqls[] = $this->addColumnSql($col, $db) . ';';
            }
            // доп. строки (индексы, FK, raw)
            foreach ($this->alterLines as $l) {
                // убедимся, что заканчивается точкой с запятой
                $sqls[] = rtrim($l, " \t\n\r;") . ';';
            }
            return $sqls;
        }

        // create table (как раньше)
        $colsSql = array_map(fn($c) => $c->toSql($db), $this->columns);
        $all = array_merge($colsSql, $this->extraLines);
        $linesJoined = implode(",\n  ", $all);
        $table = $this->table;
        return "CREATE TABLE `{$table}` (\n  {$linesJoined}\n) ENGINE={$engine} DEFAULT CHARSET={$charset};";
    }

    public function getColumns(): array
    {
        return $this->columns;
    }
}