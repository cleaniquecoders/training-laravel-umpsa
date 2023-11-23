<?php

use App\Http\Controllers\Api\AuthenticateController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthenticateController::class, 'login']);
Route::post('/validate', [AuthenticateController::class, 'validateToken']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthenticateController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/tasks', function(Request $request) {
        return Task::where('user_id', $request->user()->id)->paginate();
    });
});
