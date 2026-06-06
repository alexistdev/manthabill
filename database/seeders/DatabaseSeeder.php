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
        $this->call(AdminSeeder::class);
        $this->call(TldSeeder::class);

        User::create([
            'client'      => 1,
            'email'       => 'user@gmail.com',
            'password'    => bcrypt('password'),
            'date_create' => now()->toDateString(),
            'status'      => User::STATUS_ACTIVE,
        ]);
    }
}
