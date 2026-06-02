<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// головна сторінка
Route::get('/', function () {
    return view('welcome');
});

// панель керування після входу
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// усі маршрути, які вимагають обов'язкової авторизації
Route::middleware('auth')->group(function () {

    // стандартні маршрути
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // доступ тільки для Адміністратора (повний CRUD учнів)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('students', StudentController::class);
    });

    // доступ тільки для викладачів (повний CRUD завдань та оцінок)
    Route::middleware(['role:teacher'])->group(function () {
        Route::resource('tasks', TaskController::class);
    });

});

require __DIR__.'/auth.php';
