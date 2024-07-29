<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoodAuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;

// perlu login

Route::get('/tickets/create', [AuthController::class, 'createTicket'])->name('tickets.create');
Route::post('/tickets', [AuthController::class, 'storeTicket'])->name('tickets.store');
Route::get('/logout', [GoodAuthController::class, 'logout'])->name('logout')->middleware(AuthMiddleware::class);
Route::get('/tickets', [AuthController::class, 'ticketlist'])->name('tickets');
Route::get('/history', [AuthController::class, 'tickethistory'])->name('history');
Route::get('/home', [AuthController::class, 'index'])->name('home');
Route::get('/profile', [AuthController::class, 'show'])->name('profile');
Route::get('/tickets/{id}/edit', [AuthController::class, 'editTicket'])->name('tickets.edit');
Route::put('/tickets/{id}', [AuthController::class, 'updateTicket'])->name('tickets.update');
Route::post('/profile/upload', [AuthController::class, 'uploadProfilePicture'])->name('profile.upload');
Route::get('/tickets/{id}', [AuthController::class, 'view'])->name('tickets.view');

// tidak perlu login
Route::middleware(GuestMiddleware::class)->group(function(){
    Route::get('/', [GoodAuthController::class, 'index'])->name('login');
    Route::post('/login', [GoodAuthController::class, 'processlogin'])->name('login.process');
    
});

// versi saya dan panjul
// Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'processlogin'])->name('login.process');




