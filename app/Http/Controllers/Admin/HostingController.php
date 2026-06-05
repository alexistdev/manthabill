<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HostingController extends Controller
{
    public function index()
    {
        abort(501);
    }

    public function detail(string $encrypted)
    {
        abort(501);
    }

    public function updateDetail(Request $request, string $encrypted)
    {
        abort(501);
    }

    public function activate(string $encrypted)
    {
        abort(501);
    }

    public function storeActivation(Request $request, string $encrypted)
    {
        abort(501);
    }

    public function suspend(string $encrypted)
    {
        abort(501);
    }

    public function terminate(string $encrypted)
    {
        abort(501);
    }

    public function vps()
    {
        abort(501);
    }
}
