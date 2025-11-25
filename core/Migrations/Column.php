<?php

namespace Youpi\Migrations;

use Youpi\Database;

/**
 * Column - хранит свойства колонки и умеет рендерить SQL (MySQL-подобный)
 */
class Column
{
    public string $name;
    public string $type;
    public ?int $length = null;
    public bool $unsigned = false;
    public bool $nullable = false;
    public $default = null;
    public bool $unique = false;
    public bool $autoIncrement = false;
    public bool $primary = false;

    public function __construct(string $name, string $type, ?int $length = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->length = $length;
    }

    public function unsigned(): self
    {
        $this->unsigned = true;
        return $this;
    }
    public function nullable(): self
    {
        $this->nullable = true;
        return $this;
    }
    public function default($value): self
    {
        $this->default = $value;
        return $this;
    }
    public function unique(): self
    {
        $this->unique = true;
        return $this;
    }
    public function autoIncrement(): self
    {
        $this->autoIncrement = true;
        return $this;
    }
    public function primary(): self
    {
        $this->primary = true;
        return $this;
    }

    /**
     * Рендер SQL строки для колонки, используя Database::quote для экранирования значения по-умолчанию.
     * @param Database $db
     * @return string
     */
    public function toSql(Database $db): string
    {
        $len = $this->length !== null ? "({$this->length})" : "";
        $typeSql = strtoupper($this->type) . $len;

        if ($this->type === 'string') $typeSql = "VARCHAR" . $len;
        if ($this->type === 'timestamp') $typeSql = "TIMESTAMP";
        if ($this->type === 'tinyint') $typeSql = "TINYINT" . $len;
        if ($this->type === 'int') $typeSql = "INT";
        if ($this->type === 'text') $typeSql = "TEXT";

        $parts = ["`{$this->name}` {$typeSql}"];

        if ($this->unsigned) $parts[] = "UNSIGNED";
        if ($this->autoIncrement) $parts[] = "AUTO_INCREMENT";
        $parts[] = $this->nullable ? "NULL" : "NOT NULL";

        if ($this->default !== null) {
            if (is_string($this->default) && strtoupper($this->default) === 'CURRENT_TIMESTAMP') {
                $parts[] = "DEFAULT CURRENT_TIMESTAMP";
            } else {
                // используем Database::quote
                $parts[] = "DEFAULT " . $db->quote((string)$this->default);
            }
        }

        if ($this->unique) $parts[] = "UNIQUE";
        if ($this->primary) $parts[] = "PRIMARY KEY";

        return implode(' ', $parts);
    }
}
