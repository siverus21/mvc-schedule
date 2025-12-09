<?

namespace Youpi;

use Valitron\Validator;

abstract class Model
{
    protected string $table;

    protected bool $timestamp = false;

    // выбор полей для записи в бд
    protected array $fillable = [];

    public array $attributes = [];

    // Выбор полей для принятия после отправки формы
    protected array $loaded = [];

    protected array $rules = [];
    protected array $errors = [];
    protected array $labels = [];

    public function save(): false|string
    {
        $attributes = $this->attributes;
        foreach ($attributes as $k => $v) {
            if (!in_array($k, $this->fillable)) {
                unset($attributes[$k]);
            }
        }

        $fields_keys = array_keys($attributes);
        $fields = array_map(fn($field) => "`{$field}`", $fields_keys);
        $fields = implode(',', $fields);
        if ($this->timestamp) {
            $fields .= ', `created_at`, `updated_at`';
        }

        $placeholders = array_map(fn($field) => ":{$field}", $fields_keys);
        $placeholders = implode(',', $placeholders);
        if ($this->timestamp) {
            $placeholders .= ', :created_at, :updated_at';
            $attributes['created_at'] = date("Y-m-d H:i:s");
            $attributes['updated_at'] = date("Y-m-d H:i:s");
        }

        $query = "insert into {$this->table} ($fields) values ($placeholders)";
        db()->query($query, $attributes);
        return db()->getInsertId();
    }

    public function delete($id)
    {
        $query = "delete from {$this->table} where id = :id";
        try {
            db()->query($query, ['id' => $id]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Обновляет запись с id = $id.
     * Возвращает:
     *  - int > 0 — число изменённых полей (по нашему подсчёту)
     *  - 0 — ничего не изменилось
     *  - false — ошибка (валидация/ошибка БД)
     *
     * Контроллер должен обработать эти три варианта отдельно.
     */
    public function update($id): int|false
    {
        $row = db()->findOne($this->table, $id, 'id');
        if (!$row) {
            $this->errors[] = 'Запись не найдена';
            return false;
        }
        $original = is_object($row) ? (array)$row : (array)$row;

        $attrs = [];
        foreach ($this->attributes as $k => $v) {
            if (in_array($k, $this->fillable, true)) {
                $attrs[$k] = $v;
            }
        }

        $changed = [];
        foreach ($attrs as $k => $v) {
            $origVal = array_key_exists($k, $original) ? (string)$original[$k] : null;
            $newVal  = is_null($v) ? null : (string)$v;
            if ($origVal !== $newVal) {
                $changed[$k] = $v;
            }
        }

        if (empty($changed)) {
            return 0;
        }

        $rules = $this->rules;
        if (!empty($rules['unique'])) {
            $newUnique = [];
            foreach ($rules['unique'] as $uniqueRule) {
                $field = $uniqueRule[0] ?? null;
                if ($field && array_key_exists($field, $changed)) {
                    $newUnique[] = $uniqueRule;
                }
            }
            if (!empty($newUnique)) {
                $rules['unique'] = $newUnique;
            } else {
                unset($rules['unique']);
            }
        }

        $dataForValidation = array_merge($original, $attrs);

        if (!$this->validate($dataForValidation, $rules)) {
            return false;
        }

        if ($this->timestamp) {
            $changed['updated_at'] = date("Y-m-d H:i:s");
        }

        $setParts = [];
        $params = [];
        foreach ($changed as $k => $v) {
            $setParts[] = "`{$k}` = :{$k}";
            $params[$k] = $v;
        }
        $setSql = implode(', ', $setParts);

        $params['id_for_update'] = $id;

        $query = "UPDATE `{$this->table}` SET {$setSql} WHERE `id` = :id_for_update";

        try {
            db()->query($query, $params);
            return count($changed);
        } catch (\Throwable $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }


    public function loadData()
    {
        $data = request()->getData();
        foreach ($this->loaded as $key) {
            if (isset($data[$key])) {
                $this->attributes[$key] = $data[$key];
            } else {
                $this->attributes[$key] = '';
            }
        }
    }

    public function validate($data = [], $rules = [], $labels = []): bool
    {
        if (!$data) {
            $data = $this->attributes;
        }
        if (!$rules) {
            $rules = $this->rules;
        }

        if (!$labels) {
            $labels = $this->labels;
        }

        Validator::addRule('unique', function ($field, $value, array $params, array $fields) {
            $data = explode(',', $params[0]);
            return !(db()->findOne($data[0], $value, $data[1]));
        }, 'must be unique.');

        Validator::addRule('unique_pair', function ($field, $value, array $params, array $fields) {
            // Поддерживаем оба формата параметров:
            // 1) строка "table,col1,col2"
            // 2) массив ['table','col1','col2']
            if (count($params) === 1 && is_string($params[0])) {
                $parts = array_map('trim', explode(',', $params[0]));
            } else {
                $parts = $params;
            }

            $table = $parts[0] ?? null;
            $col1  = $parts[1] ?? $field;
            $col2  = $parts[2] ?? null;

            if (!$table || !$col2) {
                return true;
            }

            $val1 = $fields[$col1] ?? null;
            $val2 = $fields[$col2] ?? null;
            if ($val1 === null || $val2 === null) {
                return true;
            }
            $found = db()->findOne($table, $val1, $col1);
            if (!$found) {
                return true;
            }
            if (is_array($found)) {
                $foundCol2 = $found[$col2] ?? null;
            } else {
                $foundCol2 = $found->{$col2} ?? null;
            }
            if ($foundCol2 == $val2) {
                return false;
            }
            return true;
        }, 'Такая комбинация полей уже существует.');


        Validator::langDir(LANG_VALIDATOR);
        Validator::lang('ru');
        $validator = new Validator($data);
        $validator->rules($rules);
        $validator->labels($labels);

        if ($validator->validate()) {
            return true;
        } else {
            $this->errors = $validator->errors();
            return false;
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function listErrors(): string
    {
        $str = '<ul class="list-unstyled">';
        foreach ($this->errors as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    $str .= '<li>' . $v . '</li>';
                }
            } else {
                $str .= '<li>' . $value . '</li>';
            }
        }
        $str .= '</ul>';
        return $str;
    }
}
