<?

namespace Youpi;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Valitron\Validator;

abstract class Model extends EloquentModel
{
    // выбор полей для записи в бд
    protected $fillable = [];

    public $attributes = [];

    // Выбор полей для принятия после отправки формы
    protected $loaded = [];

    protected array $rules = [];
    protected array $errors = [];
    protected array $labels = [];

    public function save(array $options = [])
    {
        foreach ($this->attributes as $key => $value) {
            if (!in_array($key, $this->fillable)) {
                unset($this->attributes[$key]);
            }
        }
        return parent::save($options);
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
