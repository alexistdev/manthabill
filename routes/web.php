<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DomainController as AdminDomainController;
use App\Http\Controllers\Admin\HostingController as AdminHostingController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Domain\DomainController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Ticket\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Default
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => redirect()->route('login'))->name('home');

/*
|--------------------------------------------------------------------------
| Guest Routes — unauthenticated users only (web guard)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // User Login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    // User Registration
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::post('/register/checkEmail', [RegisterController::class, 'checkEmail'])->name('register.check-email');
    Route::get('/register/get_csrf', [RegisterController::class, 'getCsrf'])->name('register.get-csrf');
    Route::get('/register/validasi/{token}', [RegisterController::class, 'validasi'])->name('register.validasi');

    // Password Reset
    Route::get('/Reset_password', [ResetPasswordController::class, 'index'])->name('password.request');
    Route::post('/Reset_password', [ResetPasswordController::class, 'store'])->name('password.email');
    Route::get('/Reset_password/konfirm/{token}', [ResetPasswordController::class, 'confirm'])->name('password.confirm');
    Route::post('/Reset_password/done', [ResetPasswordController::class, 'done'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Authenticated Member Routes — require web guard (auth middleware)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Member Dashboard & Logout
    Route::get('/Member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/Member/logout', [MemberController::class, 'logout'])->name('logout');

    // Domain — TLD listing, domain purchase form, and order submission
    Route::get('/Domain', [DomainController::class, 'index'])->name('domain.index');
    Route::get('/Domain/beli', [DomainController::class, 'beli'])->name('domain.beli');
    Route::post('/Domain/beli', [DomainController::class, 'storeBeli'])->name('domain.beli.store');

    // Invoice
    Route::prefix('Invoice')->name('invoice.')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('index');
        Route::get('/detail/{encrypted}', [InvoiceController::class, 'detail'])->name('detail');
        Route::get('/bayar/{encrypted}', [InvoiceController::class, 'bayar'])->name('bayar');
        Route::get('/konfirmasi/{encrypted}', [InvoiceController::class, 'konfirmasi'])->name('konfirmasi');
        Route::post('/konfirmasi/{encrypted}', [InvoiceController::class, 'storeKonfirmasi'])->name('konfirmasi.store');
    });

    // Product Catalogue & Purchase
    Route::prefix('Product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/beli/{encrypted}', [ProductController::class, 'beli'])->name('beli');
        Route::post('/invoice/{encrypted}', [ProductController::class, 'invoice'])->name('invoice');
    });

    // Services
    Route::prefix('Service')->name('service.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/detailhosting/{encrypted}', [ServiceController::class, 'detail'])->name('detail');
    });

    // Support Tickets
    Route::prefix('Ticket')->name('ticket.')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::get('/buat_ticket', [TicketController::class, 'create'])->name('create');
        Route::post('/buat_ticket', [TicketController::class, 'store'])->name('store');
        Route::get('/lihat_ticket/{key}', [TicketController::class, 'show'])->name('show');
        Route::post('/lihat_ticket/{key}', [TicketController::class, 'reply'])->name('reply');
        Route::get('/kunci/{key}', [TicketController::class, 'close'])->name('close');
    });

    // Account Settings
    Route::prefix('Setting')->name('setting.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('/', [SettingController::class, 'update'])->name('update');
        Route::get('/ubah_password', [SettingController::class, 'changePassword'])->name('password');
        Route::post('/ubah_password', [SettingController::class, 'updatePassword'])->name('password.update');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Guest Routes — unauthenticated admin only (admin guard)
|--------------------------------------------------------------------------
*/

