<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $articles = Article::latest()->paginate(15);
        
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author' => 'nullable|string|max:255',
            'is_published' => 'boolean',
        ]);

        $validated['featured_image'] = $this->imageService->upload($request->file('featured_image'), 'articles');
        $validated['is_published'] = $request->has('is_published');
        $validated['author'] = $validated['author'] ?? 'Admin';
        
        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author' => 'nullable|string|max:255',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $this->imageService->delete($article->featured_image);
            $validated['featured_image'] = $this->imageService->upload($request->file('featured_image'), 'articles');
        }

        $validated['is_published'] = $request->has('is_published');
        
        if ($validated['is_published'] && !$article->published_at) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy(Article $article)
    {
        $this->imageService->delete($article->featured_image);
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus');
    }
}
