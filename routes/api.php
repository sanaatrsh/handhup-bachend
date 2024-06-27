<?php

use App\Http\Controllers\AccessTokensController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function (Request $request) {
    return "america yaa";
});


Route::apiResource('user', UserController::class);
Route::post('login', [UserController::class, 'login']);
Route::post('logout/{token?}', [UserController::class, 'logout'])->middleware('auth:sanctum');


Route::apiResource('project', ProjectController::class)->middleware('auth:sanctum')->except(['index', 'show']);
Route::get('project', [ProjectController::class, 'index'])->name('project.index')->withoutMiddleware(['auth:sanctum']);
Route::get('project/{id}', [ProjectController::class, 'show'])->name('project.show')->withoutMiddleware(['auth:sanctum']);

Route::apiResource('category', CategoryController::class);

Route::apiResource('{project_id}/product', ProductController::class)->middleware('auth:sanctum')->except('show', 'index');
Route::get('{project_id}/product', [ProductController::class, 'index'])->withoutMiddleware(['auth:sanctum']);
Route::get('{project_id}/product/{id}', [ProductController::class, 'show'])->withoutMiddleware(['auth:sanctum']);

Route::apiResource('report', ReportController::class);

Route::apiResource('review', ReviewController::class);

Route::apiResource('bill', BillController::class);

Route::post('auth/access-token', [AccessTokensController::class, 'store'])
    ->middleware('guest:sanctum');
