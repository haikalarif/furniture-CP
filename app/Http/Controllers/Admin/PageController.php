<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_theme' => 'nullable|string|max:50',
            'hero_background' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Handle hero background upload
        if ($request->hasFile('hero_background')) {
            // Delete old background if exists
            if ($page->hero_background && \Storage::disk('public')->exists($page->hero_background)) {
                \Storage::disk('public')->delete($page->hero_background);
            }
            
            $file = $request->file('hero_background');
            $filename = time() . '_hero_' . \Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('hero', $filename, 'public');
            $validated['hero_background'] = $path;
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil diperbarui');
    }
}
