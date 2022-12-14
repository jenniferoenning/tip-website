<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\testeController;
use App\Http\Controllers\Api\PostController;
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

Route::apiResource('comments', CommentController::class);
Route::get('comment/{id}', [CommentController::class, 'show']);
Route::put('comment/{id}/edit', [CommentController::class, 'edit']);

Route::apiResource('posts', PostController::class);
Route::get('post/{id}', [PostController::class, 'show']);
Route::put('post/{id}/edit', [PostController::class, 'edit']);

Route::apiResource('/getSentiment', testeController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
