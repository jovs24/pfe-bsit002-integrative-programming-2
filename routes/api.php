<?php

use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Support\Facades\Route;

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
// Week 4 - Laravel API Routing, Controllers, Resources, and Validation
// ---------------------------------------------------------------------
Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::patch('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
