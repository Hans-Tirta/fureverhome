<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of published articles.
     */
    public function index()
    {
        // Get all articles with author and category
        $articles = Article::with(['author', 'category'])
            ->latest()
            ->paginate(12);

        return view('articles.index', compact('articles'));
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        // Load relationships
        $article->load(['author', 'category']);

        // Increment views counter
        $article->increment('views');

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $this->authorize('create', Article::class);

        // Fetch article-specific categories
        $categories = Category::forArticles()->get();
        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(ArticleRequest $request)
    {
        // Validation handled by ArticleRequest
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        // Set author
        $validated['author_id'] = Auth::id();

        Article::create($validated);

        return redirect()->route('articles.manage')->with('success', 'Article created successfully!');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        // Fetch article-specific categories
        $categories = Category::forArticles()->get();
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        // Validation handled by ArticleRequest
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        } else {
            // Keep existing image properly if no new image uploaded
            unset($validated['featured_image']);
        }

        $article->update($validated);

        return redirect()->route('articles.manage')->with('success', 'Article updated successfully!');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        // Delete image if exists
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->delete();

        return redirect()->route('articles.manage')->with('success', 'Article deleted successfully!');
    }

    /**
     * Display a listing of articles for management.
     */
    public function manage()
    {
        $this->authorize('manage', Article::class);

        $articles = Article::with(['author', 'category'])
            ->latest()
            ->paginate(10);

        return view('articles.manage', compact('articles'));
    }
}
