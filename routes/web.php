<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as DashAdmin;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['web','auth','roles']],function() {
    Route::group(['roles' => 'admin'], function () {
        Route::get('/admin/dashboard', [DashAdmin::class,'index'])->name('admin.dashboard');
    });
});


require __DIR__.'/auth.php';
