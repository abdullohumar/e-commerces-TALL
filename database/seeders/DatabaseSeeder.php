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
        // Urutan penting: category harus ada sebelum product
        $this->call([
            CategorySeeder::class,
        ]);

        // User::factory(10)->create();

        User::create([
            'name' => 'Test User',
            'email' => 'test1@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
