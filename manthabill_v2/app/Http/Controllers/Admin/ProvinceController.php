<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProvinceRequest;
use App\Interfaces\ProvinceInterface;
use App\Models\Country;
use App\Models\Province;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Utilities\Request;
use Illuminate\Support\Facades\Auth;

class ProvinceController extends Controller
{
    protected User $user;

    protected ProvinceInterface $provinceRepository;

    public function __construct(ProvinceInterface $provinceRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });

        $this->user = Auth::user();
        $this->provinceRepository = $provinceRepository;
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->provinceRepository->getAllProvincies($request);
        }

        return view('admin.upcube.provincies', array(
            'title' => "Master Data Provincies Administrator | ". config('app.name')." v.".config('app.version'),
            'firstMenu' => 'dashboard',
            'secondMenu' => 'dashboard',
            'optionCountry' => Country::orderBy('name','ASC')->get(),
        ));
    }

    public function store(ProvinceRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->provinceRepository->saveProvince($request);
            DB::commit();
            return redirect(route('adm.provincies'))->with(['success' => "Data Country berhasil ditambahkan!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.provincies'))->withErrors(['error' => $e->getMessage()]);
        }
    }
}
