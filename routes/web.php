<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;


// ===============================
// DASHBOARD (gunakan 1 route SAJA)
// ===============================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('checkislogin');
// ===============================
// RESOURCE ROUTES
// ===============================
Route::resource('pelanggan', PelangganController::class);
Route::group(['middleware' => ['checkrole:Super Admin']], function () {
  Route::get('user',[UserController::class,'index'])->name('user.list');
});

Route::resource('user', UserController::class);

// Delete file pelanggan
Route::delete('/pelanggan/{pelanggan_id}/file/{file_id}',
    [PelangganController::class, 'deleteFile']
)->name('pelanggan.deleteFile');

// ===============================
// ROUTE LAIN
// ===============================
Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', fn() => 'Selamat Datang di Website Kampus PCR!');
Route::get('/mahasiswa', fn() => 'Halo Mahasiswa')->name('mahasiswa.show');

Route::get('/nama/{param1}', fn($param1) => 'Nama saya: ' . $param1);
Route::get('/nim/{param1?}', fn($param1 = '') => 'NIM saya: ' . $param1);

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);
Route::get('/matakuliah/{param1}', [MatakuliahController::class, 'show']);

Route::get('/about', fn() => view('halaman-about'));
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/pegawai', [PegawaiController::class, 'index']);

Route::post('question/store', [QuestionController::class, 'store'])
    ->name('question.store');

Route::get('/auth', [AuthController::class, 'index'])->name('auth.auth');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');



