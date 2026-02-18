# Panduan Kustomisasi - KalKayu Living

Panduan lengkap untuk mengkustomisasi dan mengembangkan aplikasi sesuai kebutuhan.

## 🎨 Kustomisasi Tampilan

### 1. Mengubah Warna Brand

**File:** `resources/views/layouts/frontend.blade.php`

Cari dan ganti warna Tailwind:
```html
<!-- Primary Color (saat ini: amber-700) -->
<span class="text-amber-700">Living</span>
<a class="bg-amber-700 hover:bg-amber-800">Button</a>

<!-- Ganti dengan warna lain: -->
<span class="text-blue-700">Living</span>
<a class="bg-blue-700 hover:bg-blue-800">Button</a>
```

**Pilihan warna Tailwind:**
- `blue-700` - Biru profesional
- `green-700` - Hijau natural
- `purple-700` - Ungu modern
- `red-700` - Merah bold
- `gray-900` - Hitam minimalis

### 2. Mengubah Font

**File:** `resources/views/layouts/frontend.blade.php`

```html
<!-- Ganti Google Font -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>
```

### 3. Menambah Logo

1. Upload logo ke `public/images/logo.png`
2. Edit `resources/views/layouts/frontend.blade.php`:

```html
<a href="{{ route('home') }}" class="flex items-center">
    <img src="{{ asset('images/logo.png') }}" alt="KalKayu Living" class="h-12">
</a>
```

### 4. Mengubah Hero Section

**File:** `resources/views/frontend/home.blade.php`

```html
<section class="relative h-screen flex items-center justify-center bg-gradient-to-br from-amber-50 to-stone-100">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl md:text-7xl font-bold text-gray-900 mb-6">
            <!-- Edit judul di sini -->
            Furniture Premium<br>untuk Hunian <span class="text-amber-700">Impian</span>
        </h1>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            <!-- Edit deskripsi di sini -->
            Desain custom minimalis dengan material berkualitas tinggi
        </p>
    </div>
</section>
```

## 📱 Kustomisasi Kontak

### 1. Mengubah Nomor WhatsApp

Cari dan ganti `6281234567890` di file berikut:

**File 1:** `resources/views/layouts/frontend.blade.php`
```html
<a href="https://wa.me/6281234567890" target="_blank">
```

**File 2:** `resources/views/frontend/home.blade.php`
```html
<a href="https://wa.me/6281234567890" target="_blank">
```

**File 3:** `resources/views/frontend/contact.blade.php`
```html
<a href="https://wa.me/6281234567890" target="_blank">
```

**Format nomor:**
- Gunakan kode negara (62 untuk Indonesia)
- Hilangkan angka 0 di depan
- Contoh: 0812-3456-7890 → 6281234567890

### 2. Mengubah Email & Alamat

**File:** `resources/views/frontend/contact.blade.php`

```html
<p class="text-gray-600">info@kalkayuliving.com</p>
<p class="text-gray-600">Jl. Furniture Premium No. 123<br>Jakarta Selatan</p>
```

### 3. Menambah Social Media Links

**File:** `resources/views/layouts/frontend.blade.php` (Footer)

```html
<div class="flex space-x-4">
    <a href="https://instagram.com/yourhandle" class="hover:text-white">
        <i class="fab fa-instagram text-2xl"></i>
    </a>
    <a href="https://facebook.com/yourpage" class="hover:text-white">
        <i class="fab fa-facebook text-2xl"></i>
    </a>
</div>
```

## 🔧 Menambah Fitur Baru

### 1. Menambah Field ke Product

**Step 1:** Buat migration
```bash
php artisan make:migration add_warranty_to_products_table
```

**Step 2:** Edit migration
```php
public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('warranty')->nullable()->after('dimensions');
    });
}
```

**Step 3:** Jalankan migration
```bash
php artisan migrate
```

**Step 4:** Update Model
```php
// app/Models/Product.php
protected $fillable = [
    // ... existing fields
    'warranty',
];
```

**Step 5:** Update Form
```html
<!-- resources/views/admin/products/create.blade.php -->
<div>
    <label>Garansi</label>
    <input type="text" name="warranty" value="{{ old('warranty') }}">
</div>
```

**Step 6:** Update Controller Validation
```php
// app/Http/Controllers/Admin/ProductController.php
$validated = $request->validate([
    // ... existing rules
    'warranty' => 'nullable|string|max:255',
]);
```

### 2. Menambah Model Baru (Contoh: Category)

**Step 1:** Buat Model & Migration
```bash
php artisan make:model Category -m
```

**Step 2:** Edit Migration
```php
// database/migrations/xxxx_create_categories_table.php
public function up()
{
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}
```

**Step 3:** Edit Model
```php
// app/Models/Category.php
protected $fillable = ['name', 'slug', 'description', 'is_active'];

protected $casts = [
    'is_active' => 'boolean',
];

public function products()
{
    return $this->hasMany(Product::class);
}
```

**Step 4:** Update Product Model
```php
// app/Models/Product.php
public function category()
{
    return $this->belongsTo(Category::class);
}
```

**Step 5:** Buat Controller
```bash
php artisan make:controller Admin/CategoryController --resource
```

**Step 6:** Tambah Routes
```php
// routes/web.php
Route::resource('categories', CategoryController::class);
```

**Step 7:** Buat Views
```
resources/views/admin/categories/
├── index.blade.php
├── create.blade.php
└── edit.blade.php
```

### 3. Menambah Halaman Statis Baru

**Step 1:** Tambah Route
```php
// routes/web.php
Route::get('/layanan', [HomeController::class, 'services'])->name('services');
```

