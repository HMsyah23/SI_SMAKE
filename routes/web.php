<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;

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
Route::get('home', [HomeController::class, 'index']);
Route::get('daftar/pegawai', [HomeController::class, 'pegawai'])->name('daftar.pegawai');
Route::get('profil', [HomeController::class, 'profil'])->name('profil');
Route::get('profil/{slug}', [HomeController::class, 'profilShow'])->name('profil.slug');;
Route::get('berita/main', [HomeController::class, 'berita'])->name('berita');
Route::get('berita/{slug}', [HomeController::class, 'beritaShow']);
Route::get('berita/{tipe}/{paramater}', [HomeController::class, 'beritaCari'])->name('berita.cari');
Route::post('berita/pencarian', [HomeController::class, 'beritaPencarian'])->name('berita.pencarian');
Route::get('galeris/video/', [HomeController::class, 'galeriVideo'])->name('galeri.video');
Route::get('galeris/foto/', [HomeController::class, 'galeriFoto'])->name('galeri.foto');
Route::get('kontak', [HomeController::class, 'kontak'])->name('kontak');

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

Route::get('surats', [CustomAuthController::class, 'portal'])->name('portal');


Route::group(['prefix'=>'admin','middleware' => ['auth']], function () { 
    Route::get('user', [UserController::class, 'create'])->name('user'); 
    
    Route::get('surat/masuk', function () {
        return view('admin.suratMasuk.index');
    })->name('surat.masuk');
    
    Route::get('surat/keluar', function () {
        return view('admin.suratKeluar.index');
    })->name('surat.keluar');

    Route::get('galeri', [GaleriController::class, 'home'])->name('galeri');
    Route::get('galeri/list/{id}', [GaleriController::class, 'list'])->name('show.galeri');

    Route::get('berita', function () {
        return view('admin.berita.index');
    })->name('berita');

    Route::get('informasi', function () {
        return view('admin.informasi.index');
    })->name('informasi');

    Route::get('profil', function () {
        return view('admin.profil.index');
    })->name('profil');

    Route::get('menu', function () {
        return view('admin.menu.index');
    })->name('menu');

    Route::get('berita/create', [BeritaController::class, 'create'])->name('beritas.create');
    Route::get('profil/create', [ProfilController::class, 'create'])->name('profils.create');
    Route::get('pegawai/create', [PegawaiController::class, 'create'])->name('pegawais.create');

    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard'); 
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    Route::get('roles', [RoleController::class, 'home'])->name('roles');
    Route::get('pegawai', [PegawaiController::class, 'home'])->name('pegawai');
    Route::get('divisi', [DivisiController::class, 'home'])->name('divisi');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('surat/masuk/{suratMasuk}/edit', [SuratMasukController::class, 'edit'])->name('suratMasuk.edit');
    Route::get('surat/keluar/{suratKeluar}/edit', [SuratKeluarController::class, 'edit'])->name('suratKeluar.edit');
    Route::get('suratMasuks/{suratMasuk}/terbaca', [SuratMasukController::class, 'terbaca'])->name('suratMasuk.terbaca');
    Route::get('berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::get('profil/{profil}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::get('informasi/{informasi}/edit', [InformasiController::class, 'edit'])->name('informasi.edit');

    Route::get('lembarDisposisi/{suratMasuk}', [LaporanController::class,'lembarDisposisi'])->name('laporan.disposisi');

});