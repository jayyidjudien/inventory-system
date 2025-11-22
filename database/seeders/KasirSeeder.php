<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class KasirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kasirs = [
            [
                'name' => 'Kasir Utama',
                'email' => 'kasir1@inventori.local',
                'password' => 'kasir1234',
            ],
            [
                'name' => 'Kasir Backup',
                'email' => 'kasir2@inventori.local',
                'password' => 'kasir1234',
            ],
        ];

        foreach ($kasirs as $k) {
            User::updateOrCreate(
                ['email' => $k['email']],
                [
                    'name' => $k['name'],
                    'password' => Hash::make($k['password']),
                    'role' => 'warehouse', // role untuk kasir/gudang sesuai routes
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ]
            );
        }
    }
}
