<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'jondoe',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Change this to a secure password
            'role' => 'admin', // Ensure your users table has this column
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
