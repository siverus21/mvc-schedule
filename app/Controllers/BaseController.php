<?

namespace App\Controllers;

use Youpi\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        $menu = cache()->get('menu');
        if ($menu === null || $menu === '' || strpos((string) $menu, ' not found') !== false) {
            if ($menu !== null && $menu !== '') {
                cache()->delete('menu');
            }
            $menu = $this->renderMenu();
            cache()->set('menu', $menu, 3600);
        }
    }

    public function renderMenu(): string
    {
        return view()->renderPartial('incs/admin/menu');
    }

    /**
     * Сохранить ошибки валидации и данные формы в сессию.
     * Используется в контроллерах перед редиректом обратно на форму.
     */
    protected function rememberFormErrors(object $model, string $message = 'Не заполнены обязательные поля'): void
    {
        session()->setFlash('error', $message);
        if (method_exists($model, 'getErrors')) {
            session()->set('form_errors', $model->getErrors());
        }
        if (property_exists($model, 'attributes')) {
            session()->set('form_data', $model->attributes);
        }
    }
}
