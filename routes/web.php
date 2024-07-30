<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoodAuthController;
use App\Http\Controllers\GoodHomeController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;
use Illuminate\Support\Facades\Auth;


Route::get('/tickets/create', [AuthController::class, 'createTicket'])->name('tickets.create');
Route::post('/tickets', [AuthController::class, 'storeTicket'])->name('tickets.store');
Route::get('/tickets', [AuthController::class, 'ticketlist'])->name('tickets');
Route::get('/history', [AuthController::class, 'tickethistory'])->name('history');
Route::get('/profile', [AuthController::class, 'show'])->name('profile');
Route::get('/tickets/{id}/edit', [AuthController::class, 'editTicket'])->name('tickets.edit');
Route::put('/tickets/{id}', [AuthController::class, 'updateTicket'])->name('tickets.update');
Route::post('/profile/upload', [AuthController::class, 'uploadProfilePicture'])->name('profile.upload');
Route::get('/tickets/{id}', [AuthController::class, 'view'])->name('tickets.view');
Route::get('/history', [AuthController::class, 'search'])->name('history');

// routes/web.php

Route::get('/register-pic', [AuthController::class, 'showRegistrationForm'])
    
    ->name('register.pic');
Route::post('/register-pic', [AuthController::class, 'registerPic']);


Route::middleware('guest')->group(function(){
    Route::get('/', [GoodAuthController::class, 'index'])->name('login');
    Route::post('/login', [GoodAuthController::class, 'processlogin'])->name('login.process');
    
});


Route::middleware('auth')->group(function(){
    Route::get('/home', [GoodHomeController::class, 'index'])->name('home');
    Route::get('/logout', [GoodAuthController::class, 'logout'])->name('logout');
});



// versi saya dan panjul
// Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'processlogin'])->name('login.process');




