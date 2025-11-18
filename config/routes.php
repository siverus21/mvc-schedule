<?

/** @var \Youpi\Application $app */

$app->router->get('/test', [App\Controllers\HomeController::class, 'test']);
$app->router->post('/test', [App\Controllers\HomeController::class, 'test']);

dump($app->router->getRoutes());
