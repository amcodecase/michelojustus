<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user for testimonials management
        User::factory()->create([
            'name' => 'Michelo Justus',
            'email' => 'michelojustus@gmail.com',
            'password' => Hash::make('@WhiteDiamond0100'),
        ]);
    }
}
