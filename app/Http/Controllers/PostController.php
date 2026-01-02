<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PostRequest;
class PostController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Post::with(['author', 'category', 'comments'])->get()->map(fn($post) => [
                'id' => $post->id,
                'title' => $post->title,
                'author' => $post->author->name,
                'category' => $post->category->name,
                'comments_count' => $post->comments->count(),
            ])
        );
    }

    public function store(PostRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return response()->json(Post::create($validated), 201);
    }

    public function show(Post $post): JsonResponse
    {
        $post->load('comments');
        return response()->json([
            'post' => $post,
            'comments' => $post->comments,
        ]);
    }

    public function update(PostRequest $request, Post $post): JsonResponse
    {
        $post->update($request->validated());

        return response()->json($post);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json(null, 204);
    }
}
