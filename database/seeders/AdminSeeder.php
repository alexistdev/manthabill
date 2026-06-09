<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Admin::firstOrCreate(
            ['username' => 'admin'],
            [
                'password' => bcrypt('1234'),
                'level'    => 1,
                'status'   => 1,
            ]
        );
    }
}
