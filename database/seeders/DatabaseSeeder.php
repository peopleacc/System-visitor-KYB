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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin',
            'password' => 'pasword'
        ]);

    }

    public function runVisitor(): void
    {

        Visitor::factory()->create([
            'name_tamu' => 'Raisa Akmal Faridi',
            'Alamat' => 'Jl. Kebon Jeruk No. 123',
            'no_telp' => '081234567890',
            'no_police' => '081234567890',
            'user_meeting' =>    'raisa',
            'keperluan' => 'pengen makan',
            'jumlah_pengunjung' => 1,
            'tanggal_masuk' => now(),
            'user_id' => 1,
        ]);
    }
}
