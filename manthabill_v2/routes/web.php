<?php
/*
 *
 *  * Copyright (c) 2024.
 *  * Develop By: Alexsander Hendra Wijaya
 *  * Github: https://github.com/alexistdev
 *  * Phone : 0823-7140-8678
 *  * Email : Alexistdev@gmail.com
 *
 */

use App\Http\Controllers\Admin\{ClientController as AdminClient,
    CountriesController as AdminCountry,
    DashboardController as AdminDash,
    ProvinceController as AdminProvince};
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staff\DashboardController as StaffDash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDash::class, 'index'])->name('adm.dashboard');
    Route::get('/admin/countries', [AdminCountry::class, 'index'])->name('adm.countries');
    Route::post('/admin/countries', [AdminCountry::class, 'store'])->name('adm.countries.save');
    Route::put('/admin/countries', [AdminCountry::class, 'update'])->name('adm.countries.update');
    Route::delete('/admin/countries', [AdminCountry::class, 'destroy'])->name('adm.countries.delete');

    Route::get('/admin/provincies', [AdminProvince::class, 'index'])->name('adm.provincies');
    Route::post('/admin/provincies', [AdminProvince::class, 'store'])->name('adm.provincies.save');
    Route::get('/admin/clients', [AdminClient::class, 'index'])->name('adm.clients');
});

Route::middleware(['role:staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffDash::class, 'index'])->name('staff.dashboard');
});


require __DIR__.'/auth.php';
