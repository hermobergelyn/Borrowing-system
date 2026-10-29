<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // <-- Import your AuthController
use App\Http\Controllers\Api\BorrowingTransactionController;

// --- Public Authentication Routes ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// --- Protected Routes (Requires Bearer Token) ---
Route::middleware('auth:sanctum')->group(function () {
    // Get authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout endpoint
    Route::post('/logout', [AuthController::class, 'logout']);

    // Borrowing Transaction API Routes (Protected by Sanctum)
    Route::apiResource('borrowing-transactions', BorrowingTransactionController::class);
});