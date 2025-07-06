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

namespace App\Http\Repository\Admin;

use App\Http\Requests\Admin\CountryRequest;
use App\Interfaces\CountryInterface;
use App\Models\Country;
use Yajra\DataTables\DataTables;

class CountryRepository implements CountryInterface
{
    public function getAllCountries($request)
    {
        $country = Country::orderBy('name','desc')->get();
        return datatables()->of($country)
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

    public function save(CountryRequest $request):void
    {
        $country = new Country();
        $country->name = $request->name;
        $country->save();
    }

    public function update(CountryRequest $request): void
    {
        $country = Country::findOrFail($request->country_id);
        $country->update([
           'name' => $request->name
        ]);
    }

    public function delete(CountryRequest $request): void
    {
        $country = Country::findOrFail($request->country_id);
        Country::where('id',$country->id)->delete();
    }


}
