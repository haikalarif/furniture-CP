# Best Practices - KalKayu Living

Dokumen ini menjelaskan best practices yang diterapkan dalam project ini.

## 🏗️ Architecture & Design Patterns

### 1. MVC Pattern (Model-View-Controller)
✅ **Diterapkan:**
- Models untuk data & business logic
- Views untuk presentation layer
- Controllers untuk request handling

**Contoh:**
```php
// Controller hanya handle request/response
public function index()
{
    $products = Product::active()->ordered()->paginate(12);
    return view('frontend.products.index', compact('products'));
}

// Model handle business logic
public function scopeActive($query)
{
    return $query->where('is_active', true);
}
```

### 2. Service Layer Pattern
✅ **Diterapkan:** ImageService untuk upload logic

**Keuntungan:**
- Reusable code
- Separation of concerns
- Mudah di-test
- Konsisten di semua controller

**Contoh:**
```php
// Tanpa Service (❌ Bad)
$path = $request->file('image')->store('products', 'public');

// Dengan Service (✅ Good)
$path = $this->imageService->upload($request->file('image'), 'products');
```

### 3. Repository Pattern (Implicit via Eloquent)
✅ **Diterapkan:** Query scopes sebagai repository methods

**Contoh:**
```php
// Scope sebagai repository method
public function scopePublished($query)
{
    return $query->where('is_published', true)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now());
}

// Usage
$articles = Article::published()->latest()->get();
```

## 📝 Code Quality

### 1. Naming Conventions

✅ **Controllers:** PascalCase + Controller suffix
```php
ProductController, ArticleController
```

✅ **Models:** Singular PascalCase
```php
Product, Article, Testimonial
```

✅ **Methods:** camelCase, descriptive
```php
public function incrementViews()
public function getByKey(string $key)
```

✅ **Variables:** camelCase, descriptive
```php
$featuredProducts, $latestArticles
```

✅ **Database Tables:** Plural snake_case
```php
products, articles, testimonials
```

✅ **Routes:** kebab-case
```php
/tentang-kami, /produk/{slug}
```

### 2. Single Responsibility Principle

✅ **Setiap class/method punya satu tanggung jawab:**

```php
// ✅ Good - Single responsibility
class ImageService
{
    public function upload($file, $folder) { }
    public function delete($path) { }
}

// ❌ Bad - Multiple responsibilities
class ProductController
{
    public function store()
    {
        // Upload image logic here (should be in service)
        // Email notification logic here (should be in service)
        // Payment processing here (should be in service)
    }
}
```

### 3. DRY (Don't Repeat Yourself)

✅ **Reusable components:**

```php
// Layout reusable
@extends('layouts.frontend')

// Blade components
@include('components.product-card', ['product' => $product])

// Query scopes
Product::active()->featured()->ordered()->get();
```

### 4. Descriptive & Self-Documenting Code

✅ **Code yang jelas tanpa perlu banyak comment:**

```php
// ✅ Good - Self-explanatory
public function incrementViews()
{
    $this->increment('views');
}

// ❌ Bad - Needs comment
public function iv() // increment views
{
    $this->increment('views');
}
```

## 🔒 Security Best Practices

### 1. CSRF Protection
✅ **Semua form POST menggunakan @csrf:**
```blade
<form method="POST">
    @csrf
    <!-- form fields -->
</form>
```

### 2. SQL Injection Prevention
✅ **Menggunakan Eloquent ORM & Parameter Binding:**
```php
// ✅ Good - Safe from SQL injection
Product::where('slug', $slug)->first();

// ❌ Bad - Vulnerable
DB::select("SELECT * FROM products WHERE slug = '$slug'");
```

### 3. XSS Protection
✅ **Blade auto-escaping:**
```blade
<!-- ✅ Good - Auto escaped -->
{{ $product->name }}

<!-- ❌ Bad - Not escaped, only use if you trust the content -->
{!! $product->description !!}
```

### 4. Mass Assignment Protection
✅ **Menggunakan $fillable:**
```php
protected $fillable = [
    'name',
    'slug',
    'category',
    // only allowed fields
];
```

### 5. File Upload Validation
✅ **Validasi type & size:**
```php
'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
```

### 6. Authentication & Authorization
✅ **Middleware untuk protect routes:**
```php
Route::middleware(['auth'])->group(function () {
    // Protected routes
});
```

## 🎯 Laravel Best Practices

### 1. Eloquent Relationships
✅ **Gunakan relationships daripada manual joins:**
```php
// ✅ Good
$user->articles;

// ❌ Bad
DB::table('articles')->where('user_id', $user->id)->get();
```

### 2. Query Scopes
✅ **Reusable query logic:**
```php
// Define scope
public function scopeActive($query)
{
    return $query->where('is_active', true);
}

// Use scope
Product::active()->get();
```

