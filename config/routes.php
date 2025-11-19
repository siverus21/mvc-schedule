<?

/** @var \Youpi\Application $app */

use App\Controllers\UserController;
use App\Controllers\HomeController;

$app->router->get('/', [HomeController::class, 'index']);

$app->router->get('/register', [UserController::class, 'register']);
$app->router->post('/register', [UserController::class, 'store']);
$app->router->get('/login', [UserController::class, 'login']);