<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_posts_with_relationships()
    {
        $this->seed();

        $response = $this->getJson('/api/posts');
        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }

    public function test_can_create_post()
    {
        $this->seed();

        $response = $this->postJson('/api/posts', [
            'title' => 'test post',
            'content' => 'test content',
            'category_id' => 1,
            'author_id' => 1,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', ['title' => 'test post']);
    }
}
