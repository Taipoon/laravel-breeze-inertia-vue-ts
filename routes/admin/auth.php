<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/**
 * このファイルに定義されたルーティングは web.php の記述により、
 * 暗黙的に `admin/` URL接頭辞と `admin.` 名前接頭辞が付与されます。
 *
 * The routing defined in this file is
 * implicitly given a `admin/` URL prefix and a `admin.` name prefix
 * by the description in web.php.
 */


/**
 * /dashboard は 実際には /admin/dashboard としてアクセスされ、
 * 名前付きルートは `admin.dashboard` になります。
 */
Route::get('/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
})->middleware('verified')->name('dashboard');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('verify-email', EmailVerificationPromptController::class)
    ->name('verification.notice');

Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->name('password.confirm');

Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

Route::put('password', [PasswordController::class, 'update'])->name('password.update');

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
