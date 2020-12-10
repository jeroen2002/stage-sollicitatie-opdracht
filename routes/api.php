<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

Route::get('/todos', [TodoController::class, 'index']);
Route::post('/todo', [TodoController::class, 'create']);
Route::post('/todo/{id}/destroy', [TodoController::class, 'destroy']);
Route::post('/todo/{id}/toggle', [TodoController::class, 'toggleTodo']);
