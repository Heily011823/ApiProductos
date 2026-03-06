<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoBaseController;

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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

//Autenticadas
Route::middleware('auth:api')->group(function () {
    Route::resource('productos', ProductoController::class);
    Route::get('me', [AuthController::class, 'me']);

    //Solo consulta admin y usuario
    Route::get('productos', [ProductoBaseController::class, 'index'])->middleware('role:admin, usuario');
    Route::post('productos', [ProductoBaseController::class, 'store'])->middleware('role:admin');
});