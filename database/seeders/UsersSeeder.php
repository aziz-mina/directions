<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin user

        User::factory([
            'name' => 'Mina Isaac',
            'username' => 'minaisaac99',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'email_verified_at' => now(),
            'is_admin' => true
        ])->create();

        // Regular user

        User::factory([
            'name' => 'Regular User',
            'username' => 'reguser01',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
            'email_verified_at' => now(),
            'is_admin' => false
        ])->create();

        // Fake Users

        User::factory()->times(100)->create();
    }
}
