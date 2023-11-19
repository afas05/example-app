<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\TaskController;

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
    if ($request->has('skip')) {
        return response()->json(\App\Models\User::find(1)->toArray());
    } else {
        return $request->user();
    }
});

Route::middleware('auth:sanctum')->resource('tasks', TaskController::class)
    ->missing(function (Request $request) {
        return response()->abort(404);
    });

Route::patch('tasks/{id}/done', [TaskController::class, 'markDone']);
