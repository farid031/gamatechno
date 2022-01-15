<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
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

Route::get('task', 'TaskController@index');
Route::post('createTask', 'TaskController@createNewTask');
Route::put('/setTaskToComplete/{id}', 'TaskController@updateTaskToComplete');
Route::put('/setTaskToActive/{id}', 'TaskController@updateTaskToActive');
Route::put('/setAllTaskToComplete', 'TaskController@updateAllTaskToComplete');
Route::put('/setAllTaskToActive', 'TaskController@updateAllTaskToActive');
Route::get('/countTask/{flag}', 'TaskController@countTask');
Route::delete('/deleteTask/{id}', 'TaskController@deleteTask');
Route::delete('/deleteAllTask', 'TaskController@deleteAllTask');
