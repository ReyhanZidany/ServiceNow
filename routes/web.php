<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/tickets', function () {
    return view('tickets');
});

Route::get('/history', function () {
    return view('history');
});        

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'processlogin'])->name('login.process');
Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/tickets', [AuthController::class, 'ticketlist'])->name('tickets');
Route::get('/history', [AuthController::class, 'tickethistory'])->name('history');
