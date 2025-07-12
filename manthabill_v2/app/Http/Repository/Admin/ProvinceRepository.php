<?php
/*
 * Copyright (c) 2024.
 * Develop By: Alexsander Hendra Wijaya
 * Github: https://github.com/alexistdev
 * Phone : 0823-7140-8678
 * Email : Alexistdev@gmail.com
 */

namespace App\Http\Repository\Admin;

use App\Http\Requests\Admin\ProvinceRequest;
use App\Interfaces\ProvinceInterface;
use App\Models\Province;

class ProvinceRepository implements ProvinceInterface
{

    public function getAllProvincies($request)
    {
        $provincies = Province::with('country')->orderBy('name','desc')->get();
        return datatables()->of($provincies)
            ->editColumn('country', function ($request) {
                return $request->country->name ?? '';
            })
            ->editColumn('created_at', function ($request) {
                return $request->created_at->format('d-m-Y H:i:s');
            })
            ->addColumn('action', function ($row) {
                $id = $row->id;
                $btn = "<button class=\"btn btn-sm btn-primary open-edit\" data-name =\"$row->name\" data-id=\"$id\"data-bs-toggle=\"modal\" data-bs-target=\"#modalEdit\"><i class=\"fas fa-edit\"></i> Edit</button>";
                $btn = $btn . " <a href=\"#\" class=\"btn btn-sm btn-danger ml-auto open-hapus\" data-id=\"$id\" data-bs-toggle=\"modal\" data-bs-target=\"#modalHapus\"><i class=\"fas fa-trash\"></i> Delete</i></a>";
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function saveProvince(ProvinceRequest $request): void
    {
        $province = new Province();
        $province->country_id = $request->country_id;
        $province->name = $request->name;
        $province->save();
    }


}
