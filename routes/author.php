<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthorController;
use App\Http\Middleware\checkLogin;

Route::prefix('author')->name('author.')->group(function() {
    Route::middleware(['guest:web'])->group(function(){
        Route::get('/login',[AuthorController::class,'login'])->name('login');
        Route::post('/login',[AuthorController::class,'checkLogin'])->name('checkLogin');
        Route::get('/forgot-password',[AuthorController::class,'forgotPassword'])->name('forgot-password');
        Route::post('/password/reset',[AuthorController::class,'Email'])->name('reset-form');
        
        Route::post('/password/reset/{token}',[AuthorController::class,'ResetPassword'])->name('reset-password');
    });
    Route::middleware(['auth:web'])->group( function() {
        Route::get('/home',[AuthorController::class,'index'])->name('home');
        Route::get('/logout',[AuthorController::class,'logout'])->name('logout');
    });
});