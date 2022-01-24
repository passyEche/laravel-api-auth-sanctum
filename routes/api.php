<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\AuthController;


// use App\Models\Todos;


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

Route::post('register ', [AuthController::class, 'register']);
Route::post('/login ', [AuthController::class, 'login']);

Route::get('/todos', [TodosController::class, 'index']);
Route::get('/todos/{todo}', [TodosController::class, 'show']);


Route::resource('todos', TodosController::class);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/todos', [TodosController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/todos/{todo}', [TodosController::class, 'update']);
    Route::delete('/todos/{todo}', [TodosController::class, 'destroy']);


});
