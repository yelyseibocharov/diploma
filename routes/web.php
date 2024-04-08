<?php

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

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\MainController::class, 'login'])->name('auth.login');
    Route::post('/login', [\App\Http\Controllers\MainController::class, 'autorization'])->name('auth.login');
    Route::get('/register', [\App\Http\Controllers\MainController::class, 'register'])->name('auth.register');
    Route::post('/register', [\App\Http\Controllers\MainController::class, 'registration'])->name('auth.register');
});
Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\MainController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [\App\Http\Controllers\Dashboard::class, 'index'])->name('dashboard');
    Route::get('/dashboard/students', [\App\Http\Controllers\Dashboard::class, 'getTable'])->name('dashboard_students');
    Route::get('/dashboard/professors', [\App\Http\Controllers\Dashboard::class, 'getProfessors'])->name('dashboard_professors');
    Route::get('/dashboard/grades', [\App\Http\Controllers\Dashboard::class, 'getTable'])->name('dashboard_grades');


    Route::get('/profile/{id}', [\App\Http\Controllers\Dashboard::class, 'showProfile'])->name('profile');
    Route::get('/profile/add/professor', [\App\Http\Controllers\Dashboard::class, 'getProfessorCreateView'])->name('profile_add_professor');
    Route::post('/profile/add/professor', [\App\Http\Controllers\Register::class, 'registration'])->name('profile_add_professor');


    Route::get('/get-departments/{id}', [\App\Http\Controllers\Dashboard::class, 'getDepartments']);


});

