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
Route::middleware('auth:sanctum')->get('/owners', [UserController::class, 'getOwners']);
Route::get('/', function (Request $request) {
    return "america yaa";
});


Route::apiResource('user', UserController::class);
Route::post('login', [UserController::class, 'login']);
Route::post('logout/{token?}', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('owners', [UserController::class, 'getOwners']);

Route::apiResource('Projects', ProjectController::class)->middleware('auth:sanctum')->except(['index', 'show']);
Route::get('Projects', [ProjectController::class, 'index'])->name('project.index')->withoutMiddleware(['auth:sanctum']);
// Route::get('Projects', [ProjectController::class, 'index'])->name('project.index')->withoutMiddleware(['auth:sanctum']);
Route::post('Projects/{id}', [ProjectController::class, 'show'])->name('project.show')->withoutMiddleware(['auth:sanctum']);


Route::apiResource('Projects/{project_id}/product', ProductController::class)->middleware('auth:sanctum')->except('show', 'index');
Route::get('Projects/{project_id}/product', [ProductController::class, 'index'])->withoutMiddleware(['auth:sanctum']);
Route::get('Projects/{project_id}/product/{id}', [ProductController::class, 'show'])->withoutMiddleware(['auth:sanctum']);
Route::post('search', [ProductController::class, 'search'])->name('project.show')->withoutMiddleware(['auth:sanctum']);

Route::apiResource('category', CategoryController::class);

Route::apiResource('report', ReportController::class)->middleware('auth:sanctum');

Route::apiResource('review', ReviewController::class)->middleware('auth:sanctum');

Route::apiResource('bill', BillController::class);

Route::post('auth/access-token', [AccessTokensController::class, 'store'])
    ->middleware('guest:sanctum');

Route::get('project/{project_id}/owner', [UserController::class, 'showOwner']);
