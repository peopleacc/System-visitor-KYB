<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Visitor;
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
        // Run application seeders
        $this->call([
            CardSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'satpam123',
            'role' => 'admin',
            'password' => 'satpam321'
        ]);

    }

    public function run_visitor(): void
    {
        $this->call(CardSeeder::class);
    }

    public function run_dapt(): void
    {
        $this->call([
            DepartmentSeeder::class,
        ]);
    }
}
