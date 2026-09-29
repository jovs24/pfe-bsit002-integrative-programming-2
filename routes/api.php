<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Routes for PFEBSIT 002 - Integrative Programming 2, Module 1
| (Foundations of Systems Integration and Laravel REST API Development).
| Grouped below by the week each set of endpoints was introduced in.
|
*/

// ---------------------------------------------------------------------
// Week 2 - Enterprise Systems Integration: Laboratory Activity 2
// A minimal REST endpoint that returns hardcoded JSON, used to practice
// routes, JSON responses, and Postman testing before a database is used.
// ---------------------------------------------------------------------
Route::get('/students', function () {
    return response()->json([
        [
            'id' => 1,
            'name' => 'Juan Dela Cruz',
            'course' => 'BSIT',
        ],
        [
            'id' => 2,
            'name' => 'Maria Santos',
            'course' => 'BSIT',
        ],
    ]);
});

// ---------------------------------------------------------------------
// Week 6 - Authentication, Laravel Sanctum, JWT Concepts, and Middleware
// Public auth routes: registration and login issue a Sanctum bearer token.
// ---------------------------------------------------------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ---------------------------------------------------------------------
// Protected routes: require a valid Sanctum bearer token
// (Authorization: Bearer <token>). Covers Week 4 CRUD + Week 5
// relationships/pagination/filtering/searching, now secured in Week 6.
// ---------------------------------------------------------------------
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Week 4 - Laravel API Routing, Controllers, Resources, and Validation
    // Week 5 - adds ?search=, ?department_id=, and pagination via index()
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::post('/employees', [EmployeeController::class, 'store']);
    Route::get('/employees/{id}', [EmployeeController::class, 'show']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update']);
    Route::patch('/employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
});
