<?php

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

Route::resource('students', \App\Http\Controllers\StudentController ::class);


Route::resource('achievements', \App\Http\Controllers\AchievementController::class);

Route::get('/students/{student_id}/achievements/{achievement_id}/confirm-delete', [StudentController::class, 'confirmDeleteAchievement'])
    ->name('students.confirmDeleteAchievement');

Route::delete('students/{student_id}/achievement/{achievement_id}/', [\App\Http\Controllers\StudentController ::class, 'destroyAchievement'])->name('students.destroyAchievement');
