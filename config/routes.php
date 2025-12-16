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
use App\Controllers\DepartmentController;
use App\Controllers\TeacherController;
use App\Controllers\AcademicDegreeController;
use App\Controllers\SubjectController;
use App\Controllers\LessonTypeController;
use App\Controllers\StudentGroupController;
use App\Controllers\SemesterController;
use App\Controllers\ScheduleTemplateController;

define("MIDDLEWARE", [
    'auth' => Youpi\Middleware\Auth::class,
    'guest' => Youpi\Middleware\Guest::class,
    'role' => Youpi\Middleware\Role::class,
]);

// Index
$app->router->get('/', [HomeController::class, 'index']);

// User from not authenticated
$app->router->get('/login', [UserController::class, 'login'])->middleware(['guest']);
$app->router->post('/login', [UserController::class, 'auth'])->middleware(['guest']);

// Admin Panel
$app->router->get('/admin', [AdminController::class, 'index'])->middleware(['auth']);
$app->router->get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth']);
$app->router->get('/admin/journal', [AdminController::class, 'journal'])->middleware(['auth']);
$app->router->get('/admin/roles', [AdminController::class, 'roles'])->middleware(['auth']);
$app->router->get('/admin/settings', [AdminController::class, 'settings'])->middleware(['auth', 'role:admin,redactor']);
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

// Users
$app->router->get('/admin/users', [UserController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/users/create', [UserController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/users/create', [UserController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/users/edit/{id}', [UserController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/users/edit/{id}', [UserController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/users/delete/{id}', [UserController::class, 'delete'])->middleware(['auth']);
$app->router->get('/admin/logout', [UserController::class, 'logout'])->middleware(['auth']);

// Departments
$app->router->get('/admin/department', [DepartmentController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/department/create', [DepartmentController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/department/create', [DepartmentController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/department/edit/{id}', [DepartmentController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/department/edit/{id}', [DepartmentController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/department/delete/{id}', [DepartmentController::class, 'delete'])->middleware(['auth']);

// Teachers
$app->router->get('/admin/teachers', [TeacherController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/teachers/create', [TeacherController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/teachers/create', [TeacherController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/teachers/edit/{id}', [TeacherController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/teachers/edit/{id}', [TeacherController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/teachers/delete/{id}', [TeacherController::class, 'delete'])->middleware(['auth']);

// Academic degrees
$app->router->get('/admin/academic-degrees', [AcademicDegreeController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/academic-degrees/create', [AcademicDegreeController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/academic-degrees/create', [AcademicDegreeController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/academic-degrees/edit/{id}', [AcademicDegreeController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/academic-degrees/edit/{id}', [AcademicDegreeController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/academic-degrees/delete/{id}', [AcademicDegreeController::class, 'delete'])->middleware(['auth']);

// Subjects
$app->router->get('/admin/subjects', [SubjectController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/subjects/create', [SubjectController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/subjects/create', [SubjectController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/subjects/edit/{id}', [SubjectController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/subjects/edit/{id}', [SubjectController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/subjects/delete/{id}', [SubjectController::class, 'delete'])->middleware(['auth']);

// Lesson Types
$app->router->get('/admin/lesson-types', [LessonTypeController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/lesson-types/create', [LessonTypeController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/lesson-types/create', [LessonTypeController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/lesson-types/edit/{id}', [LessonTypeController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/lesson-types/edit/{id}', [LessonTypeController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/lesson-types/delete/{id}', [LessonTypeController::class, 'delete'])->middleware(['auth']);

// Student groups
$app->router->get('/admin/student-groups', [StudentGroupController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/student-groups/create', [StudentGroupController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/student-groups/create', [StudentGroupController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/student-groups/edit/{id}', [StudentGroupController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/student-groups/edit/{id}', [StudentGroupController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/student-groups/delete/{id}', [StudentGroupController::class, 'delete'])->middleware(['auth']);

// Semesters
$app->router->get('/admin/semesters', [SemesterController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/semesters/create', [SemesterController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/semesters/create', [SemesterController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/semesters/edit/{id}', [SemesterController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/semesters/edit/{id}', [SemesterController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/semesters/delete/{id}', [SemesterController::class, 'delete'])->middleware(['auth']);

// Schedules
$app->router->get('/admin/schedules', [ScheduleTemplateController::class, 'list'])->middleware(['auth']);
$app->router->get('/admin/schedules/semester/{semesterId}/group/{groupId}', [ScheduleTemplateController::class, 'schedules'])->middleware(['auth']);
$app->router->get('/admin/schedules/create', [ScheduleTemplateController::class, 'create'])->middleware(['auth']);
$app->router->post('/admin/schedules/create', [ScheduleTemplateController::class, 'store'])->middleware(['auth']);
$app->router->get('/admin/schedules/edit/{id}', [ScheduleTemplateController::class, 'edit'])->middleware(['auth']);
$app->router->post('/admin/schedules/edit/{id}', [ScheduleTemplateController::class, 'update'])->middleware(['auth']);
$app->router->get('/admin/schedules/delete/{id}', [ScheduleTemplateController::class, 'delete'])->middleware(['auth']);

// API
$app->router->get('/api/v1/users', [App\Controllers\API\V1\UserController::class, 'index']);
$app->router->get('/api/v1/users/{id}', [App\Controllers\API\V1\UserController::class, 'view']);
