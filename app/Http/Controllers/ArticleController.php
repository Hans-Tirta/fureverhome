<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of published articles.
     */
    public function index()
    {
        // Get all articles
        $articles = Article::latest()
            ->paginate(10);

        return view('articles.index', compact('articles'));
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        // Increment views counter
        $article->increment('views');

        return view('articles.show', compact('article'));
    }
}
