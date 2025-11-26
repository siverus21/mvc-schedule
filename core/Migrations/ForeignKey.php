<?

namespace Youpi\Migrations;


class ForeignKey
{
    public string $column;
    public ?string $refTable = null;
    public ?string $refColumn = null;
    public ?string $name = null;
    public ?string $onDelete = null;
    public ?string $onUpdate = null;

    public function __construct(string $column)
    {
        $this->column = $column;
    }

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function references(string $col): self
    {
        $this->refColumn = $col;
        return $this;
    }
    public function on(string $table): self
    {
        $this->refTable = $table;
        return $this;
    }
    public function onDelete(string $action): self
    {
        $this->onDelete = strtoupper($action);
        return $this;
    }
    public function onUpdate(string $action): self
    {
        $this->onUpdate = strtoupper($action);
        return $this;
    }

    public function getName(string $table): string
    {
        if ($this->name) return $this->name;
        return "fk_{$table}_{$this->column}";
    }
}
