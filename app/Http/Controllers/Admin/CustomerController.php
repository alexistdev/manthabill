<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCustomerRequest;
use App\Http\Requests\Admin\UpdateCustomerRequest;
use App\Models\Inbox;
use App\Models\Setting;
use App\Models\User;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function __construct(private readonly CustomerService $customerService) {}

    public function index()
    {
        $dataUser = User::with('detail')->orderBy('id_user', 'desc')->get();
        $setting  = Setting::current();

        return view('admin.customers.index', [
            'dataUser'  => $dataUser,
            'namaUsaha' => $setting?->nama_hosting ?? 'ManthaBill',
            'title'     => 'Data User | Manthabill',
        ]);
    }

    public function create()
    {
        $setting = Setting::current();

        return view('admin.customers.create', [
            'namaUsaha' => $setting?->nama_hosting ?? 'ManthaBill',
            'title'     => 'Tambah User | Manthabill',
        ]);
    }

    public function store(StoreCustomerRequest $request)
    {
        $user = $this->customerService->createCustomer([
            'email'    => $request->email,
            'password' => $request->password,
            'status'   => User::STATUS_ACTIVE,
        ]);

        if ($request->boolean('kirimEmail')) {
            $setting    = Setting::current();
            $namaHosting = $setting?->nama_hosting ?? 'ManthaBill';
            $judul   = "Anda berhasil mendaftar akun di {$namaHosting}";
            $message = "
                Selamat anda telah berhasil mendaftar akun di {$namaHosting} , berikut informasi akun anda:<br><br>
                Username: {$request->email} <br>
                Password: {$request->password} <br><br>
                Anda bisa login di " . url('/') . "<br><br>
                Regards<br>
                Admin
            ";
            kirim_email($request->email, $message, $judul);
        }

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Data user berhasil ditambahkan!</div>');

        return redirect()->route('admin.customers.index');
    }

    public function show(string $encrypted)
    {
        $id   = $this->decryptId($encrypted);
        $user = $id ? User::with(['detail', 'hostings.product', 'invoices'])->find($id) : null;

        if (! $user) {
            return redirect()->route('admin.customers.index');
        }

        $setting = Setting::current();

        return view('admin.customers.show', [
            'user'      => $user,
            'namaUsaha' => $setting?->nama_hosting ?? 'ManthaBill',
            'title'     => 'Detail User | Manthabill',
        ]);
    }

    public function edit(string $encrypted)
    {
        $id   = $this->decryptId($encrypted);
        $user = $id ? User::with('detail')->find($id) : null;

        if (! $user) {
            return redirect()->route('admin.customers.index');
        }

        $setting = Setting::current();

        return view('admin.customers.edit', [
            'user'      => $user,
            'namaUsaha' => $setting?->nama_hosting ?? 'ManthaBill',
            'title'     => 'Edit User | Manthabill',
        ]);
    }

    public function update(UpdateCustomerRequest $request, string $encrypted)
    {
        $id   = $this->decryptId($encrypted);
        $user = $id ? User::with('detail')->find($id) : null;

        if (! $user) {
            return redirect()->route('admin.customers.index');
        }

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->detail()->updateOrCreate(
            ['id_user' => $user->id_user],
            [
                'nama_depan'   => $request->namaDepan,
                'nama_belakang' => $request->namaBelakang,
                'nama_usaha'   => $request->namaUsaha,
                'alamat'       => $request->alamat1,
                'alamat2'      => $request->alamat2,
                'kota'         => $request->kota,
                'provinsi'     => $request->provinsi,
                'negara'       => $request->negara,
                'kodepos'      => $request->kodepos,
                'phone'        => $request->telepon,
            ]
        );

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Data user telah diperbaharui!</div>');

        return redirect()->route('admin.customers.edit', $encrypted);
    }

    public function destroy(string $encrypted)
    {
        $id   = $this->decryptId($encrypted);
        $user = $id ? User::find($id) : null;

        if (! $user) {
            return redirect()->route('admin.customers.index');
        }

        $email = $user->email;
        $user->delete();

        session()->flash('pesan', '<div class="alert alert-danger" role="alert">Data <span class="font-weight-bold">' . strtoupper($email) . '</span> telah dihapus!</div>');

        return redirect()->route('admin.customers.index');
    }

    public function suspend(string $encrypted)
    {
        $id   = $this->decryptId($encrypted);
        $user = $id ? User::find($id) : null;

        if (! $user) {
            return redirect()->route('admin.customers.index');
        }

        if ($user->isSuspended()) {
            session()->flash('pesan', '<div class="alert alert-warning" role="alert">Klien #<span class="font-weight-bold">' . strtoupper($user->client) . '</span> sudah pernah disuspend!</div>');
        } else {
            $this->customerService->suspend($user);
            session()->flash('pesan', '<div class="alert alert-danger" role="alert">Klien #<span class="font-weight-bold">' . strtoupper($user->client) . '</span> telah disuspend!</div>');
        }

        return redirect()->route('admin.customers.show', $encrypted);
    }

    public function activate(string $encrypted)
    {
        $id   = $this->decryptId($encrypted);
        $user = $id ? User::find($id) : null;

        if (! $user) {
            return redirect()->route('admin.customers.index');
        }

        if ($user->isActive()) {
            session()->flash('pesan', '<div class="alert alert-warning" role="alert">Klien #<span class="font-weight-bold">' . strtoupper($user->client) . '</span> sudah aktif sebelumnya!</div>');
        } else {
            $this->customerService->activate($user);
            session()->flash('pesan', '<div class="alert alert-success" role="alert">Klien #<span class="font-weight-bold">' . strtoupper($user->client) . '</span> kembali diaktifkan!</div>');
        }

        return redirect()->route('admin.customers.show', $encrypted);
    }

    private function decryptId(string $encrypted): ?string
    {
        try {
            return decrypt($encrypted);
        } catch (\Throwable) {
            return null;
        }
    }

    public function message(string $encrypted)
    {
        $id   = $this->decryptId($encrypted);
        $user = $id ? User::with('detail')->find($id) : null;

        if (! $user) {
            return redirect()->route('admin.customers.index');
        }

        $setting = Setting::current();

        return view('admin.customers.message', [
            'user'      => $user,
            'namaUsaha' => $setting?->nama_hosting ?? 'ManthaBill',
            'title'     => 'Kirim Pesan | Manthabill',
        ]);
    }

    public function sendMessage(Request $request, string $encrypted)
    {
        $id   = $this->decryptId($encrypted);
        $user = $id ? User::find($id) : null;

        if (! $user) {
            return redirect()->route('admin.customers.index');
        }

        $request->validate([
            'judulPesan' => ['required', 'min:5', 'max:80'],
            'isiPesan'   => ['required', 'min:10', 'max:400'],
        ], [
            'judulPesan.required' => 'Judul pesan harus diisi !',
            'judulPesan.min'      => 'Panjang karakter Judul Pesan minimal 5 karakter!',
            'judulPesan.max'      => 'Panjang karakter Judul Pesan maksimal 80 karakter!',
            'isiPesan.required'   => 'Isi Pesan harus diisi !',
            'isiPesan.min'        => 'Panjang karakter Isi Pesan minimal 10 karakter!',
            'isiPesan.max'        => 'Panjang karakter Isi Pesan maksimal 400 karakter!',
        ]);

        Inbox::create([
            'user_id'      => $user->id_user,
            'is_adm'       => Inbox::AUTHOR_ADMIN,
            'judul'        => $request->judulPesan,
            'pesan'        => $request->isiPesan,
            'key_token'    => Str::random(20),
            'time'         => time(),
            'status_inbox' => Inbox::STATUS_OPEN,
        ]);

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Pesan telah dikirimkan ke user!</div>');

        return redirect()->route('admin.customers.show', $encrypted);
    }

    public function checkEmail(Request $request)
    {
        if (! $request->ajax()) {
            return redirect()->route('admin.customers.index');
        }

        $exists = User::where('email', $request->input('email'))->exists();

        return $exists ? response('ok') : response('');
    }

    public function getCsrf(Request $request)
    {
        if (! $request->ajax()) {
            return redirect()->route('admin.customers.index');
        }

        return response()->json([
            'csrf_name'  => '_token',
            'csrf_token' => csrf_token(),
        ]);
    }
}
