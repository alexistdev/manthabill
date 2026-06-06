<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateInvoiceRequest;
use App\Models\Hosting;
use App\Models\Invoice;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index()
    {
        $daftarInvoice = Invoice::with(['user.detail', 'hosting'])
            ->orderByDesc('id')
            ->get();

        return view('admin.invoices.index', [
            'daftarInvoice' => $daftarInvoice,
            'title'         => 'Invoice | Manthabill',
        ]);
    }

    public function show(string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $invoice = $id ? Invoice::with(['user.detail', 'hosting', 'confirmation'])->find($id) : null;

        if (! $invoice) {
            return redirect()->route('admin.invoices.index');
        }

        $setting = Setting::current();

        return view('admin.invoices.show', [
            'invoice'   => $invoice,
            'setting'   => $setting,
            'encrypted' => $encrypted,
            'title'     => 'Detail Invoice | Manthabill',
        ]);
    }

    public function create(string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $hosting = $id ? Hosting::with('user.detail')->find($id) : null;

        if (! $hosting) {
            return redirect()->route('admin.invoices.index');
        }

        return view('admin.invoices.create', [
            'hosting'   => $hosting,
            'encrypted' => $encrypted,
            'title'     => 'Buat Invoice | Manthabill',
        ]);
    }

    public function store(CreateInvoiceRequest $request, string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $hosting = $id ? Hosting::with('user')->find($id) : null;

        if (! $hosting) {
            return redirect()->route('admin.invoices.index');
        }

        $noInvoice   = strtolower(Str::random(5));
        $startDate   = now()->toDateString();
        $dueInv      = now()->addDays(3)->toDateString();
        $hargaProduk = (int) $request->hargaHosting;
        $diskonPct   = (float) $request->diskon;
        $diskonInv   = ($diskonPct / 100) * $hargaProduk;
        $hargaTotal  = $hargaProduk - $diskonInv;

        Invoice::create([
            'user_id'       => $hosting->user_id,
            'id_hosting'    => $hosting->id,
            'no_invoice'    => $noInvoice,
            'detail_produk' => $request->deskripsi,
            'due'           => $dueInv,
            'inv_date'      => $startDate,
            'sub_total'     => $hargaProduk,
            'diskon_inv'    => $diskonInv,
            'pajak_inv'     => 0,
            'total_jumlah'  => $hargaTotal,
            'status_inv'    => Invoice::STATUS_PAID,
        ]);

        $emailTujuan = $hosting->user?->email ?? '';
        if ($emailTujuan) {
            $judul   = 'Konfirmasi Pembayaran';
            $message = "
                Yth.Pelanggan , kami telah menerima konfirmasi pembayaran anda:<br><br>
                {$request->deskripsi}<br>
                =====================================================================<br>
                Nomor Invoice: " . strtoupper($noInvoice) . " <br>
                Harga: Rp." . konversiRupiah((int) $hargaTotal) . " <br>
                Tanggal Invoice: " . konversiTanggal($startDate) . "<br><br>
                Jika anda membutuhkan bantuan lebih lanjut, silahkan membuka support tiket melalui halaman dashboard akun anda.
                <br><br>
                Regards<br>
                Admin<br>
            ";
            kirim_email($emailTujuan, $message, $judul);
        }

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Invoice telah berhasil dibuat!</div>');

        return redirect()->route('admin.invoices.index');
    }

    public function pay(string $encrypted)
    {
        $id      = $this->decryptId($encrypted);
        $invoice = $id ? Invoice::with(['user', 'hosting'])->find($id) : null;

        if (! $invoice) {
            return redirect()->route('admin.invoices.index');
        }

        $invoice->update(['status_inv' => Invoice::STATUS_PAID]);

        $emailTujuan = $invoice->user?->email ?? '';
        if ($emailTujuan) {
            $hosting = $invoice->hosting;
            $judul   = 'Konfirmasi Pembayaran';
            $message = "
                Yth.Pelanggan , kami telah menerima konfirmasi pembayaran anda:<br><br>
                {$invoice->detail_produk}<br>
                =====================================================================<br>
                Nomor Invoice: " . strtoupper($invoice->no_invoice) . " <br>
                Harga: Rp." . konversiRupiah((int) $invoice->total_jumlah) . " <br>
                Register: " . konversiTanggal($hosting?->start_hosting?->format('Y-m-d') ?? '') . "<br>
                Expired: " . konversiTanggal($hosting?->end_hosting?->format('Y-m-d') ?? '') . "<br>
                Jika anda membutuhkan bantuan lebih lanjut, silahkan membuka support tiket melalui halaman dashboard akun anda.
                <br><br>
                Regards<br>
                Admin<br>
            ";
            kirim_email($emailTujuan, $message, $judul);
        }

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Invoice telah berhasil dikonfirmasi!</div>');

        return redirect()->route('admin.invoices.index');
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
