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

class DashboardController extends Controller
{

    protected User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {

        return view('admin.upcube.dashboard', array(
            'title' => "Dashboard Administrator | ". config('app.name')." v.".config('app.version'),
            'firstMenu' => 'dashboard',
            'secondMenu' => 'dashboard',
        ));
    }
}