### 3. Eager Loading (Prevent N+1)
✅ **Load relationships efficiently:**
```php
// ✅ Good - 2 queries
$products = Product::with('category')->get();

// ❌ Bad - N+1 queries
$products = Product::all();
foreach ($products as $product) {
    echo $product->category->name; // Query for each product
}
```

### 4. Form Request Validation
✅ **Validation di Request class:**
```php
// ✅ Good - Separate validation
public function store(ProductRequest $request)
{
    Product::create($request->validated());
}

// ❌ Bad - Validation in controller
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        // ... many rules
    ]);
}
```

### 5. Resource Controllers
✅ **Gunakan resource controllers untuk CRUD:**
```php
Route::resource('products', ProductController::class);
```

### 6. Route Model Binding
✅ **Automatic model injection:**
```php
// ✅ Good - Auto finds or 404
public function show(Product $product)
{
    return view('products.show', compact('product'));
}

// ❌ Bad - Manual find
public function show($id)
{
    $product = Product::findOrFail($id);
    return view('products.show', compact('product'));
}
```

## 🎨 Frontend Best Practices

### 1. Blade Layouts
✅ **Reusable layouts:**
```blade
@extends('layouts.frontend')

@section('content')
    <!-- Page content -->
@endsection
```

### 2. Blade Components
✅ **Reusable UI components:**
```blade
@component('components.alert', ['type' => 'success'])
    {{ $message }}
@endcomponent
```

### 3. Asset Organization
✅ **Organized asset structure:**
```
resources/
├── css/
│   └── app.css
├── js/
│   └── app.js
└── views/
```

### 4. Responsive Design
✅ **Mobile-first dengan Tailwind:**
```html
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4">
    <!-- Responsive grid -->
</div>
```

## 📊 Database Best Practices

### 1. Migration Naming
✅ **Descriptive migration names:**
```php
2024_01_01_000001_create_products_table.php
2024_01_01_000002_add_featured_to_products_table.php
```

### 2. Foreign Keys
✅ **Use foreign key constraints:**
```php
$table->foreignId('user_id')->constrained()->onDelete('cascade');
```

### 3. Indexes
✅ **Index frequently queried columns:**
```php
$table->string('slug')->unique();
$table->index('category');
```

### 4. Soft Deletes (Optional)
✅ **Untuk data yang perlu recovery:**
```php
use SoftDeletes;
$table->softDeletes();
```

## 🚀 Performance Best Practices

### 1. Pagination
✅ **Paginate large datasets:**
```php
$products = Product::paginate(12);
```

### 2. Select Specific Columns
✅ **Only select needed columns:**
```php
// ✅ Good
Product::select('id', 'name', 'slug')->get();

// ❌ Bad - Selects all columns
Product::all();
```

### 3. Caching (Production)
✅ **Cache configuration & routes:**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 4. Optimize Autoloader
✅ **Production optimization:**
```bash
composer install --optimize-autoloader --no-dev
```

## 📁 File Organization

### 1. Logical Grouping
✅ **Group related files:**
```
Controllers/
├── Admin/          # Admin controllers
└── Frontend/       # Public controllers
```

### 2. Consistent Structure
✅ **Follow Laravel conventions:**
```
app/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
├── Models/
└── Services/
```

## 🧪 Testing Ready

### 1. Testable Code
✅ **Dependency injection:**
```php
public function __construct(ImageService $imageService)
{
    $this->imageService = $imageService;
}
```

### 2. Service Layer
✅ **Easy to mock & test:**
```php
// Easy to test
$this->imageService->upload($file, 'products');
```

## 📝 Documentation

### 1. Code Comments
✅ **Comment complex logic only:**
```php
// ✅ Good - Complex logic explained
// Calculate discount based on user tier and purchase history
$discount = $this->calculateTieredDiscount($user);

// ❌ Bad - Obvious comment
// Get all products
$products = Product::all();
```

### 2. README Files
✅ **Comprehensive documentation:**
- README.md - Overview
- SETUP_GUIDE.md - Installation
- CODE_STRUCTURE.md - Architecture
- DEPLOYMENT_CHECKLIST.md - Deployment

## ✅ Checklist Summary

- [x] MVC Pattern
- [x] Service Layer
- [x] Repository Pattern (via Scopes)
- [x] Naming Conventions
- [x] Single Responsibility
- [x] DRY Principle
- [x] CSRF Protection
- [x] SQL Injection Prevention
- [x] XSS Protection
- [x] Mass Assignment Protection
- [x] File Upload Validation
- [x] Authentication & Authorization
- [x] Eloquent Relationships
- [x] Query Scopes
- [x] Eager Loading
- [x] Form Request Validation
- [x] Resource Controllers
- [x] Route Model Binding
- [x] Blade Layouts & Components
- [x] Responsive Design
- [x] Database Migrations
- [x] Pagination
- [x] Performance Optimization
- [x] Logical File Organization
- [x] Comprehensive Documentation

---

**Project ini mengikuti Laravel best practices dan siap untuk production deployment.**
