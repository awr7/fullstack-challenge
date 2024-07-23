<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function ($user) {
            Comment::factory()->count(rand(50, 200))->create([
                'user_id' => $user->id,
            ]);

            // more comments for two days ago
            Comment::factory()->count(rand(10, 50))->create([
                'user_id' => $user->id,
                'created_at' => now()->subDays(2),
            ]);

            // more comments for yesterday
            Comment::factory()->count(rand(10, 50))->create([
                'user_id' => $user->id,
                'created_at' => now()->subDay(),
            ]);

            // more comments for today
            Comment::factory()->count(rand(10, 50))->create([
                'user_id' => $user->id,
                'created_at' => now(),
            ]);
        });
    }
}
