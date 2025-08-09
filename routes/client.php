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
use Illuminate\Support\Facades\Route;

Route::name('client.')->group(function(){
    Route::get('products', [\App\Http\Controllers\Client\ProductController::class, 'index'])->name('products.index');
    Route::get('/', [\App\Http\Controllers\Client\ProductController::class, 'index'])->name('products.index');
    Route::get('products/{product}', [\App\Http\Controllers\Client\ProductController::class, 'show'])->name('products.show');
    Route::get('categories/{category}/products', [\App\Http\Controllers\Client\CategoryController::class, 'productIndex'])->name('categories.products.index');

    Route::resource('/carts', \App\Http\Controllers\Client\CartController::class);

});


