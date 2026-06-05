<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        abort(501);
    }

    public function detail(string $encrypted)
    {
        abort(501);
    }

    public function bayar(string $encrypted)
    {
        abort(501);
    }

    public function konfirmasi(string $encrypted)
    {
        abort(501);
    }

    public function storeKonfirmasi(Request $request, string $encrypted)
    {
        abort(501);
    }
}
