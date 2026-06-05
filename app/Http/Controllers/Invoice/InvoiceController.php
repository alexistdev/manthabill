<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\ConfirmPaymentRequest;
use App\Models\Invoice;
use App\Models\PaymentConfirmation;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('invoice.index', compact('invoices'));
    }

    public function detail(string $encrypted)
    {
        $id = $this->decryptId($encrypted);

        if (!$id) {
            return redirect()->route('invoice.index');
        }

        $invoice = Invoice::with(['user.detail', 'confirmation'])
            ->where('user_id', Auth::id())
            ->find($id);

        if (!$invoice) {
            abort(404);
        }

        $setting = Setting::current();

        return view('invoice.show', compact('invoice', 'setting'));
    }

    public function bayar(string $encrypted)
    {
        $id = $this->decryptId($encrypted);

        if (!$id) {
            return redirect()->route('invoice.index');
        }

        $invoice = Invoice::where('user_id', Auth::id())
            ->whereIn('status_inv', [Invoice::STATUS_PENDING, Invoice::STATUS_CONFIRMED])
            ->find($id);

        if (!$invoice) {
            return redirect()->route('invoice.index');
        }

        $setting = Setting::current();

        return view('invoice.show', [
            'invoice'   => $invoice->load(['user.detail', 'confirmation']),
            'setting'   => $setting,
            'bayarMode' => true,
        ]);
    }

    public function konfirmasi(string $encrypted)
    {
        $id = $this->decryptId($encrypted);

        if (!$id) {
            return redirect()->route('invoice.index');
        }

        $invoice = Invoice::where('user_id', Auth::id())
            ->whereIn('status_inv', [Invoice::STATUS_PENDING, Invoice::STATUS_CONFIRMED])
            ->find($id);

        if (!$invoice) {
            return redirect()->route('invoice.index');
        }

        return view('invoice.confirm', compact('invoice', 'encrypted'));
    }

    public function storeKonfirmasi(ConfirmPaymentRequest $request, string $encrypted)
    {
        $id = $this->decryptId($encrypted);

        if (!$id) {
            return redirect()->route('invoice.index');
        }

        $invoice = Invoice::where('user_id', Auth::id())
            ->whereIn('status_inv', [Invoice::STATUS_PENDING, Invoice::STATUS_CONFIRMED])
            ->find($id);

        if (!$invoice) {
            return redirect()->route('invoice.index');
        }

        if ($request->hasFile('bukti')) {
            $request->file('bukti')->store('konfirmasi', 'public');
        }

        PaymentConfirmation::create([
            'invoice_id'         => $invoice->id,
            'user_id'            => Auth::id(),
            'nama_pengirim'      => $request->namaPengirim,
            'bank_pengirim'      => $request->namaBank,
            'no_invoice'         => strtolower($request->nomorInvoice),
            'tanggal_konfirmasi' => $request->tanggal,
            'total_bayar'        => $request->jmlTransfer,
            'status'             => PaymentConfirmation::STATUS_PENDING,
        ]);

        $invoice->update(['status_inv' => Invoice::STATUS_CONFIRMED]);

        session()->flash('pesan', '<div class="alert alert-success" role="alert">Konfirmasi Anda telah dikirimkan, silahkan tunggu 1x24 jam!</div>');

        return redirect()->route('invoice.index');
    }

    private function decryptId(string $encrypted): ?int
    {
        try {
            return (int) decrypt($encrypted);
        } catch (\Throwable) {
            return null;
        }
    }
}
