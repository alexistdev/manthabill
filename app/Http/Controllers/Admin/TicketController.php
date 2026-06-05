<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function inbox()
    {
        abort(501);
    }

    public function show(string $key)
    {
        abort(501);
    }

    public function reply(Request $request, string $key)
    {
        abort(501);
    }

    public function close(string $key)
    {
        abort(501);
    }
}
