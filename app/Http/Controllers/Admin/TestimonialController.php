<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\ImageService;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(15);
        
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $this->imageService->upload($request->file('avatar'), 'testimonials');
        }

        $validated['is_active'] = $request->has('is_active');

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('avatar')) {
            $this->imageService->delete($testimonial->avatar);
            $validated['avatar'] = $this->imageService->upload($request->file('avatar'), 'testimonials');
        }

        $validated['is_active'] = $request->has('is_active');

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui');
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->imageService->delete($testimonial->avatar);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus');
    }
}
