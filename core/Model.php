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

    public function update(): bool
    {
        $id = $this->attributes['id'] ?? null;

        if ($id === null) {
            throw new \InvalidArgumentException('ID is required for update.');
        }

        $tableName = $this->table;

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {
            throw new \RuntimeException('Invalid table name.');
        }

        $allowedFields = array_flip($this->fillable);
        $fieldsToUpdate = array_intersect_key($this->attributes, $allowedFields);

        if ($this->timestamp) {
            $fieldsToUpdate['updated_at'] = date('Y-m-d H:i:s');
        }

        $originalRecord = db()->findOne($tableName, $id, 'id');
        if ($originalRecord === null) {
            throw new \RuntimeException("Record with id {$id} not found in {$tableName}.");
        }

        $changedFields = [];
        foreach ($fieldsToUpdate as $field => $newValue) {
            $originalValue = $originalRecord[$field] ?? null;

            if ($originalValue === null || $originalValue !== $newValue) {
                $changedFields[$field] = $newValue;
            }
        }

        if (empty($changedFields)) {
            return false; // nothing has changed
        }

        $setParts = [];
        $params = [];
        foreach ($changedFields as $field => $newValue) {
            $setParts[] = "`{$field}` = :{$field}";
            $params[$field] = $newValue;
        }
        $setSql = implode(', ', $setParts);

        $params['id'] = $id;
        $sql = "UPDATE `{$tableName}` SET {$setSql} WHERE `id` = :id";

        $db = db();
        $useTransactions = method_exists($db, 'beginTransaction') && method_exists($db, 'commit') && method_exists($db, 'rollBack');

        try {
            if ($useTransactions) {
                $db->beginTransaction();
            }

            $db->query($sql, $params);

            if ($useTransactions) {
                $db->commit();
            }

            return true;
        } catch (\Throwable $e) {
            if ($useTransactions) {
                $db->rollBack();
            }

            throw $e;
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
        // dd($this->errors);
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
