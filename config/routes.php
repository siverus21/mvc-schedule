<?

/** @var \Youpi\Application $app */

use App\Controllers\UserController;
use App\Controllers\HomeController;

define("MIDDLEWARE", [
    'auth' => Youpi\Middleware\Auth::class,
    'guest' => Youpi\Middleware\Guest::class
]);

$app->router->get('/', [HomeController::class, 'index']);

$app->router->get('/register', [UserController::class, 'register'])->middleware(['guest']);
$app->router->post('/register', [UserController::class, 'store'])->middleware(['guest']);
$app->router->get('/login', [UserController::class, 'login'])->middleware(['guest']);
$app->router->post('/login', [UserController::class, 'auth'])->middleware(['guest']);
$app->router->get('/logout', [UserController::class, 'logout'])->middleware(['auth']);

$app->router->get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth']);

$app->router->get('/users', [UserController::class, 'index']);


$app->router->get('/test', [App\Controllers\TestController::class, 'index']);
$app->router->post('/test', [App\Controllers\TestController::class, 'send']);

// API
$app->router->get('/api/v1/users', [App\Controllers\API\V1\UserController::class, 'index']);
$app->router->get('/api/v1/users/{id}', [App\Controllers\API\V1\UserController::class, 'view']);
