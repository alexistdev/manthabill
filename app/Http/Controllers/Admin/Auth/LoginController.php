<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login', [
            'title' => 'Login Administrator | Manthabill',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'username' => ['required', 'max:10'],
                'password' => ['required'],
            ],
            [
                'username.required' => 'Username tidak boleh kosong!',
                'username.max'      => 'Panjang karakter username maksimal 10 karakter!',
                'password.required' => 'Password tidak boleh kosong!',
            ]
        );

        if (! Auth::guard('admin')->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {
            session()->flash('pesan2', '<div class="alert alert-danger" role="alert">Username atau password anda salah!</div>');

            return redirect()->route('admin.login');
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }
}
