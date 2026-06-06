<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\ActivationMail;
use App\Models\Setting;
use App\Models\User;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __construct(private readonly CustomerService $customerService) {}

    public function index()
    {
        if (session('is_login_in')) {
            return redirect()->route('member.index');
        }

        $setting = Setting::current();
        $word    = strtolower(Str::random(6));
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

        Mail::to($request->email)->queue(new ActivationMail(
            namaHosting: $namaHosting,
            email: $request->email,
            password: $request->password,
            activationUrl: url('/Daftar/validasi/' . $token),
        ));

        session()->flash('pesan2', '<div class="alert alert-success" role="alert">Akun Anda berhasil dibuat!</div>');

        return redirect()->route('login');
    }

    public function checkEmail(Request $request)
    {
        if ($request->method() !== 'POST') {
            return redirect()->route('register');
        }

        $exists = User::where('email', $request->input('email'))->exists();

        return $exists ? response('ok') : response('');
    }

    public function getCsrf(Request $request)
    {
        if (! $request->ajax()) {
            return redirect()->route('login');
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
            return redirect()->route('login');
        }

        $user->update([
            'status'         => User::STATUS_ACTIVE,
            'validasi_token' => null,
        ]);

        session()->flash('pesan2', '<div class="alert alert-success" role="alert">Akun Anda berhasil diaktifkan, silahkan login!</div>');

        return redirect()->route('login');
    }
}
