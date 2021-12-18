<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        $role = Auth::user();
        /** Simpan log */
        AppHelper::logData("Login ke dalam akun",$role->id);

        /** Cek Auth Role */
        if($role->role_id == 1){
            return redirect()->intended(RouteServiceProvider::SUPERADMIN);
        } elseif($role->role_id  == 2) {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        } elseif($role->role_id  == 3) {
            return redirect()->intended(RouteServiceProvider::STORE);
        } else {
            return redirect()->intended(RouteServiceProvider::USER);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
