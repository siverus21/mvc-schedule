<?php

namespace Youpi\Migrations;

use Youpi\Database;

/**
 * Blueprint - собирает колонки, индексы и генерирует CREATE TABLE SQL
 */
class Blueprint
{
    protected string $table;
    /** @var Column[] */
    protected array $columns = [];
    protected array $extraLines = [];

    public function __construct(string $table)
    {
        $this->table = $table;
    }

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
        $this->extraLines[] = $sqlLine;
    }

    /**
     * @param Database $db
     * @param string $engine
     * @param string $charset
     * @return string SQL CREATE TABLE
     */
    public function toSql(Database $db, string $engine = 'InnoDB', string $charset = 'utf8mb4'): string
    {
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
