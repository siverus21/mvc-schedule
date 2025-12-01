<?

/** @var \Youpi\Application $app */

use App\Controllers\AdminController;
use App\Controllers\UserController;
use App\Controllers\HomeController;

define("MIDDLEWARE", [
    'auth' => Youpi\Middleware\Auth::class,
    'guest' => Youpi\Middleware\Guest::class
]);

// Index
$app->router->get('/', [HomeController::class, 'index']);

// Admin Panel
$app->router->get('/admin', [AdminController::class, 'index'])->middleware(['auth']);
$app->router->get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth']);
$app->router->get('/admin/auditories', [AdminController::class, 'auditories'])->middleware(['auth']);
$app->router->get('/admin/teachers', [AdminController::class, 'teachers'])->middleware(['auth']);
$app->router->get('/admin/journal', [AdminController::class, 'journal'])->middleware(['auth']);
$app->router->get('/admin/roles', [AdminController::class, 'roles'])->middleware(['auth']);
$app->router->get('/admin/schedule', [AdminController::class, 'schedule'])->middleware(['auth']);
$app->router->get('/admin/settings', [AdminController::class, 'settings'])->middleware(['auth']);
$app->router->get('/admin/import-export', [AdminController::class, 'importExport'])->middleware(['auth']);

// User
$app->router->get('/register', [UserController::class, 'register'])->middleware(['guest']);
$app->router->post('/register', [UserController::class, 'store'])->middleware(['guest']);
$app->router->get('/login', [UserController::class, 'login'])->middleware(['guest']);
$app->router->post('/login', [UserController::class, 'auth'])->middleware(['guest']);
$app->router->get('/logout', [UserController::class, 'logout'])->middleware(['auth']);

// Users test. Remove this in production
$app->router->get('/users', [UserController::class, 'index'])->middleware(['auth']);
$app->router->get('/users/{id}', [UserController::class, 'userDetail'])->middleware(['auth']);

// API
$app->router->get('/api/v1/users', [App\Controllers\API\V1\UserController::class, 'index']);
$app->router->get('/api/v1/users/{id}', [App\Controllers\API\V1\UserController::class, 'view']);
