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
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Utilities\Request;

class CountriesController extends Controller
{
    protected User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * @throws Exception
     */
    public function index(Request $request)
    {
//        return Country::all();
        if ($request->ajax()) {
            $country = Country::orderBy('name','desc')->get();
            return datatables()->of($country)
                ->make(true);
        }
        return view('admin.upcube.countries', array(
            'title' => "Master Data Countries Administrator | ". config('app.name')." v.".config('app.version'),
            'firstMenu' => 'dashboard',
            'secondMenu' => 'dashboard',
        ));
    }
}
