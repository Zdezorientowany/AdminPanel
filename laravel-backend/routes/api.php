<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) { //Route for user authentication
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::post('/user/create', [UserController::class, 'store'])
    ->middleware('auth')
    ->name('user.create');

Route::get('/user/{user}', [UserController::class, 'show'])
    ->middleware('auth')
    ->name('user.show');

Route::get('/users', [UserController::class, 'showAllUsers'])
    ->middleware('auth')
    ->name('users.showAllUsers');

Route::put('/user/{user}', [UserController::class, 'update'])
    ->middleware('auth')
    ->name('user.update');

Route::delete('/user/{user}', [UserController::class, 'destroy'])
    ->middleware('auth')
    ->name('user.destroy');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('contents', ContentController::class);
});

Route::get('/contents', [ContentController::class, 'showAll'])
    ->middleware('auth')
    ->name('contents.showAll');

Route::delete('/content/{content}', [ContentController::class, 'destroy'])
    ->middleware('auth')
    ->name('content.destroy');

Route::post('/content/create', [ContentController::class, 'store'])
    ->middleware('auth')
    ->name('content.create');

Route::put('/content/{content}', [ContentController::class, 'update'])
    ->middleware('auth')
    ->name('content.update');

