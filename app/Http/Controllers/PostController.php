<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
        ]);

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

    public function update(Request $request, Post $post): JsonResponse
    {
        $post->update($request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'category_id' => 'sometimes|required|exists:categories,id',
            'author_id' => 'sometimes|required|exists:authors,id',
        ]));

        return response()->json($post);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json(null, 204);
    }
}
