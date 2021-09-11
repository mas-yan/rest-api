<?php

use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class)->name('login');
Route::post('logout', LogoutController::class);

Route::middleware('auth:api')->group(function () {
  Route::post('create-new-article', [ArticleController::class, 'store']);
  Route::put('update-article/{article}', [ArticleController::class, 'update']);
  Route::delete('delete-article/{article}', [ArticleController::class, 'destroy']);
  Route::get('user', UserController::class);
});

Route::get('articles/{article}', [ArticleController::class, 'show']);
Route::get('articles/', [ArticleController::class, 'index']);
