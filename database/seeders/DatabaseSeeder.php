<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder Admin Account
        User::create([
            'name' => 'Huy Odin',
            'email' => "2051063919@e.tlu.edu.vn",
            "email_verified_at" => Carbon::now(),
            'password' => Hash::make('password'),
            'role' => 1
        ]);
//         User::factory(10)->create();
//
//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
