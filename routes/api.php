<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController, 
    App\Http\Controllers\RoleController, 
    App\Http\Controllers\DivisiController, 
    App\Http\Controllers\SuratMasukController, 
    App\Http\Controllers\SuratKeluarController,
    App\Http\Controllers\FileGaleriController,
    App\Http\Controllers\LampiranSuratKeluarController,
    App\Http\Controllers\GaleriController,
    App\Http\Controllers\PegawaiController,
    App\Http\Controllers\PangkatController,
    App\Http\Controllers\EselonController,
    App\Http\Controllers\JabatanController,
    App\Http\Controllers\BeritaController,
    App\Http\Controllers\ProfilController,
    App\Http\Controllers\InformasiController,
    App\Http\Controllers\TagController,
    App\Http\Controllers\CategoryController;

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
Route::get('valid/suratMasuks',[SuratMasukController::class,'valid']);
Route::get('disposisi/suratMasuks',[SuratMasukController::class,'dispos']);
Route::get('distribusi/suratMasuks',[SuratMasukController::class,'distri']);
Route::get('needValidation/suratMasuks',[SuratMasukController::class,'needValidation']);
Route::get('suratMasuks/filter/{year}',[SuratMasukController::class,'filter']);
Route::get('suratMasuks/{divisi}/divisi',[SuratMasukController::class,'divisi']);
Route::get('suratMasuks/{suratMasuk}/validasi',[SuratMasukController::class,'validasi']);
Route::post('suratMasuks/{suratMasuk}/distribusi',[SuratMasukController::class,'distribusi']);
Route::post('suratMasuks/{suratMasuk}/disposisi',[SuratMasukController::class,'disposisi']);

Route::resource('suratKeluars',SuratKeluarController::class);
Route::post('suratKeluars/{suratKeluar}/validasi',[SuratKeluarController::class,'validasi']);
Route::put('suratKeluars/{suratKeluar}/fileSuratKeluar',[SuratKeluarController::class,'fileSuratKeluar']);
Route::put('suratKeluars/{suratKeluar}/update',[SuratKeluarController::class,'perbarui']);
Route::get('suratKeluars/filter/{year}',[SuratKeluarController::class,'filter']);
Route::get('suratKeluars/{divisi}/divisi',[SuratKeluarController::class,'divisi']);
Route::get('needValidation/suratKeluars',[SuratKeluarController::class,'needValidation']);

Route::resource('pegawais',PegawaiController::class);
Route::resource('pangkats',PangkatController::class);
Route::resource('eselons',EselonController::class);
Route::resource('jabatans',JabatanController::class);
Route::resource('galeris',GaleriController::class);
Route::resource('fileGaleris',FileGaleriController::class);
Route::resource('categories',CategoryController::class);
Route::resource('tags',TagController::class);
Route::resource('beritas',BeritaController::class);
Route::resource('profils',ProfilController::class);
Route::resource('informasis',InformasiController::class);
Route::resource('lampiranSuratKeluars',LampiranSuratKeluarController::class);

