<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/tickets/create', [AuthController::class, 'createTicket'])->name('tickets.create');
Route::post('/tickets', [AuthController::class, 'storeTicket'])->name('tickets.store');
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'processlogin'])->name('login.process');
Route::get('/home', [AuthController::class, 'home'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('ada login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/tickets', [AuthController::class, 'ticketlist'])->name('tickets');
Route::get('/history', [AuthController::class, 'tickethistory'])->name('history');
Route::get('/home', [AuthController::class, 'index'])->name('home');
Route::get('/profile', [AuthController::class, 'show'])->name('profile');
Route::get('/tickets/{id}/edit', [AuthController::class, 'editTicket'])->name('tickets.edit');
Route::put('/tickets/{id}', [AuthController::class, 'updateTicket'])->name('tickets.update');
Route::post('/profile/upload', [AuthController::class, 'uploadProfilePicture'])->name('profile.upload');


