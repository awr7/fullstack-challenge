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
        });
    }
}
