<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\WordsController;
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

// Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/me', [AuthController::class, 'me']);

// Words
Route::get('/', [WordsController::class, 'index']);
Route::post('/words', [WordsController::class, 'store']);
Route::post('/words/{id}', [WordsController::class, 'show']);
Route::patch('/words/{id}', [WordsController::class, 'update']);
Route::delete('/words/{id}', [WordsController::class, 'delete']);

// Comments
Route::post('/comment', [CommentsController::class, 'store']);
Route::patch('/comment/{id}', [CommentsController::class, 'update']);
Route::delete('/comment/{id}', [CommentsController::class, 'delete']);

