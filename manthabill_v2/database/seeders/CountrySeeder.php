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

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $result = [];
        $temp1 = ["Indonesia"];
        $date = Carbon::now()->format('Y-m-d H:i:s');
        for ($i = 0; $i < count($temp1); $i++) {
            $temp2 = ['name' => $temp1[$i],'created_at' => $date,'updated_at' => $date];
            array_push($result, $temp2);
        }
    }
}
