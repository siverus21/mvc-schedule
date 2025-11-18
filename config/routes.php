<?

/** @var \Youpi\Application $app */

$app->router->get('/', [App\Controllers\HomeController::class, 'index']);

$app->router->get('/test', [App\Controllers\HomeController::class, 'test']);

$app->router->get('/post/(?P<slug>[a-z0-9_-]+/?)', function () {
    return '<p>post</p>';
});
