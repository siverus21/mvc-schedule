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

/**
 * Возвращает текущий драйвер кэша (Redis или файловый — зависит от USE_REDIS).
 */
function cache(): \Youpi\Contracts\CacheInterface
{
    return app()->cache;
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

/**
 * URL статического файла из public с параметром версии (mtime) для сброса кэша браузера после сборки.
 * Пример: asset_url('assets/js/app.js') → "http://localhost:8080/assets/js/app.js?v=1234567890"
 */
function asset_url(string $path): string
{
    $path = '/' . ltrim($path, '/');
    $file = PUBLIC_PATH . $path;
    $version = (is_file($file)) ? '?v=' . filemtime($file) : '';
    return base_url($path) . $version;
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

function getUserRole()
{
    $user = getUser();
    return $user['role']['code'] ?? null;
}

function logout()
{
    \Youpi\Auth::logout();
}

function getDays(): array
{
    return ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"];
}

function getWeekParity(): array
{
    return ["Каждая неделя", "Четная неделя", "Нечетная неделя"];
}

function isEvenIsoWeek(): bool
{
    return date('W') % 2 == 0;
}
