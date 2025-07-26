<?php
/*
 * Copyright (c) 2024.
 * Develop By: Alexsander Hendra Wijaya
 * Github: https://github.com/alexistdev
 * Phone : 0823-7140-8678
 * Email : Alexistdev@gmail.com
 */

namespace App\Interfaces;

use App\Http\Requests\Admin\RegencyRequest;

interface RegencyInterface
{
    public function getAllRegencies($request);

    public function saveRegencies(RegencyRequest $request):void;

    public function update(RegencyRequest $request):void;

    public function delete(RegencyRequest $request):string;

}
