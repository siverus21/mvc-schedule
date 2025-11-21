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
        foreach ($this->attributes as $key => $value) {
            if (!in_array($key, $this->fillable)) {
                unset($this->attributes[$key]);
            }
        }

        // insert into $tbl (`f1`, `f2`, `f3`) values (:v1, :v2, :v3);
        $fieldsKeys = array_keys($this->attributes);
        $fields = array_map(fn($filed) => "`{$filed}`", $fieldsKeys);
        $fields = implode(', ', $fields);

        if ($this->timestamp) {
            $fields .= ", `created_at`, `updated_at`";
        }

        $placeholders = array_map(fn($value) => ":{$value}", $fieldsKeys);
        $placeholders = implode(', ', $placeholders);

        if ($this->timestamp) {
            $placeholders .= ", :created_at, :updated_at";
            $this->attributes['created_at'] = date('Y-m-d H:i:s');
            $this->attributes['updated_at'] = date('Y-m-d H:i:s');
        }

        $query = "INSERT INTO `{$this->table}` ({$fields}) VALUES ({$placeholders})";
        db()->query($query, $this->attributes);

        return db()->getInsertId();
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
}
