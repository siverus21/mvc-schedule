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