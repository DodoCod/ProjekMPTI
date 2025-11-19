<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DassCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Depression', 'code' => 'D', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Anxiety', 'code' => 'A', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Stress', 'code' => 'S', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}