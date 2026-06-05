<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        abort(501);
    }

    public function beli(string $encrypted)
    {
        abort(501);
    }

    public function invoice(Request $request, string $encrypted)
    {
        abort(501);
    }
}
