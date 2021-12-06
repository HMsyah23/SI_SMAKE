<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

Route::get('changeNav', function () {
    $state = Session::get('navbarState');
    if ($state == false) {
        Session::put('navbarState',true);
    } else {
        Session::put('navbarState',false);
    }
    $state = Session::get('navbarState');
    return response()->json($state, 200);
});


Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 

Route::group(['prefix'=>'admin','middleware' => ['auth']], function () { 
    Route::get('user', [UserController::class, 'create'])->name('user'); 
    
    Route::get('surat/masuk', function () {
        return view('admin.suratMasuk.index');
    })->name('surat.masuk');
    
    Route::get('surat/keluar', function () {
        return view('admin.suratKeluar.index');
    })->name('surat.keluar');

    Route::get('galeri', function () {
        return view('admin.galeri.index');
    })->name('galeri');

    Route::get('berita', function () {
        return view('admin.berita.index');
    })->name('berita');

    Route::get('informasi', function () {
        return view('admin.informasi.index');
    })->name('informasi');

    Route::get('profil', function () {
        return view('admin.profil.index');
    })->name('profil');

    Route::get('berita/create', [BeritaController::class, 'create'])->name('beritas.create');

    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard'); 
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    Route::get('roles', [RoleController::class, 'home'])->name('roles');
    Route::get('divisi', [DivisiController::class, 'home'])->name('divisi');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('surat/masuk/{suratMasuk}/edit', [SuratMasukController::class, 'edit'])->name('suratMasuk.edit');
    Route::get('surat/keluar/{suratKeluar}/edit', [SuratKeluarController::class, 'edit'])->name('suratKeluar.edit');
    Route::get('suratMasuks/{suratMasuk}/terbaca', [SuratMasukController::class, 'terbaca'])->name('suratMasuk.terbaca');
    Route::get('galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::get('berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::get('profil/{profil}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::get('informasi/{informasi}/edit', [InformasiController::class, 'edit'])->name('informasi.edit');

    Route::get('lembarDisposisi/{suratMasuk}', [LaporanController::class,'lembarDisposisi'])->name('laporan.disposisi');

});