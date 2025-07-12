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
use App\Http\Requests\Admin\CountryRequest;
use App\Interfaces\CountryInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Utilities\Request;

class CountriesController extends Controller
{
    protected User $user;
    protected CountryInterface $countryRepository;

    public function __construct(CountryInterface $countryRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });

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

    public function store(CountryRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->countryRepository->save($request);
            DB::commit();
            return redirect(route('adm.countries'))->with(['success' => "Data Country berhasil ditambahkan!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.countries'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(CountryRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->countryRepository->update($request);
            DB::commit();
            return redirect(route('adm.countries'))->with(['warning' => "Data Country berhasil diperbaharui!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.countries'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(CountryRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->countryRepository->delete($request);
            DB::commit();
            return redirect(route('adm.countries'))->with(['delete' => "Data Country berhasil dihapus!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.countries'))->withErrors(['error' => $e->getMessage()]);
        }
    }
}
