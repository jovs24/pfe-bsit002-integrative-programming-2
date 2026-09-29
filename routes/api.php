<?php

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
