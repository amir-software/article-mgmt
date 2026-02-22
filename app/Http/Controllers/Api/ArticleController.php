<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;



class ArticleController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // Validate incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create article
        $article = Article::create($validated);

        return response()->json([
            'message' => 'Article created successfully',
            'data' => $article
        ], 201);
    }
    public function index(): JsonResponse
    {
        $articles = Article::latest()->get();

        return response()->json([
            'data' => $articles
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $article = Article::findOrFail($id);

        return response()->json([
            'data' => $article
        ]);
    }
}
