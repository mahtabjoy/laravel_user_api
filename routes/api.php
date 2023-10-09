<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('all_users',[UserController::class, 'index']);
Route::get('user/{id}',[UserController::class, 'show']);
Route::post('store_user',[UserController::class, 'store']);
Route::put('update_user/{id}',[UserController::class, 'update']);
Route::delete('delete_user/{id}',[UserController::class, 'destroy']);
