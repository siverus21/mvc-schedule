<?

namespace App\Models;

use Youpi\Model;

/**
 * Базовый класс моделей приложения.
 * Добавляет общие методы выборки списка и одной записи по id.
 */
abstract class BaseModel extends Model
{
    /**
     * Колонки для выборки списка (getAll*). Если пусто — используются id + fillable без created_at/updated_at.
     */
    protected array $listColumns = [];

    /**
     * Выборка всех записей по заданным колонкам.
     * @param array|null $columns Если null, берутся из getListColumns()
     */
    protected function getAllRecords(?array $columns = null): array
    {
        $cols = $columns ?? $this->getListColumns();
        $list = implode(', ', $cols);
        return db()->query("SELECT {$list} FROM {$this->table}")->getAssoc();
    }

    /**
     * Выборка одной записи по id.
     */
    protected function getRecordById(int|string $id): array
    {
        return db()->findOrFail($this->table, $id);
    }

    /**
     * Колонки для списка: либо $listColumns, либо id + fillable без служебных полей.
     */
    protected function getListColumns(): array
    {
        if ($this->listColumns !== []) {
            return $this->listColumns;
        }
        $exclude = ['created_at', 'updated_at'];
        $fillable = array_values(array_diff($this->fillable, $exclude));
        return array_merge(['id'], $fillable);
    }
}
