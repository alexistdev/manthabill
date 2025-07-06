<?php
/*
 *
 *  * Copyright (c) 2024.
 *  * Develop By: Alexsander Hendra Wijaya
 *  * Github: https://github.com/alexistdev
 *  * Phone : 0823-7140-8678
 *  * Email : Alexistdev@gmail.com
 *
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    protected User $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });

        $this->user = Auth::user();
    }

    public function index()
    {
        return view('admin.upcube.client', array(
            'title' => "Master Data Client Administrator | ". config('app.name')." v.".config('app.version'),
            'firstMenu' => 'clients',
            'secondMenu' => 'clients',
        ));
    }
}
