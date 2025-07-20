<?php

namespace App\Interfaces;

use App\Http\Requests\Admin\ProvinceRequest;

interface ProvinceInterface
{
    public function getAllProvincies($request);

    public function saveProvince(ProvinceRequest $request):void;

    public function update(ProvinceRequest $request):void;

    public function delete(ProvinceRequest $request):string;
}
