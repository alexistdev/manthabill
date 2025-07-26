<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegencyRequest;
use App\Interfaces\RegencyInterface;
use App\Models\Province;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegencyController extends Controller
{
    protected User $user;

    protected RegencyInterface $regencyRepository;

    public function __construct(RegencyInterface $regencyRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });

        $this->user = Auth::user();
        $this->regencyRepository = $regencyRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->regencyRepository->getAllRegencies($request);
        }

        return view('admin.upcube.regencies', array(
            'title' => "Master Data Regency Administrator | ". config('app.name')." v.".config('app.version'),
            'firstMenu' => 'dashboard',
            'secondMenu' => 'dashboard',
            'optionProvince' => Province::orderBy('name','ASC')->get(),
        ));
    }

    public function store(RegencyRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->regencyRepository->saveRegencies($request);
            DB::commit();
            return redirect(route('adm.regencies'))->with(['success' => "Data Kabupaten berhasil ditambahkan!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.regencies'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(RegencyRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $this->regencyRepository->update($request);
            DB::commit();
            return redirect(route('adm.regencies'))->with(['warning' => "Data Kabupaten berhasil diperbaharui!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.regencies'))->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(RegencyRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $province = strtoupper($this->regencyRepository->delete($request) ?? "");
            DB::commit();
            return redirect(route('adm.regencies'))->with(['delete' => "Data Kabupaten <b>$province</b> berhasil dihapus!"]);
        } catch (Exception $e) {
            DB::rollback();
            return redirect(route('adm.regencies'))->withErrors(['error' => $e->getMessage()]);
        }
    }
}
