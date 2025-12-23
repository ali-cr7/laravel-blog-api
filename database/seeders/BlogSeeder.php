<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Author;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $tech = Category::create(['name' => 'Technology']);
        $life = Category::create(['name' => 'Lifestyle']);

        $ali = Author::create(['name' => 'Ali Al Ali', 'email' => 'ali@prokoders.com']);
        $test = Author::create(['name' => 'Test Author', 'email' => 'test@prokoders.com']);

        $post1 = Post::create([
            'title' => 'laravel 12 basics',
            'content' => 'Task 1 for Prokoders.',
            'published_at' => now(),
            'category_id' => $tech->id,
            'author_id' => $ali->id,
        ]);

        $post2 = Post::create([
            'title' => 'flutter laravel integration',
            'content' => 'Building full-stack.',
            'published_at' => now(),
            'category_id' => $life->id,
            'author_id' => $test->id,
        ]);

        Comment::create(['content' => 'Great!', 'post_id' => $post1->id]);
        Comment::create(['content' => 'Thanks!', 'post_id' => $post2->id]);
    }
}
