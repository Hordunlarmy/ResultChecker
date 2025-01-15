<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the admin user with the 'Admin' account type
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@xfinders.com',
            'password' => Hash::make('password'),
            'account_type_id' => 1,
        ]);
    }
}
