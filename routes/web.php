<?php

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
    return view('index');
});

Route::prefix('admin')->group(function(){
    Route::get('/login', [App\Http\Controllers\AdminController::class, 'logview'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.loginproses');
    Route::get('/register', [App\Http\Controllers\AdminController::class, 'register'])->name('admin.register');
    Route::post('/register', [App\Http\Controllers\AdminController::class, 'regadmin'])->name('admin.regadmin');
    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'index'])->name('admin.pelanggan');
    Route::get('/pelangggan/{id_mitra}', [App\Http\Controllers\PelangganController::class, 'pelanggan'])->name('admin.perpel');
    Route::get('/pelanggan/detail/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'detail'])->name('admin.detail.pelanggan');

    Route::get('/barang', [App\Http\Controllers\BarangController::class, 'index'])->name('admin.barang');
    Route::get('/barang/add', [App\Http\Controllers\BarangController::class, 'formadd'])->name('admin.form.barang');
    Route::post('/barang/add', [App\Http\Controllers\BarangController::class, 'add'])->name('admin.tambah.barang');
});

Route::prefix('mitra')->group(function(){
    Route::get('/login', [App\Http\Controllers\MitraController::class, 'logview'])->name('mitra.login');
    Route::post('/login', [App\Http\Controllers\MitraController::class, 'login'])->name('mitra.loginproses');
    Route::get('/register', [App\Http\Controllers\MitraController::class, 'register'])->name('mitra.register');
    Route::post('/register', [App\Http\Controllers\MitraController::class, 'regmitra'])->name('mitra.regmitra');
    Route::get('/logout', [App\Http\Controllers\MitraController::class, 'logout'])->name('mitra.logout');
    Route::get('/', [App\Http\Controllers\MitraController::class, 'index'])->name('mitra.index');
    Route::get('/profil', [App\Http\Controllers\MitraController::class, 'profil'])->name('mitra.profil');
    Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'index'])->name('mitra.pelanggan');
    Route::get('/pelanggan/aktif', [App\Http\Controllers\PelangganController::class, 'aktif'])->name('mitra.pelanggan.aktif');
    Route::get('/pelanggan/add', [App\Http\Controllers\PelangganController::class, 'formadd'])->name('mitra.form.pelanggan');
    Route::post('/pelanggan/add', [App\Http\Controllers\PelangganController::class, 'add'])->name('mitra.tambah.pelanggan');
    Route::get('/pelangggan/edit/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'show'])->name('mitra.edit.pelanggan');
    Route::post('/pelangggan/edit/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'edit'])->name('mitra.proses.edit');

    Route::get('/po', [App\Http\Controllers\PurchaseOrderController::class, 'po'])->name('mitra.po');

    Route::get('/pinjaman', [App\Http\Controllers\PinjamanController::class, 'index'])->name('mitra.pinjaman');
    Route::post('/pinjaman/add', [App\Http\Controllers\PinjamanController::class, 'search'])->name('mitra.pinjam');
    Route::post('/pinjaman/barang', [App\Http\Controllers\PinjamanController::class, 'pinjam'])->name('mitra.pinjam.barang');

    Route::get('/layanan', [App\Http\Controllers\LayananController::class, 'index'])->name('mitra.layanan');
    Route::get('/layanan/add', [App\Http\Controllers\LayananController::class, 'formadd'])->name('mitra.form.layanan');
    Route::post('/layanan/add', [App\Http\Controllers\LayananController::class, 'add'])->name('mitra.tambah.layanan');

    Route::get('/laypel', [App\Http\Controllers\LaypelController::class, 'index'])->name('mitra.laypel');

});

Route::prefix('staff')->group(function(){
    Route::get('/login', [App\Http\Controllers\StaffController::class, 'logview'])->name('staff.login');
    Route::post('/login', [App\Http\Controllers\StaffController::class, 'login'])->name('staff.loginproses');
    Route::get('/register', [App\Http\Controllers\StaffController::class, 'register'])->name('staff.register');
    Route::post('/register', [App\Http\Controllers\StaffController::class, 'regstaff'])->name('staff.regstaff');
    Route::get('/logout', [App\Http\Controllers\StaffController::class, 'logout'])->name('staff.logout');
    Route::get('/', [App\Http\Controllers\StaffController::class, 'index'])->name('staff.index');
    Route::get('/pelanggan', [App\Http\Controllers\PelangganController::class, 'index'])->name('staff.pelanggan');
    Route::get('/pelangggan/{id_mitra}', [App\Http\Controllers\PelangganController::class, 'pelanggan'])->name('staff.perpel');
    Route::get('/pelanggan/detail/{id_pelanggan}', [App\Http\Controllers\PelangganController::class, 'detail'])->name('detail.pelanggan.staff');
});
