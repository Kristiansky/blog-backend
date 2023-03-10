<?php

    use App\Http\Controllers\API\AuthController;
    use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::resource('posts',PostController::class);
Route::resource('comments',CommentController::class);
Route::get('posts-count', [PostController::class, 'postsCount']);
Route::post('register-user', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
