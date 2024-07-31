<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoodAuthController;
use App\Http\Controllers\GoodHistoryController;
use App\Http\Controllers\GoodHomeController;
use App\Http\Controllers\GoodTicketController;
use Illuminate\Support\Facades\Route;

Route::get('/history', [AuthController::class, 'search'])->name('history');
Route::get('/register-pic', [AuthController::class, 'showRegistrationForm'])->name('register.pic');
Route::post('/register-pic', [AuthController::class, 'registerPic']);

Route::middleware('guest')->group(function () {
    Route::get('/', [GoodAuthController::class, 'index'])->name('login');
    Route::post('/login', [GoodAuthController::class, 'processlogin'])->name('login.process');

});

Route::middleware('auth')->group(function () {
    Route::get('/home', [GoodHomeController::class, 'index'])->name('home');
    Route::get('/profile', [GoodAuthController::class, 'show'])->name('profile');
    Route::post('/profile/upload', [GoodAuthController::class, 'uploadProfilePicture'])->name('profile.upload');
    Route::get('/logout', [GoodAuthController::class, 'logout'])->name('logout');

    Route::prefix('tickets')
        ->as('tickets.')
        ->group(function () {
            Route::get('/', [GoodTicketController::class, 'index'])->name('index');
            Route::get('/create', [GoodTicketController::class, 'create'])->name('create');
            Route::get('/{ticket}', [GoodTicketController::class, 'detail'])->name('detail');
            Route::post('/', [GoodTicketController::class, 'store'])->name('store');
            Route::get('/{ticket}/edit', [GoodTicketController::class, 'edit'])->name('edit');
            Route::put('/{ticket}', [GoodTicketController::class, 'update'])->name('update');
        });

    Route::get('/history', [GoodHistoryController::class, 'tickethistory'])->name('history');

});