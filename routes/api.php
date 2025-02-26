<?php

use App\Http\Controllers\ProductosController;
use App\Http\Controllers\LoginAdminsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginAdminsController::class, 'login'])->name('login');
Route::post('/logout', [LoginAdminsController::class, 'logout'])->middleware('auth.jwt')->name('logout');
Route::get('/me', [LoginAdminsController::class, 'me'])->middleware('auth.jwt');

Route::middleware(['auth.jwt'])->group(function () {
    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductosController::class, 'index']);
        Route::post('/', [ProductosController::class, 'store']);
        Route::get('/{id}', [ProductosController::class, 'show']);
        Route::put('/{id}', [ProductosController::class, 'update']);
        Route::delete('/{id}', [ProductosController::class, 'destroy']);
    });
});

Route::get('/ping', function () {
    return response()->json(['message' => 'Laravel está conectado con Angular'], 200);
});
