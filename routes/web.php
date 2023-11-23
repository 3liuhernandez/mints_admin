<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('ingreso{params?}', [PageController::class, 'login'])->name('login');
Route::post('ingreso', [LoginController::class, 'validate_login'])->name('login.post');

Route::middleware(['auth'])->group(function () {

    // load component
    Route::get('project/load/component/{section}/{component}', [PageController::class, 'load_component'])->name('load_component');

    Route::get('home', [PageController::class, 'home'])->name('home');
    Route::get('logout', [PageController::class, 'logout'])->name('logout');

    Route::get('memberships', [PageController::class, 'memberships'])->name('memberships.home');
    Route::post('memberships/store', [MemberController::class, 'store'])->name('memberships.store');
});