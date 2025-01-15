<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('account_types')->insert([
            [
                'name' => 'Admin',
                'description' => 'Administrator account with full privileges.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'description' => 'Regular user account with standard privileges.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
