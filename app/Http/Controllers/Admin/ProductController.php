<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $products = Product::latest()->paginate(15);
        
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5048',
            'price' => 'nullable|numeric|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'promo_start_date' => 'nullable|date',
            'promo_end_date' => 'nullable|date|after_or_equal:promo_start_date',
            'material' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_promo' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Hitung otomatis promo_price dari discount_percentage
        if ($validated['discount_percentage'] && $validated['price']) {
            $validated['promo_price'] = $validated['price'] - ($validated['price'] * $validated['discount_percentage'] / 100);
        }

        $validated['image'] = $this->imageService->upload($request->file('image'), 'products');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_promo'] = $request->has('is_promo');
        $validated['is_active'] = $request->has('is_active');

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5048',
            'price' => 'nullable|numeric|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'promo_start_date' => 'nullable|date',
            'promo_end_date' => 'nullable|date|after_or_equal:promo_start_date',
            'material' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_promo' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Hitung otomatis promo_price dari discount_percentage
        if ($validated['discount_percentage'] && $validated['price']) {
            $validated['promo_price'] = $validated['price'] - ($validated['price'] * $validated['discount_percentage'] / 100);
        } else {
            $validated['promo_price'] = null;
        }

        if ($request->hasFile('image')) {
            $this->imageService->delete($product->image);
            $validated['image'] = $this->imageService->upload($request->file('image'), 'products');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_promo'] = $request->has('is_promo');
        $validated['is_active'] = $request->has('is_active');

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $this->imageService->delete($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
