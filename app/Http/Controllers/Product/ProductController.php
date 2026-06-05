<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Hosting;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Tld;
use App\Services\DomainService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $personal     = Product::where('type_product', Product::TYPE_PERSONAL)->get();
        $professional = Product::where('type_product', Product::TYPE_PROFESSIONAL)->get();

        return view('product.index', compact('personal', 'professional'));
    }

    public function beli(string $encrypted): View|RedirectResponse
    {
        try {
            $id = decrypt($encrypted);
        } catch (\Exception) {
            abort(404);
        }

        $product = Product::find($id);
        if (! $product) {
            return redirect()->route('product.index');
        }

        $pendingCount = Invoice::where('user_id', Auth::id())
            ->whereIn('status_inv', [Invoice::STATUS_PENDING, Invoice::STATUS_CONFIRMED])
            ->count();

        if ($pendingCount > 0) {
            session()->flash('pesan', '<div class="alert alert-danger" role="alert">Silahkan anda selesaikan pembayaran invoice berikut!</div>');
            return redirect()->route('invoice.index');
        }

        $tldList    = Tld::where('status_tld', 1)->get();
        $diskonUnik = rand(100, 999);

        return view('product.show', compact('product', 'tldList', 'diskonUnik'));
    }

    public function invoice(Request $request, string $encrypted): RedirectResponse
    {
        try {
            $id = decrypt($encrypted);
        } catch (\Exception) {
            abort(404);
        }

        $product = Product::find($id);
        if (! $product) {
            return redirect()->route('product.index');
        }

        $request->validate([
            'domain'      => ['required', 'string'],
            'tld_name'    => ['required', 'string'],
            'pilihan'     => ['required', 'integer', 'min:1'],
            'diskon_unik' => ['required', 'integer', 'min:100', 'max:999'],
        ]);

        $paket      = $request->integer('pilihan');
        $diskonUnik = $request->integer('diskon_unik');
        $domainJadi  = DomainService::filter($request->input('domain'), $request->input('tld_name'));
        $namaProduct = $product->nama_product . ' ' . $domainJadi;

        $detailProduk = $product->type_product > Product::TYPE_PERSONAL
            ? $namaProduct . '  -  ' . $paket . ' tahun'
            : $namaProduct . '  -  ' . $paket . ' bulan';

        $months  = $product->type_product > Product::TYPE_PERSONAL ? $paket * 12 : $paket;
        $harga   = (float) $product->harga * $paket;
        $total   = $harga - $diskonUnik;
        $today   = now()->toDateString();
        $endDate = now()->addMonths($months)->toDateString();
        $due     = now()->addDays(3)->toDateString();
        $noInvoice = strtolower(Str::random(5));

        $invoice = DB::transaction(function () use ($product, $harga, $total, $diskonUnik, $domainJadi, $namaProduct, $detailProduk, $today, $endDate, $due, $noInvoice) {
            $hosting = Hosting::create([
                'id_product'     => $product->id,
                'user_id'        => Auth::id(),
                'nama_hosting'   => $namaProduct,
                'user_cpanel'    => '',
                'harga'          => $harga,
                'start_hosting'  => $today,
                'end_hosting'    => $endDate,
                'domain'         => $domainJadi,
                'status_hosting' => Hosting::STATUS_PENDING,
            ]);

            return Invoice::create([
                'user_id'       => Auth::id(),
                'id_hosting'    => $hosting->id,
                'no_invoice'    => $noInvoice,
                'detail_produk' => $detailProduk,
                'due'           => $due,
                'inv_date'      => $today,
                'sub_total'     => $harga,
                'diskon_inv'    => $diskonUnik,
                'pajak_inv'     => 0,
                'total_jumlah'  => $total,
                'status_inv'    => Invoice::STATUS_PENDING,
                'token_inv'     => '',
            ]);
        });

        return redirect()->route('invoice.bayar', encrypt($invoice->id));
    }
}
