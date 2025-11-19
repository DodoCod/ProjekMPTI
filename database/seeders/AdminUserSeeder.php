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
            'name' => 'Administrator',
            'email' => 'admin@dass42.test', // Email yang akan digunakan untuk login
            'password' => Hash::make('password'), // Password default: 'password'
        ]);
    }
}