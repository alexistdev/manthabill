<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hosting;
use App\Models\Vps;
use Illuminate\Http\Request;

class HostingController extends Controller
{
    public function index()
    {
        $dataService = Hosting::with(['user.detail', 'product'])
            ->orderByDesc('id')
            ->get();

        return view('admin.hosting.index', [
            'dataService' => $dataService,
            'title'       => 'Shared Hosting | Manthabill',
        ]);
    }

    public function detail(string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $hosting = $id ? Hosting::with(['user.detail', 'product', 'invoices'])->find($id) : null;

        if (! $hosting) {
            return redirect()->route('admin.hosting.index');
        }

        return view('admin.hosting.show', [
            'hosting'   => $hosting,
            'encrypted' => $encrypted,
            'title'     => 'Detail Hosting | Manthabill',
        ]);
    }

    public function updateDetail(Request $request, string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $hosting = $id ? Hosting::find($id) : null;

        if (! $hosting) {
            return redirect()->route('admin.hosting.index');
        }

        $request->validate([
            'user_cpanel' => ['nullable', 'max:50'],
        ]);

        $hosting->update(['user_cpanel' => $request->user_cpanel]);

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Data hosting telah diperbaharui!</div>');

        return redirect()->route('admin.hosting.detail', $encrypted);
    }

    public function activate(string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $hosting = $id ? Hosting::with('user')->find($id) : null;

        if (! $hosting) {
            return redirect()->route('admin.hosting.index');
        }

        if ($hosting->status_hosting === Hosting::STATUS_ACTIVE) {
            session()->flash('pesan', '<div class="alert alert-warning" role="alert">Layanan ini sudah aktif sebelumnya!</div>');

            return redirect()->route('admin.hosting.detail', $encrypted);
        }

        return view('admin.hosting.activate', [
            'hosting'   => $hosting,
            'encrypted' => $encrypted,
            'title'     => 'Aktivasi Hosting | Manthabill',
        ]);
    }

    public function storeActivation(Request $request, string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $hosting = $id ? Hosting::with('user')->find($id) : null;

        if (! $hosting) {
            return redirect()->route('admin.hosting.index');
        }

        if ($hosting->status_hosting === Hosting::STATUS_ACTIVE) {
            session()->flash('pesan', '<div class="alert alert-warning" role="alert">Layanan ini sudah aktif sebelumnya!</div>');

            return redirect()->route('admin.hosting.detail', $encrypted);
        }

        $request->validate([
            'usernameCpanel' => ['required', 'min:6', 'max:30'],
            'passwordCpanel' => ['required', 'min:6', 'max:80'],
        ], [
            'usernameCpanel.required' => 'Username Cpanel harus diisi!',
            'usernameCpanel.min'      => 'Panjang karakter Username Cpanel minimal 6 karakter!',
            'usernameCpanel.max'      => 'Panjang karakter Username Cpanel maksimal 30 karakter!',
            'passwordCpanel.required' => 'Password Cpanel harus diisi!',
            'passwordCpanel.min'      => 'Panjang karakter Password Cpanel minimal 6 karakter!',
            'passwordCpanel.max'      => 'Panjang karakter Password Cpanel maksimal 80 karakter!',
        ]);

        $hosting->update([
            'status_hosting' => Hosting::STATUS_ACTIVE,
            'user_cpanel'    => $request->usernameCpanel,
        ]);

        $emailTujuan = $hosting->user?->email ?? '';
        if ($emailTujuan) {
            $judulEmail = "Layanan Hosting {$hosting->nama_hosting} telah diaktifkan!";
            $pesanEmail = "
                Selamat layanan anda {$hosting->nama_hosting} telah berhasil diaktifkan<br>
                Dan berikut detail informasi cpanel nya:<br><br>
                Username: {$request->usernameCpanel} <br>
                Password: {$request->passwordCpanel} <br><br>
                Anda bisa login di http://{$hosting->domain}/cpanel<br><br>
                Jika anda membutuhkan bantuan kami, maka anda bisa membuka support tiket di halaman dashboard akun anda!<br>
                Team kami akan membalas 1x24 jam Support tiket anda.<br><br>
                Regards<br>
                Admin
            ";
            kirim_email($emailTujuan, $pesanEmail, $judulEmail);
        }

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Layanan ini telah diaktifkan</div>');

        return redirect()->route('admin.hosting.detail', $encrypted);
    }

    public function suspend(string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $hosting = $id ? Hosting::with('user')->find($id) : null;

        if (! $hosting) {
            return redirect()->route('admin.hosting.index');
        }

        if ($hosting->status_hosting === Hosting::STATUS_SUSPENDED || $hosting->status_hosting === Hosting::STATUS_TERMINATED) {
            session()->flash('pesan', '<div class="alert alert-warning" role="alert">Layanan ini sudah tidak aktif sebelumnya!</div>');

            return redirect()->route('admin.hosting.detail', $encrypted);
        }

        $hosting->update(['status_hosting' => Hosting::STATUS_SUSPENDED]);

        $emailTujuan = $hosting->user?->email ?? '';
        if ($emailTujuan) {
            $judulEmail = "Layanan Hosting {$hosting->nama_hosting} telah dinonaktifkan!";
            $pesanEmail = "
                Mohon maaf, layanan anda {$hosting->nama_hosting} telah dinonaktifkan<br>
                Dikarenakan telah habis masa aktifnya atau telah melanggar ketentuan layanan kami<br><br>
                Jika anda membutuhkan informasi lebih lanjut, silahkan hubungi costumer service kami.<br><br>
                Regards<br>
                Admin
            ";
            kirim_email($emailTujuan, $pesanEmail, $judulEmail);
        }

        session()->flash('pesan', '<div class="alert alert-danger" role="alert">Layanan ini telah dinonaktifkan!</div>');

        return redirect()->route('admin.hosting.detail', $encrypted);
    }

    public function terminate(string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $hosting = $id ? Hosting::find($id) : null;

        if (! $hosting) {
            return redirect()->route('admin.hosting.index');
        }

        if ($hosting->status_hosting === Hosting::STATUS_TERMINATED) {
            session()->flash('pesan', '<div class="alert alert-danger" role="alert">Layanan ini sudah dinonaktifkan sebelumnya!</div>');

            return redirect()->route('admin.hosting.detail', $encrypted);
        }

        $hosting->update(['status_hosting' => Hosting::STATUS_TERMINATED]);

        session()->flash('pesan', '<div class="alert alert-danger" role="alert">Layanan ini telah diakhiri!</div>');

        return redirect()->route('admin.hosting.detail', $encrypted);
    }

    public function vps()
    {
        $dataVps = Vps::all();

        return view('admin.hosting.vps', [
            'dataVps' => $dataVps,
            'title'   => 'VPS Hosting | Manthabill',
        ]);
    }

    private function decryptId(string $encrypted): ?string
    {
        try {
            return decrypt($encrypted);
        } catch (\Throwable) {
            return null;
        }
    }
}
