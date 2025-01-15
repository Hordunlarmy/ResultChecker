<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Result;
use App\Models\User;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample subjects
        $subjects = [
            'Mathematics',
            'Science',
            'English',
            'History',
            'Geography',
            'Computer Science',
            'Physical Education',
            'Art',
            'Music',
            'Economics',
        ];

        // Fetch all users
        $users = User::all();

        foreach ($users as $user) {
            foreach ($subjects as $subject) {
                Result::create([
                    'user_id' => $user->id,
                    'subject' => $subject,
                    'score' => rand(50, 100),
                    'total_marks' => 100,
                ]);
            }
        }
    }
}