**Step 2:** Tambah Method di Controller
```php
// app/Http/Controllers/Frontend/HomeController.php
public function services()
{
    return view('frontend.services');
}
```

**Step 3:** Buat View
```bash
# Buat file: resources/views/frontend/services.blade.php
```

**Step 4:** Tambah ke Navigation
```html
<!-- resources/views/layouts/frontend.blade.php -->
<a href="{{ route('services') }}" class="nav-link">Layanan</a>
```

## 📊 Menambah Fitur Admin

### 1. Menambah Menu Sidebar

**File:** `resources/views/layouts/admin.blade.php`

```html
<nav class="mt-6">
    <!-- Existing menus -->
    
    <!-- New menu -->
    <a href="{{ route('admin.categories.index') }}" 
       class="flex items-center px-6 py-3 hover:bg-gray-800">
        <i class="fas fa-tags mr-3"></i> Kategori
    </a>
</nav>
```

### 2. Menambah Widget Dashboard

**File:** `resources/views/admin/dashboard.blade.php`

```html
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm">Total Kategori</p>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['categories'] }}</p>
        </div>
        <div class="bg-purple-100 p-3 rounded-full">
            <i class="fas fa-tags text-purple-600 text-2xl"></i>
        </div>
    </div>
</div>
```

**Update Controller:**
```php
// app/Http/Controllers/Admin/DashboardController.php
$stats = [
    // ... existing stats
    'categories' => Category::count(),
];
```

## 🎯 Kustomisasi Lanjutan

### 1. Menambah Filter Produk

**File:** `app/Http/Controllers/Frontend/ProductController.php`

```php
public function index(Request $request)
{
    $query = Product::active()->ordered();
    
    // Filter by category
    if ($request->has('category')) {
        $query->where('category', $request->category);
    }
    
    // Filter by price range
    if ($request->has('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }
    
    if ($request->has('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }
    
    // Search
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }
    
    $products = $query->paginate(12);
    
    return view('frontend.products.index', compact('products'));
}
```

### 2. Menambah Image Gallery untuk Produk

**Step 1:** Field sudah ada di migration (`gallery` JSON field)

**Step 2:** Update Form
```html
<!-- resources/views/admin/products/create.blade.php -->
<div>
    <label>Galeri Gambar (Multiple)</label>
    <input type="file" name="gallery[]" accept="image/*" multiple>
</div>
```

**Step 3:** Update Controller
```php
// app/Http/Controllers/Admin/ProductController.php
if ($request->hasFile('gallery')) {
    $validated['gallery'] = $this->imageService->uploadMultiple(
        $request->file('gallery'), 
        'products/gallery'
    );
}
```

**Step 4:** Display Gallery
```html
<!-- resources/views/frontend/products/show.blade.php -->
@if($product->gallery)
    <div class="grid grid-cols-4 gap-4">
        @foreach($product->gallery as $image)
            <img src="{{ asset('storage/' . $image) }}" alt="Gallery">
        @endforeach
    </div>
@endif
```

### 3. Menambah Search Functionality

**Step 1:** Tambah Form di Layout
```html
<!-- resources/views/layouts/frontend.blade.php -->
<form action="{{ route('products.index') }}" method="GET" class="flex">
    <input type="text" name="search" placeholder="Cari produk..." 
           class="border rounded-l px-4 py-2">
    <button type="submit" class="bg-amber-700 text-white px-6 py-2 rounded-r">
        <i class="fas fa-search"></i>
    </button>
</form>
```

**Step 2:** Update Controller (sudah ada di contoh filter di atas)

### 4. Menambah Related Products

**File:** `app/Http/Controllers/Frontend/ProductController.php`

```php
public function show(string $slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();
    
    // Get related products
    $relatedProducts = Product::active()
        ->where('category', $product->category)
        ->where('id', '!=', $product->id)
        ->inRandomOrder()
        ->take(4)
        ->get();
    
    return view('frontend.products.show', compact('product', 'relatedProducts'));
}
```

## 🔐 Kustomisasi Authentication

### 1. Menambah Field ke User Registration

**Step 1:** Buat migration
```bash
php artisan make:migration add_phone_to_users_table
```

**Step 2:** Update registration form (Laravel Breeze)
```html
<!-- resources/views/auth/register.blade.php -->
<div>
    <label>Phone</label>
    <input type="tel" name="phone" value="{{ old('phone') }}">
</div>
```

### 2. Menambah Role System

Untuk role system yang lebih kompleks, pertimbangkan menggunakan package seperti:
- Spatie Laravel Permission
- Laravel Sanctum (untuk API)

## 📧 Menambah Email Notifications

**Step 1:** Setup email di `.env`
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="KalKayu Living"
```

**Step 2:** Buat Notification
```bash
php artisan make:notification NewProductNotification
```

**Step 3:** Send Notification
```php
// In controller
use App\Notifications\NewProductNotification;

$user->notify(new NewProductNotification($product));
```

## 🚀 Tips Kustomisasi

1. **Selalu backup sebelum mengubah code**
2. **Test di local dulu sebelum deploy**
3. **Gunakan version control (Git)**
4. **Dokumentasikan perubahan yang dibuat**
5. **Follow Laravel naming conventions**
6. **Keep code clean & readable**

## 📚 Resources

- Laravel Documentation: https://laravel.com/docs
- Tailwind CSS: https://tailwindcss.com/docs
- Font Awesome Icons: https://fontawesome.com/icons
- Laravel Daily Tips: https://laraveldaily.com

---

**Selamat mengkustomisasi! Jika ada pertanyaan, refer ke dokumentasi Laravel atau community forum.**
