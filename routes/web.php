<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [TaskController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::resource('tasks',TaskController::class)->middleware('auth');
Route::get('toggle/{id}',[TaskController::class,'toggleStatus'])->name('task.toggle')->middleware('auth');
Route::post('filter',[TaskController::class,'filterByStatus'])->name('task.filter')->middleware('auth');
Route::post('search',[TaskController::class,'search'])->name('task.search')->middleware('auth');
Route::post('filterByPriority',[TaskController::class,'filterByPriority'])->name('task.filterByPriority')->middleware('auth');