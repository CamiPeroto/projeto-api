<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum'); não vai ser utilizado


//Rotas Públicas
Route::post('/login', [LoginController::class, 'login'])->name('login'); //http://127.0.0.1:8000/api/login/

//Rotas Restritas
Route::group(['middleware'=> ['auth:sanctum']], function(){

Route::get('/user', [UserController::class, 'index']); //http://127.0.0.1:8000/api/user?page=2
Route::get('/user/{user}', [UserController::class, 'show']); //http://127.0.0.1:8000/api/user/1
Route::post('/user', [UserController::class, 'store']); //http://127.0.0.1:8000/api/user/
Route::put('/user/{user}', [UserController::class, 'update']); //http://127.0.0.1:8000/api/user/1
Route::delete('/user/{user}', [UserController::class, 'destroy']); //http://127.0.0.1:8000/api/user/1
Route::put('/user-password/{user}', [UserController::class, 'updatePassword']); //http://127.0.0.1:8000/api/user-password/1

});

