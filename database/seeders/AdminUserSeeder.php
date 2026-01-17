<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Tránh tạo trùng admin
        $exists = User::where('role', 'admin')
            ->where('username', 'admin')
            ->exists();

        if ($exists) {
            return;
        }

        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);
    }
}
