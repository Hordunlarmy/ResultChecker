<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Regular User',
            'email' => 'user@xfinders.com',
            'password' => Hash::make('password'),
            'account_type_id' => 2,
        ]);

        User::create([
            'name' => 'Regular User 1',
            'email' => 'user1@xfinders.com',
            'password' => Hash::make('password'),
            'account_type_id' => 2,
        ]);

        User::create([
            'name' => 'Regular User 2',
            'email' => 'user2@xfinders.com',
            'password' => Hash::make('password'),
            'account_type_id' => 2,
        ]);
    }
}
