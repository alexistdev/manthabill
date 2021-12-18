<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Manthabill v.2.0
     * Date: 18-12-2021
     * Author:AlexisDev
     * Email: alexistdev@gmail.com
     * Phone: 0813-7982-3241
     */
    public function index(Request $request)
    {
        return view('admin.dashboard',array(
            'judul' => "Dashboard Administrator | SIBEL V.2.0",
            'aktifTag' => "admin",
            'tagSubMenu' => "admin",
//            'userName' => $this->users,
//            'roleUser' => $this->role->name,
        ));
    }
}
