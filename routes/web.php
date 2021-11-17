<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;

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

Route::get('/', function () {
    return view('index');
});

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

    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard'); 
    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    Route::get('roles', [RoleController::class, 'home'])->name('roles');
    Route::get('divisi', [DivisiController::class, 'home'])->name('divisi');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('surat/masuk/{suratMasuk}/edit', [SuratMasukController::class, 'edit'])->name('suratMasuk.edit');
    Route::get('surat/keluar/{suratKeluar}/edit', [SuratKeluarController::class, 'edit'])->name('suratKeluar.edit');
});