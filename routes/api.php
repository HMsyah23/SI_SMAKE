<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController, App\Http\Controllers\RoleController, App\Http\Controllers\DivisiController, App\Http\Controllers\SuratMasukController, App\Http\Controllers\SuratKeluarController;

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

Route::resource('users',UserController::class);
Route::resource('roles',RoleController::class);
Route::resource('divisis',DivisiController::class);
Route::resource('suratMasuks',SuratMasukController::class);
Route::resource('suratMasuks',SuratMasukController::class);
Route::get('suratMasuks/filter/{year}',[SuratMasukController::class,'filter']);
Route::resource('suratKeluars',SuratKeluarController::class);
Route::get('suratKeluars/filter/{year}',[SuratKeluarController::class,'filter']);