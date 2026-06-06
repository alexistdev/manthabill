<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'client'      => 1,
            'email'       => 'test@example.com',
            'password'    => bcrypt('password'),
            'date_create' => now()->toDateString(),
            'status'      => User::STATUS_ACTIVE,
        ]);
    }
}
