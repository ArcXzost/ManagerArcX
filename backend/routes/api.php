<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APITasksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('task',[APITasksController::class,'create']);
Route::get('task',[APITasksController::class,'index']);
Route::get('task/todos/{email}/{date}',[APITasksController::class,'getTodos']);
Route::get('task/completed/{email}',[APITasksController::class,'getCompletedTasks']);
Route::get('task/overdue/{email}',[APITasksController::class,'getOverdueTasks']);
Route::get('task/{email}',[APITasksController::class,'getTaskByUser']);
Route::get('task/{email}/{date}',[APITasksController::class,'getTaskByUserAndDate']);
Route::get('task/{id}',[APITasksController::class,'getTaskByID']);
Route::put('task/{id}',[APITasksController::class,'updateTaskByID']);
Route::post('task/done/{id}',[APITasksController::class,'markAsDone']);
Route::delete('task/{id}',[APITasksController::class,'delete']);
Route::post('task/mail',[APITasksController::class,'mailUser']);
// Route::get('task/login', [APITasksController::class,'redirectToGoogle'])->name('login');
// Route::get('task/google/callback', [APITasksController::class,'handleGoogleCallback']);



