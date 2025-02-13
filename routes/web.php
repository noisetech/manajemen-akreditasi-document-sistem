<?php

use App\Http\Controllers\ArsipAkreditasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KerjaSamaController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisiMisiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('home');
});

Route::prefix('internal')
    ->group(function () {
        Route::group(['middleware' => 'auth'], function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');

            // arsip akreditasi
            Route::get('arsip-akreditasi', [ArsipAkreditasiController::class, 'index'])
                ->name('arsip_akreditasi');
            Route::get('arsip-akreditasi/tambah', [ArsipAkreditasiController::class, 'tambah'])
                ->name('arsip_akreditasi.tambah');
            Route::post('arsip-akreditasi/simpan', [ArsipAkreditasiController::class, 'simpan'])
                ->name('arsip-akreditasi.simpan');
            Route::get('arsip-akreditasi/edit/{id}', [ArsipAkreditasiController::class, 'edit'])
                ->name('arsip-akreditasi.edit');
            Route::put('arsip-akreditasi/update/{id}', [ArsipAkreditasiController::class, 'update'])
                ->name('arsip-akreditasi.update');
            Route::get('arsip-akreditasi/hapus/{id}', [ArsipAkreditasiController::class, 'hapus'])
                ->name('arsip-akreditasi.hapus');
            Route::get('arsip-akreditasi/preview/{id}', [ArsipAkreditasiController::class, 'previewDokumen'])
                ->name('arsip-akreditasi.preview');


            // penelitian
            Route::get('penelitian', [PenelitianController::class, 'index'])
                ->name('penelitian');
            Route::get('penelitian/tambah', [PenelitianController::class, 'tambah'])
                ->name('penelitian.tambah');
            Route::post('penelitian/simpan', [PenelitianController::class, 'simpan'])
                ->name('penelitian.simpan');
            Route::get('penelitian/edit/{id}', [PenelitianController::class, 'edit'])
                ->name('penelitian.edit');
            Route::put('penelitian/update/{id}', [PenelitianController::class, 'update'])
                ->name('penelitian.update');
            Route::get('penelitian/hapus/{id}', [PenelitianController::class, 'hapus'])
                ->name('penelitian.hapus');

            // permission
            Route::get('permission', [PermissionController::class, 'index'])
                ->name('permission');
            Route::get('permission/data', [PermissionController::class, 'data'])
                ->name('permission.data');
            Route::get('permission/tambah', [PermissionController::class, 'tambah'])
                ->name('permission.tambah');
            Route::post('permission/simpan', [PermissionController::class, 'simpan'])
                ->name('permission.simpan');
            Route::get('permission/getDataById/{id}', [PermissionController::class, 'getDataById'])
                ->name('permission.getDataById');
            Route::post('permission/update', [PermissionController::class, 'update'])
                ->name('permission.update');
            Route::post('permission/hapus', [PermissionController::class, 'hapus'])
                ->name('permission.hapus');

            // role
            Route::get('role', [RoleController::class, 'index'])
                ->name('role');
            Route::get('role/data', [RoleController::class, 'data'])
                ->name('role.data');
            Route::get('role/tambah', [RoleController::class, 'tambah'])
                ->name('role.tambah');
            Route::get('role/listPermission', [RoleController::class, 'listPermission'])
                ->name('role.listPermission');
            Route::post('role/simpan', [RoleController::class, 'simpan'])
                ->name('role.simpan');
            Route::get('role/getDataById/{id}', [RoleController::class, 'getDataById'])
                ->name('role.getDataById');
            Route::post('role/update', [RoleController::class, 'update'])
                ->name('role.update');
            Route::post('role/hapus', [RoleController::class, 'hapus'])
                ->name('role.hapus');
            Route::get('role/listPermissionByRoleId/{id}', [RoleController::class, 'listPermissionByRoleId'])
                ->name('role.listPermissionByRoleId');

            // users
            Route::get('users', [UserController::class, 'index'])
                ->name('users');
            Route::get('users/data', [UserController::class, 'data'])
                ->name('users.data');
            Route::get('users/listRole', [UserController::class, 'listRole'])
                ->name('users.listRole');
            Route::get('users/listFakultas', [UserController::class, 'listFakultas'])
                ->name('users.listFakultas');

            Route::post('users/simpan', [UserController::class, 'simpan'])
                ->name('users.simpan');
            Route::post('users/hapus', [UserController::class, 'hapus'])
                ->name('users.hapus');


            // fakultas
            Route::get('fakultas', [FakultasController::class, 'index'])
                ->name('fakultas');
            Route::get('fakultas/data', [FakultasController::class, 'data'])
                ->name('fakultas.data');
            Route::get('fakultas/getDataById/{id}', [FakultasController::class, 'getDataById'])
                ->name('fakultas.getDataById');
            Route::post('fakultas/simpan', [FakultasController::class, 'simpan'])
                ->name('fakultas/simpan');
            Route::post('fakultas/hapus', [FakultasController::class, 'hapus'])
                ->name('fakultas/hapus');
            Route::post('fakultas/update', [FakultasController::class, 'update'])
                ->name('fakultas/update');


            Route::get('visi-misi', [VisiMisiController::class, 'index'])
                ->name('visi_misi');

            Route::get('visi-misi/tambah', [VisiMisiController::class, 'tambah'])
                ->name('visi_misi.tambah');
            Route::post('visi-misi/simpan', [VisiMisiController::class, 'simpan'])
                ->name('visi_misi.simpan');
            Route::get('visi-misi/hapus/{id}', [VisiMisiController::class, 'hapus'])
                ->name('visi_misi.hapus');


            Route::get('kerja-sama', [KerjaSamaController::class, 'index'])
                ->name('kerja_sama');
            Route::get('kerja-sama/tambah', [KerjaSamaController::class, 'tambah'])
                ->name('kerja_sama.tambah');
            Route::post('kerja-sama/simpan', [KerjaSamaController::class, 'simpan'])
                ->name('kerja-sama.simpan');
            Route::get('kerja-sama/hapus/{id}', [KerjaSamaController::class, 'hapus'])
                ->name('kerja-sama.hapus');
        });
    });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
