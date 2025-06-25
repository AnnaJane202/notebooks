<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard')->prefix('admin')->middleware(['auth', IsAdminMiddleware::class]);
Route::prefix('admin')->name('admin.')->middleware(['auth', IsAdminMiddleware::class])->group(function(){

    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('params', \App\Http\Controllers\Admin\ParamController::class);
    Route::resource('param-groups', \App\Http\Controllers\Admin\ParamGroupController::class)->parameters(['param-groups' => 'paramGroup']);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

    Route::delete('images/{image}', [\App\Http\Controllers\Admin\ImageController::class, 'destroy'])->name('images.destroy');

});
