<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        $setting = Setting::current();
        $word    = strtolower(Str::random(5));
        session(['captchaword' => $word]);

        return view('auth.login', [
            'namaHosting' => $setting?->nama_hosting ?? 'ManthaBill',
            'title'       => 'Login | ' . ($setting?->judul_hosting ?? 'ManthaBill'),
            'captchaWord' => $word,
        ]);
    }

    public function store(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! Hash::check($request->password, $user->password)) {
            session()->flash('pesan2', '<div class="alert alert-danger" role="alert">Username atau password anda salah!</div>');
            return redirect()->route('login');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('member.index');
    }
}
