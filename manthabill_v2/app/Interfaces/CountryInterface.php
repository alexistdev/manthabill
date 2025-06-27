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
namespace App\Interfaces;

use App\Http\Requests\Admin\CountryRequest;

interface CountryInterface
{
    public function getAllCountries($request);

    public function save(CountryRequest $request):void;

//    public function
}


