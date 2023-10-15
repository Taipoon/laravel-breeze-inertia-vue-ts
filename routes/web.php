<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'userCanLogin' => Route::has('user.login'),
        'userCanRegister' => Route::has('user.register'),
        'adminCanLogin' => Route::has('admin.login'),
        'adminCanRegister' => Route::has('admin.register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::prefix('user')->name('user.')->group(function () {
    Route::middleware('guest:user')->group(base_path('routes/user/guest.php'));
    Route::middleware('auth:user')->group(base_path('routes/user/auth.php'));
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(base_path('routes/admin/guest.php'));
    Route::middleware('auth:admin')->group(base_path('routes/admin/auth.php'));
});
