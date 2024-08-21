<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Tasks\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
------------------------------------------------------------------------
|    AUTHENTICATION ENDPOINTS
|-----------------------------------------------------------------------
 */
Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);

/*
------------------------------------------------------------------------
|    TASKS ENDPOINTS
|-----------------------------------------------------------------------
 */
Route::prefix('tasks')->middleware('auth:api')->group(function () {
    Route::post('/', [TasksController::class, 'create']);
    Route::get('/', [TasksController::class, 'getAllTasks']);
    Route::get('get-by-id/{id}', [TasksController::class, 'getTask']);
    Route::put('update/{id}', [TasksController::class, 'update']);
    Route::put('mark-as-completed/{id}', [TasksController::class, 'markAsCompleted']);

    Route::delete('delete/{id}', [TasksController::class, 'delete']);

});


