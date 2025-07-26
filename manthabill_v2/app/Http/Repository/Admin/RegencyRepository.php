<?php
/*
 * Copyright (c) 2024.
 * Develop By: Alexsander Hendra Wijaya
 * Github: https://github.com/alexistdev
 * Phone : 0823-7140-8678
 * Email : Alexistdev@gmail.com
 */

namespace App\Http\Repository\Admin;

use App\Http\Requests\Admin\RegencyRequest;
use App\Interfaces\RegencyInterface;
use App\Models\Regency;

class RegencyRepository implements RegencyInterface
{
    public function getAllRegencies($request)
    {
        $regencies = Regency::with('province')->orderBy('name','desc')->get();
        return datatables()->of($regencies)
            ->editColumn('province', function ($request) {
                return $request->province->name ?? '';
            })
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $id = $row->id;
                $provinceId = $row->province?->id;
                $btn = "<button class=\"btn btn-sm btn-primary open-edit\" data-name =\"$row->name\" data-id=\"$id\" data-province =\"$provinceId\" data-bs-toggle=\"modal\" data-bs-target=\"#modalEdit\"><i class=\"fas fa-edit\"></i> Edit</button>";
                $btn = $btn . " <a href=\"#\" class=\"btn btn-sm btn-danger ml-auto open-hapus\" data-id=\"$id\" data-bs-toggle=\"modal\" data-bs-target=\"#modalHapus\"><i class=\"fas fa-trash\"></i> Delete</i></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function saveRegencies(RegencyRequest $request): void
    {
        $regency = new Regency();
        $regency->province_id = $request->province_id;
        $regency->name = $request->name;
        $regency->save();
    }

    public function update(RegencyRequest $request): void
    {
       $regency = Regency::findOrFail($request->regency_id);
       $regency->update([
           'province_id' => $request->province_id,
           'name' => $request->name
       ]);
    }

    public function delete(RegencyRequest $request): string
    {
        $regency = Regency::findOrFail($request->regency_id);
        Regency::where('id',$regency->id)->delete();
        return $regency->name ?? '';
    }


}
