<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $query = Gallery::active()->ordered();
        
        // Filter by category if provided
        if (request('category')) {
            $query->where('category', request('category'));
        }
        
        $galleries = $query->paginate(12);
        
        $categories = ['interior', 'exterior', 'detail'];

        return view('frontend.gallery.index', compact('galleries', 'categories'));
    }
}
