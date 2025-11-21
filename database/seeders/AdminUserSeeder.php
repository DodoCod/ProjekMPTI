<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Jalankan database seeder.
     */
    public function run(): void
    {
        // Kredensial Admin Default
        User::create([
            'name' => 'Fernando',
            'email' => 'fernando@dass42.test', 
            'password' => Hash::make('projekmpti'),
        ]);
    }
}