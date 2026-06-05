<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\NewPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function index()
    {
        $setting = Setting::current();
        $word    = strtolower(Str::random(5));
        session(['captchaword' => $word]);

        return view('auth.reset-password', [
            'title'       => 'Reset Password | ' . ($setting?->judul_hosting ?? 'ManthaBill'),
            'captchaWord' => $word,
        ]);
    }

    public function store(ResetPasswordRequest $request)
    {
        $email  = $request->email;
        $keyReq = sha1((string) now()->timestamp);

        User::where('email', $email)->update([
            'time_req'  => now()->timestamp,
            'token_req' => $keyReq,
        ]);

        $setting = Setting::current();

        $judul = 'Permintaan Reset Password';
        $pesan = "
            Anda telah meminta reset password untuk akun anda, silahkan klik link dibawah ini:<br>
            Reset Password: " . route('password.confirm', $keyReq) . "<br>

            Jika anda tidak merasa melakukan permintaan reset password, abaikan saja email ini. Email ini akan expired setelah 24 jam.<br>
            <br>
            Regards<br>
            Admin
        ";

        kirim_email($email, $pesan, $judul);

        session()->flash('pesan2', '<div class="alert alert-success" role="alert"> Permintaan Reset Password telah dikirimkan silahkan cek email anda!</div>');

        return redirect()->route('password.request');
    }

    public function confirm(string $token)
    {
        $user = User::where('token_req', $token)->first();

        if (! $user) {
            return redirect()->route('password.request');
        }

        if ($user->time_req && Carbon::createFromTimestamp($user->time_req)->addDay()->isPast()) {
            $user->update(['token_req' => '', 'time_req' => null]);
            return redirect()->route('password.request');
        }

        $setting = Setting::current();

        return view('auth.new-password', [
            'token' => $token,
            'title' => 'Ganti Password | ' . ($setting?->judul_hosting ?? 'ManthaBill'),
        ]);
    }

    public function done(NewPasswordRequest $request)
    {
        $token = $request->input('token');

        if (empty($token)) {
            return redirect()->route('login');
        }

        $user = User::where('token_req', $token)->first();

        if (! $user) {
            return redirect()->route('login');
        }

        $user->update([
            'password'  => Hash::make($request->password1),
            'token_req' => '',
            'time_req'  => null,
        ]);

        session()->flash('pesan2', '<div class="alert alert-success" role="alert">Password anda berhasil diperbaharui!</div>');

        return redirect()->route('login');
    }
}
