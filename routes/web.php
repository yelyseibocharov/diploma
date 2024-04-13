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
    Route::post('/profile/edit/professor/{id}', [\App\Http\Controllers\Dashboard::class, 'editProfessor'])->name('profile_edit_professor');


    Route::get('/get-departments/{id}', [\App\Http\Controllers\MainController::class, 'getDepartments']);
    Route::get('/get-institutes/{id}', [\App\Http\Controllers\MainController::class, 'getInstitutes']);
    Route::get('/get-institute/{id}', [\App\Http\Controllers\UniversityController::class, 'getInstitute']);


    //Route::get('/university/{id}', [\App\Http\Controllers\University::class, 'getDepartments'])->name('university');

    Route::get('/university/edit/{id}', [\App\Http\Controllers\UniversityController::class, 'showUniversity'])->name('university_main_edit');
    Route::get('/university/edit/{id}/institutes', [\App\Http\Controllers\UniversityController::class, 'showInstitutes'])->name('university_institutes_edit');

    Route::get('/university/edit/{id}/departments', [\App\Http\Controllers\UniversityController::class, 'showDepartments'])->name('university_departments_edit');
    Route::get('/university/edit/{id}/speciality', [\App\Http\Controllers\UniversityController::class, 'showSpeciality'])->name('university_speciality_edit');
    Route::get('/university/edit/{id}/groups', [\App\Http\Controllers\UniversityController::class, 'showUniversity'])->name('university_groups_edit');
    Route::get('/university/edit/{id}/disciplines', [\App\Http\Controllers\UniversityController::class, 'showUniversity'])->name('university_disciplines_edit');

    Route::get('/get-department/{id}', [\App\Http\Controllers\UniversityController::class, 'getDepartment'])->name('university_edit');
    Route::post('/university/edit/{id}', [\App\Http\Controllers\UniversityController::class, 'editUniversity'])->name('university_edit');
    Route::post('/university/edit/{id}/institutes', [\App\Http\Controllers\UniversityController::class, 'addInstitutes'])->name('university_institutes_edit');
    Route::post('/university/edit/{id}/departments', [\App\Http\Controllers\UniversityController::class, 'addDepartments'])->name('university_departments_edit');
    Route::post('/institute-edit/{id}', [\App\Http\Controllers\UniversityController::class, 'editInstitute'])->name('university_institute_edit');
    Route::post('/department-edit/{id}', [\App\Http\Controllers\UniversityController::class, 'editDepartment'])->name('university_department_edit');


});

