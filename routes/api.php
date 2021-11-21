<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController, 
    App\Http\Controllers\RoleController, 
    App\Http\Controllers\DivisiController, 
    App\Http\Controllers\SuratMasukController, 
    App\Http\Controllers\SuratKeluarController,
    App\Http\Controllers\GaleriController,
    App\Http\Controllers\BeritaController,
    App\Http\Controllers\ProfilController,
    App\Http\Controllers\InformasiController;

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
Route::put('users/{user}/changePassword',[UserController::class,'changePassword']);
Route::resource('roles',RoleController::class);
Route::resource('divisis',DivisiController::class);
Route::resource('suratMasuks',SuratMasukController::class);
Route::resource('suratMasuks',SuratMasukController::class);
Route::get('suratMasuks/filter/{year}',[SuratMasukController::class,'filter']);
Route::get('suratMasuks/divisi/{divisi}',[SuratMasukController::class,'divisi']);
Route::resource('suratKeluars',SuratKeluarController::class);
Route::get('suratKeluars/filter/{year}',[SuratKeluarController::class,'filter']);
Route::get('beritas/filter/category',[BeritaController::class,'filter']);

Route::resource('galeris',GaleriController::class);
Route::resource('beritas',BeritaController::class);
Route::resource('profils',ProfilController::class);
Route::resource('informasis',InformasiController::class);

