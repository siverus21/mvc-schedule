<?

/** @var \Youpi\Application $app */

use App\Controllers\UserController;
use App\Controllers\HomeController;

define("MIDDLEWARE", [
    'auth' => Youpi\Middleware\Auth::class,
    'guest' => Youpi\Middleware\Guest::class
]);

$app->router->get('/', [HomeController::class, 'index']);

$app->router->get('/register', [UserController::class, 'register']);
$app->router->post('/register', [UserController::class, 'store']);
$app->router->get('/login', [UserController::class, 'login']);

$app->router->get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'guest']);

$app->router->get('/users', [UserController::class, 'index']);

// dump($app->router->getRoutes());
