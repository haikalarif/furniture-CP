<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()->latest()->paginate(9);

        return view('frontend.articles.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)->published()->firstOrFail();
        $article->incrementViews();
        
        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.articles.show', compact('article', 'relatedArticles'));
    }
}
