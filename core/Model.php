<?

namespace Youpi;

use Valitron\Validator;

class Model
{

    protected array $fillable = [];
    public array $attributes = [];
    protected array $rules = [];
    protected array $errors = [];
    protected array $labels = [];

    public function loadData()
    {
        $data = request()->getData();
        foreach ($this->fillable as $key) {
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
