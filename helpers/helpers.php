<?

use Youpi\View;

function app()
{
    return \Youpi\Application::$app;
}

function request()
{
    return app()->request;
}

function response()
{
    return app()->response;
}

function session()
{
    return app()->session;
}

function db()
{
    return app()->db;
}

function cache()
{
    return app()->cache;
}

function cacheRedis()
{
    return app()->cacheRedis;
}

function view($view = '', $data = [], $layout = 'default'): string|View
{
    if ($view) {
        return app()->view->render($view, $data, $layout);
    }

    return app()->view;
}

function abort($error = '', $code = 404)
{
    response()->setStatusResponse($code);
    echo view("errors/{$code}", ['error' => $error], false);
    die();
}

function base_url($path = ''): string
{
    return PATH . $path;
}

function publicUrl($path = ''): string
{
    return PUBLIC_PATH . $path;
}

function getAlerts(): void
{
    if (!empty($_SESSION['_flash'])) {
        foreach ($_SESSION['_flash'] as $type => $message) {
            echo view()->renderPartial("incs/alert_{$type}", ["flash_{$type}" => session()->getFlash($type)]);
        }
    }
}

function getErrors($fieldName): string
{
    $output = "";
    $errors = session()->get('form_errors');

    if (isset($errors[$fieldName])) {
        $output .= "<span class='form__helper-error'><ul class='list-unstyled'>";
        foreach ($errors[$fieldName] as $error) {
            $output .= "<li>{$error}</li>";
        }
        $output .= "</ul></span>";
    }

    return $output;
}

function getValidationClass($fieldName): string
{
    $errors = session()->get('form_errors');

    if (empty($errors)) {
        return '';
    }

    return isset($errors[$fieldName]) ? 'is-invalid' : 'is-valid';
}

function old($fieldName): string
{
    return isset(session()->get('form_data')[$fieldName]) ? h(session()->get('form_data')[$fieldName]) : '';
}

function h($str): string
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function getCsrfField(): string
{
    return "<input type='hidden' name='_csrf_token' value='" . session()->get('_csrf_token') . "' />";
}

function getCsrfMeta(): string
{
    return "<meta name='_csrf_token' content='" . session()->get('_csrf_token') . "' />";
}

function checkAuth(): bool
{
    return \Youpi\Auth::isAuth();
}

function getUser()
{
    return \Youpi\Auth::user();
}

function logout()
{
    \Youpi\Auth::logout();
}