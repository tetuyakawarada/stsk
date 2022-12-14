<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EventController;


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

Route::get('/', [TaskController::class, 'index'])
    ->name('root')
    ->middleware('auth');

Route::get('/welcome', function () {
    return view('welcome');
})->middleware('guest')
    ->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD用
    Route::resource('tasks', TaskController::class);

    Route::resource('events', EventController::class);

    Route::get('/tasks/progress/{task}/edit', [App\Http\Controllers\TaskController::class, 'progress_edit']);
    Route::patch('/tasks/progress/{task}', [App\Http\Controllers\TaskController::class, 'progress_update']);
});
