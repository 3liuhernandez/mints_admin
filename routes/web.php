<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
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

    Route::group(['prefix' => 'students'], function () {
        Route::get('/', [PageController::class, 'students'])->name('students.home');
        Route::post('store', [StudentController::class, 'store'])->name('students.store');
    });

    Route::group(['prefix' => 'courses'], function () {
        Route::get('/', [PageController::class, 'courses'])->name('courses.home');
        Route::get('view/{id}', [CourseController::class, 'show'])->name('courses.show');
        Route::post('store', [CourseController::class, 'store'])->name('courses.store');
    });

});