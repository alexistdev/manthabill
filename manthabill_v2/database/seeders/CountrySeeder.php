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

namespace Database\Seeders;


use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $temp1 = ["Indonesia"];
        for ($i = 0; $i < count($temp1); $i++) {
            $country = new Country();
            $country->name = $temp1[$i];
            $country->save();
        }
    }
}
