<?php

use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('tasks', TaskController::class)
    ->middleware('auth:api')
    ->names('api.tasks');

Route::resource('events', EventController::class)
    ->middleware('auth:api')
    ->names('api.events');

Route::get('/api.tasks/progress/{task}/edit', [App\Http\Controllers\TaskController::class, 'progress_edit']);
Route::patch('/api.tasks/progress/{task}', [App\Http\Controllers\TaskController::class, 'progress_update']);
