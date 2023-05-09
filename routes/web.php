<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogistikController;
use App\Http\Controllers\PendakianController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('pages.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');

Route::post('/doLogin', [AuthenticateController::class, 'doLogin'])->name('doLogin');
Route::post('/doRegister', [AuthenticateController::class, 'doRegister'])->name('doRegister');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class,'index'])->name('home');
    Route::get('/logout', [AuthenticateController::class,'doLogout'])->name('logout'); 
    Route::get('/pendakian/ticket/{id}', [PendakianController::class,'ticket'])->name('pendakian.ticket'); 
    Route::resource('/pendakian', PendakianController::class);
    Route::resource('/logistik', LogistikController::class);
    Route::resource('/user', UserController::class);
    
});