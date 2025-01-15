<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(AccountTypeSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ResultSeeder::class);
    }
}
