<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Services\ImageService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $galleries = Gallery::latest()->paginate(15);
        
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5048',
            'category' => 'required|in:interior,exterior,detail',
            'is_active' => 'boolean',
        ]);

        $validated['image'] = $this->imageService->upload($request->file('image'), 'galleries');
        $validated['is_active'] = $request->has('is_active');

        Gallery::create($validated);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5048',
            'category' => 'required|in:interior,exterior,detail',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $this->imageService->delete($gallery->image);
            $validated['image'] = $this->imageService->upload($request->file('image'), 'galleries');
        }

        $validated['is_active'] = $request->has('is_active');

        $gallery->update($validated);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy(Gallery $gallery)
    {
        $this->imageService->delete($gallery->image);
        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil dihapus');
    }
}