Route::middleware('guest:admin')->group(function () {
    Route::get('/staff/login', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('/staff/login', [AdminLoginController::class, 'store'])->name('admin.login.store');
});

/*
|--------------------------------------------------------------------------
| Authenticated Admin Routes — require admin guard (auth.admin middleware)
|--------------------------------------------------------------------------
*/

Route::middleware('auth.admin')->prefix('staff')->name('admin.')->group(function () {

    Route::prefix('Admin')->group(function () {

        // Dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [AdminDashboardController::class, 'logout'])->name('logout');
        Route::get('/checkpoint', [AdminDashboardController::class, 'checkpoint'])->name('checkpoint');
        Route::get('/help', [AdminDashboardController::class, 'help'])->name('help');

        // Customer Management (admin.customers.*)
        Route::name('customers.')->group(function () {
            Route::get('/user', [CustomerController::class, 'index'])->name('index');
            Route::get('/tambah_user', [CustomerController::class, 'create'])->name('create');
            Route::post('/tambah_user', [CustomerController::class, 'store'])->name('store');
            Route::get('/detail_user/{encrypted}', [CustomerController::class, 'show'])->name('show');
            Route::get('/edit_user/{encrypted}', [CustomerController::class, 'edit'])->name('edit');
            Route::put('/update_user/{encrypted}', [CustomerController::class, 'update'])->name('update');
            Route::delete('/hapus_user/{encrypted}', [CustomerController::class, 'destroy'])->name('destroy');
            Route::get('/suspend_user/{encrypted}', [CustomerController::class, 'suspend'])->name('suspend');
            Route::get('/aktifkan_user/{encrypted}', [CustomerController::class, 'activate'])->name('activate');
            Route::get('/kirim_pesan/{encrypted}', [CustomerController::class, 'message'])->name('message');
            Route::post('/kirim_pesan/{encrypted}', [CustomerController::class, 'sendMessage'])->name('message.store');
            Route::post('/checkEmail', [CustomerController::class, 'checkEmail'])->name('check-email');
            Route::get('/get_csrf', [CustomerController::class, 'getCsrf'])->name('get-csrf');
        });

        // Shared Hosting Management (admin.hosting.*)
        Route::name('hosting.')->group(function () {
            Route::get('/shared_hosting', [AdminHostingController::class, 'index'])->name('index');
            Route::get('/detail_shared/{encrypted}', [AdminHostingController::class, 'detail'])->name('detail');
            Route::post('/detail_shared/{encrypted}', [AdminHostingController::class, 'updateDetail'])->name('detail.update');
            Route::get('/aktif_shared/{encrypted}', [AdminHostingController::class, 'activate'])->name('activate');
            Route::post('/aktif_shared/{encrypted}', [AdminHostingController::class, 'storeActivation'])->name('activate.store');
            Route::get('/suspend_shared/{encrypted}', [AdminHostingController::class, 'suspend'])->name('suspend');
            Route::get('/terminated_shared/{encrypted}', [AdminHostingController::class, 'terminate'])->name('terminate');
            Route::get('/vpshosting', [AdminHostingController::class, 'vps'])->name('vps');
        });

        // Hosting Package Management (admin.packages.*)
        Route::name('packages.')->group(function () {
            Route::get('/paket', [AdminPackageController::class, 'index'])->name('index');
            Route::get('/tambah_shared', [AdminPackageController::class, 'create'])->name('create');
            Route::post('/tambah_shared', [AdminPackageController::class, 'store'])->name('store');
            Route::get('/edit_paket/{encrypted}', [AdminPackageController::class, 'edit'])->name('edit');
            Route::post('/update_paket/{encrypted}', [AdminPackageController::class, 'update'])->name('update');
            Route::get('/hapus_paket/{encrypted}', [AdminPackageController::class, 'destroy'])->name('destroy');
        });

        // Invoice Management (admin.invoices.*)
        Route::name('invoices.')->group(function () {
            Route::get('/invoice', [AdminInvoiceController::class, 'index'])->name('index');
            Route::get('/detail_invoice/{encrypted}', [AdminInvoiceController::class, 'show'])->name('show');
            Route::get('/tambah_invoice/{encrypted}', [AdminInvoiceController::class, 'create'])->name('create');
            Route::post('/tambah_invoice/{encrypted}', [AdminInvoiceController::class, 'store'])->name('store');
            Route::get('/bayar_invoice/{encrypted}', [AdminInvoiceController::class, 'pay'])->name('pay');
        });

        // Support Ticket Inbox (admin.tickets.*)
        Route::name('tickets.')->group(function () {
            Route::get('/inbox', [AdminTicketController::class, 'inbox'])->name('inbox');
            Route::get('/lihat_ticket/{key}', [AdminTicketController::class, 'show'])->name('show');
            Route::post('/lihat_ticket/{key}', [AdminTicketController::class, 'reply'])->name('reply');
            Route::get('/kunci/{key}', [AdminTicketController::class, 'close'])->name('close');
        });

        // Domain Management (admin.domains.*)
        Route::name('domains.')->group(function () {
            Route::get('/domain', [AdminDomainController::class, 'index'])->name('index');
            Route::get('/tambah_domain', [AdminDomainController::class, 'create'])->name('create');
            Route::post('/tambah_domain', [AdminDomainController::class, 'store'])->name('store');
            Route::get('/edit_domain/{encrypted}', [AdminDomainController::class, 'edit'])->name('edit');
            Route::post('/edit_domain/{encrypted}', [AdminDomainController::class, 'update'])->name('update');
            Route::get('/service_domain', [AdminDomainController::class, 'service'])->name('service');
            Route::get('/tambah_service_domain', [AdminDomainController::class, 'createService'])->name('service.create');
            Route::post('/tambah_service_domain', [AdminDomainController::class, 'storeService'])->name('service.store');
        });

        // System Settings (admin.settings.*)
        Route::name('settings.')->group(function () {
            Route::get('/setting_umum', [AdminSettingController::class, 'general'])->name('general');
            Route::post('/setting_umum', [AdminSettingController::class, 'updateGeneral'])->name('general.update');
            Route::get('/setting_api', [AdminSettingController::class, 'api'])->name('api');
            Route::post('/setting_api', [AdminSettingController::class, 'updateApi'])->name('api.update');
        });
    });
});
