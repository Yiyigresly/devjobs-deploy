<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacancyController;
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

Route::get('/', HomeController::class)->name('home');

// Auth , vacantes, reclutador
Route::get('/dashboard',[ VacancyController::class, 'index' ])
  ->middleware(['auth', 'verified','role.recruiter'])->name('vacancies.index'); //? middleware para redireccioar si es o no reclutador
Route::get('/vacancies/create',[ VacancyController::class, 'create' ])
  ->middleware(['auth', 'verified'])->name('vacancies.create');
Route::get('/vacancies/{vacancy}/edit',[ VacancyController::class, 'edit' ])
  ->middleware(['auth', 'verified'])->name('vacancies.edit');
Route::get('/vacancies/{vacancy}',[ VacancyController::class, 'show' ])->name('vacancies.show'); // todos pueden acceder a esta ruta sin o con auth

//candidatos de la vacante
Route::get('candidates/{vacancy}',[CandidateController::class,'index'])
 ->middleware(['auth', 'verified','role.recruiter'])
 ->name('candidates.index');

//? notifications, solo un metodo, por eso no hace falta  especificar un metodo, ya que tiene el invoke
Route::get('/notifications', NotificationController::class)
 ->middleware(['auth', 'verified','role.recruiter'])->name('notifications');

// perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
