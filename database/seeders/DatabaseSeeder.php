<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default user
        User::firstOrCreate(
            ['email' => 'abdelrahmanyouseff@gmail.com'],
            [
                'name' => 'Abdelrahman Youseff',
                'password' => Hash::make('password123'),
            ]
        );

        $this->call([
            ProjectSeeder::class,
        ]);
    }
}
