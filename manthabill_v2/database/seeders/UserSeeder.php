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

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $user = [
            array('role_id' => '1','name' => 'admin',  'email' => 'admin@gmail.com','password' => Hash::make('1234'),'created_at' => $date,'updated_at' => $date),
            array('role_id' => '2','name' => 'staff',  'email' => 'staff@gmail.com','password' => Hash::make('1234'),'created_at' => $date,'updated_at' => $date),
            array('role_id' => '3','name' => 'user',  'email' => 'user@gmail.com','password' => Hash::make('1234'),'created_at' => $date,'updated_at' => $date),
        ];
        User::insert($user);
    }
}
