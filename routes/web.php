<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test/layout', function () {
    return view('test.layout-test');
})->name('test.layout');

/*
|--------------------------------------------------------------------------
| Public Registration Routes
|--------------------------------------------------------------------------
*/
Route::get('/Daftar', [RegisterController::class, 'index'])->name('register');
Route::post('/Daftar', [RegisterController::class, 'store'])->name('register.store');
Route::post('/Daftar/checkEmail', [RegisterController::class, 'checkEmail'])->name('register.check-email');
Route::get('/Daftar/get_csrf', [RegisterController::class, 'getCsrf'])->name('register.get-csrf');
Route::get('/Daftar/validasi/{token}', [RegisterController::class, 'validasi'])->name('register.validasi');

/*
|--------------------------------------------------------------------------
| Admin Customer Routes
|--------------------------------------------------------------------------
*/
Route::prefix('staff/Admin')->name('admin.customers.')->group(function () {
    Route::get('/user', [CustomerController::class, 'index'])->name('index');
    Route::get('/tambah_user', [CustomerController::class, 'create'])->name('create');
    Route::post('/tambah_user', [CustomerController::class, 'store'])->name('store');
    Route::get('/detail_user/{encrypted}', [CustomerController::class, 'show'])->name('show');
    Route::get('/edit_user/{encrypted}', [CustomerController::class, 'edit'])->name('edit');
    Route::put('/update_user/{encrypted}', [CustomerController::class, 'update'])->name('update');
    Route::delete('/hapus_user/{encrypted}', [CustomerController::class, 'destroy'])->name('destroy');
    Route::get('/suspend_user/{encrypted}', [CustomerController::class, 'suspend'])->name('suspend');
    Route::get('/aktifkan_user/{encrypted}', [CustomerController::class, 'activate'])->name('activate');
    Route::post('/checkEmail', [CustomerController::class, 'checkEmail'])->name('check-email');
    Route::get('/get_csrf', [CustomerController::class, 'getCsrf'])->name('get-csrf');
});
