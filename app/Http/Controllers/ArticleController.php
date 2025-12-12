<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
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
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only administrators can create articles.');
        }

        $categories = Category::whereNotNull('parent_id')
            ->whereIn('name', ['Dogs', 'Cats', 'Other animal', 'General'])
            ->get();
        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only administrators can create articles.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        // Set author
        $validated['author_id'] = auth()->id();

        Article::create($validated);

        return redirect()->route('articles.manage')->with('success', 'Article created successfully!');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only administrators can edit articles.');
        }

        $categories = Category::whereNotNull('parent_id')
            ->whereIn('name', ['Dogs', 'Cats', 'Other animal', 'General'])
            ->get();
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only administrators can update articles.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $article->update($validated);

        return redirect()->route('articles.manage')->with('success', 'Article updated successfully!');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only administrators can delete articles.');
        }

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
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only administrators can manage articles.');
        }

        $articles = Article::with(['author', 'category'])
            ->latest()
            ->paginate(10);

        return view('articles.manage', compact('articles'));
    }
}
