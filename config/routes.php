<?

/** @var \Youpi\Application $app */

use App\Controllers\AdminController;
use App\Controllers\AuditoryController;
use App\Controllers\UserController;
use App\Controllers\HomeController;
use App\Controllers\BuildingController;
use App\Controllers\RoomTypeController;
use App\Controllers\EquipmentTypeController;
use App\Controllers\RoomEquipmentController;

define("MIDDLEWARE", [
    'auth' => Youpi\Middleware\Auth::class,
    'guest' => Youpi\Middleware\Guest::class,
    // 'role' => Youpi\Middleware\Role::class,
]);

// Index
$app->router->get('/', [HomeController::class, 'index']);

// Admin Panel
$app->router->get('/admin', [AdminController::class, 'index'])->middleware(['auth']);
$app->router->get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth']);
$app->router->get('/admin/teachers', [AdminController::class, 'teachers'])->middleware(['auth']);
$app->router->get('/admin/journal', [AdminController::class, 'journal'])->middleware(['auth']);
$app->router->get('/admin/roles', [AdminController::class, 'roles'])->middleware(['auth']);
$app->router->get('/admin/schedule', [AdminController::class, 'schedule'])->middleware(['auth']);
$app->router->get('/admin/settings', [AdminController::class, 'settings'])->middleware(['auth', 'role:redactor']);
$app->router->get('/admin/import-export', [AdminController::class, 'importExport'])->middleware(['auth']);

// Auditories
$app->router->get('/admin/auditories', [AuditoryController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/auditories/create', [AuditoryController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/auditories/create', [AuditoryController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/auditories/edit/{id}', [AuditoryController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/auditories/edit/{id}', [AuditoryController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/auditories/delete/{id}', [AuditoryController::class, 'delete'])->middleware(['auth']);

// Buildings
$app->router->get('/admin/buildings', [BuildingController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/buildings/create', [BuildingController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/buildings/create', [BuildingController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/buildings/edit/{id}', [BuildingController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/buildings/edit/{id}', [BuildingController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/buildings/delete/{id}', [BuildingController::class, 'delete'])->middleware(['auth']);

// Room Types
$app->router->get('/admin/room-types', [RoomTypeController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/room-types/create', [RoomTypeController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/room-types/create', [RoomTypeController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/room-types/edit/{id}', [RoomTypeController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/room-types/edit/{id}', [RoomTypeController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/room-types/delete/{id}', [RoomTypeController::class, 'delete'])->middleware(['auth']);

// Equipment Types
$app->router->get('/admin/equipment-types', [EquipmentTypeController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/equipment-types/create', [EquipmentTypeController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/equipment-types/create', [EquipmentTypeController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/equipment-types/edit/{id}', [EquipmentTypeController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/equipment-types/edit/{id}', [EquipmentTypeController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/equipment-types/delete/{id}', [EquipmentTypeController::class, 'delete'])->middleware(['auth']);

// Room Equipment
$app->router->get('/admin/room-equipment', [RoomEquipmentController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/room-equipment/create', [RoomEquipmentController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/room-equipment/create', [RoomEquipmentController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/room-equipment/edit/{id}', [RoomEquipmentController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/room-equipment/edit/{id}', [RoomEquipmentController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/room-equipment/delete/{id}', [RoomEquipmentController::class, 'delete'])->middleware(['auth']);

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
