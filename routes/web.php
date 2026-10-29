<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleAuthController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authenticated Users
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | General Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Student Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/student/dashboard', [StudentController::class, 'index'])
        ->name('student.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Staff Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile Management
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | STUDENT / STAFF BORROW ACTIONS (Available for non-admin users)
    |--------------------------------------------------------------------------
    */
    Route::get('/borrowings', [BorrowingController::class, 'index'])
        ->name('borrowings.index');

    Route::get('/borrowings/create', [BorrowingController::class, 'create'])
        ->name('borrowings.create');

    Route::post('/borrowings', [BorrowingController::class, 'store'])
        ->name('borrowings.store');

    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnItem'])
        ->name('borrowings.return');

    Route::post('/borrowings/{borrowing}/request-return', [BorrowingController::class, 'requestReturn'])
        ->name('borrowings.request-return');


    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY (With /admin prefix for management & CRUD)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('admin.dashboard');

        // Borrowing Management / CRUD para sa Admin
        Route::get('/borrowings', [BorrowingController::class, 'index'])
            ->name('admin.borrowings.index');

        Route::get('/borrowings/{borrowing}/edit', [BorrowingController::class, 'edit'])
            ->name('borrowings.edit');

        Route::put('/borrowings/{borrowing}', [BorrowingController::class, 'update'])
            ->name('borrowings.update');

        Route::delete('/borrowings/{borrowing}', [BorrowingController::class, 'destroy'])
            ->name('borrowings.destroy');

        Route::post('/borrowings/{borrowing}/confirm-return', [BorrowingController::class, 'confirmReturn'])
            ->name('borrowings.confirm-return');

        // Users & Equipment Resource Management
        Route::resource('users', UserController::class)
            ->except(['show'])
            ->names('admin.users');

        Route::resource('equipment', EquipmentController::class);
    });
});

/*
|--------------------------------------------------------------------------
| Authentication (Google & Breeze Auth)
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

require __DIR__.'/auth.php';