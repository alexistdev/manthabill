<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Setting;
use App\Models\User;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(private readonly CustomerService $customerService) {}

    public function index()
    {
        if (session('is_login_in')) {
            return redirect('/Member');
        }

        $setting = Setting::current();
        $word    = _angkaUnik(6);
        session(['captchaword' => $word]);

        return view('auth.register', [
            'namaHosting' => $setting?->nama_hosting ?? 'ManthaBill',
            'tos'         => $setting?->tos ?? '',
            'title'       => 'Daftar Akun | ' . ($setting?->judul_hosting ?? 'ManthaBill'),
            'captchaWord' => $word,
        ]);
    }

    public function store(RegisterRequest $request)
    {
        $setting     = Setting::current();
        $namaHosting = $setting?->nama_hosting ?? 'ManthaBill';
        $token       = sha1((string) time());

        $user = $this->customerService->createCustomer([
            'email'          => $request->email,
            'password'       => $request->password,
            'ip'             => $request->ip(),
            'status'         => User::STATUS_UNVERIFIED,
            'validasi_token' => $token,
        ]);

        $judul   = "Anda berhasil mendaftar akun di {$namaHosting}";
        $message = "
            Selamat anda telah berhasil mendaftar akun di {$namaHosting} , berikut informasi akun anda:<br><br>
            Username: {$request->email} <br>
            Password: {$request->password} <br><br>
            Anda harus mengklik Link Aktivasi berikut: " . url('/Daftar/validasi/' . $token) . "<br><br>
            Regards<br>
            Admin
        ";
        kirim_email($request->email, $message, $judul);

        session()->flash('pesan2', '<div class="alert alert-success" role="alert">Akun Anda berhasil dibuat!</div>');

        return redirect('/Login');
    }

    public function checkEmail(Request $request)
    {
        if ($request->method() !== 'POST') {
            return redirect('/Daftar');
        }

        $exists = User::where('email', $request->input('email'))->exists();

        return $exists ? response('ok') : response('');
    }

    public function getCsrf(Request $request)
    {
        if (! $request->ajax()) {
            return redirect('/Login');
        }

        return response()->json([
            'csrf_name'  => '_token',
            'csrf_token' => csrf_token(),
        ]);
    }

    public function validasi(string $token)
    {
        $user = User::where('validasi_token', $token)->first();

        if (! $user) {
            return redirect('/Login');
        }

        $user->update([
            'status'         => User::STATUS_ACTIVE,
            'validasi_token' => null,
        ]);

        session()->flash('pesan2', '<div class="alert alert-success" role="alert">Akun Anda berhasil diaktifkan, silahkan login!</div>');

        return redirect('/Login');
    }
}
