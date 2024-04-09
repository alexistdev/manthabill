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
use App\Interfaces\CountryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Utilities\Request;

class CountriesController extends Controller
{
    protected User $user;
    protected CountryInterface $countryRepository;

    public function __construct(CountryInterface $countryRepository)
    {
        $this->user = Auth::user();
        $this->countryRepository = $countryRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->countryRepository->getAllCountries($request);
        }
        return view('admin.upcube.countries', array(
            'title' => "Master Data Countries Administrator | ". config('app.name')." v.".config('app.version'),
            'firstMenu' => 'dashboard',
            'secondMenu' => 'dashboard',
        ));
    }
}
