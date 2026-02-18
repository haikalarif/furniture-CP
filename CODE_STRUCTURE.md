# Struktur Kode KalKayu Living

## 📁 Struktur Folder Utama

```
kalkayu-living/
├── app/                        # Core aplikasi
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/         # Controller untuk admin panel
│   │   │   └── Frontend/      # Controller untuk halaman publik
│   │   └── Requests/          # Form validation requests
│   ├── Models/                # Eloquent models
│   └── Services/              # Business logic services
│
├── database/
│   ├── migrations/            # Database schema
│   └── seeders/               # Data dummy untuk testing
│
├── resources/
│   └── views/
│       ├── layouts/           # Template layouts
│       ├── frontend/          # Views halaman publik
│       └── admin/             # Views admin panel
│
├── routes/
│   └── web.php               # Route definitions
│
└── public/
    └── storage/              # Public storage untuk images
```

## 🎯 Penjelasan Struktur

### 1. Controllers (app/Http/Controllers)

#### Frontend Controllers
Menangani request dari pengunjung website:

- **HomeController.php**
  - `index()` - Halaman home dengan featured products, testimonials, articles
  - `about()` - Halaman tentang kami
  - `process()` - Halaman proses pengerjaan
  - `contact()` - Halaman kontak

- **ProductController.php**
  - `index()` - Daftar semua produk dengan filter kategori
  - `show($slug)` - Detail produk

- **ArticleController.php**
  - `index()` - Daftar artikel dengan pagination
  - `show($slug)` - Detail artikel + increment views

#### Admin Controllers
Menangani CRUD operations di admin panel:

- **DashboardController.php**
  - `index()` - Dashboard dengan statistik

- **ProductController.php**
  - `index()` - List produk
  - `create()` - Form tambah produk
  - `store()` - Simpan produk baru
  - `edit()` - Form edit produk
  - `update()` - Update produk
  - `destroy()` - Hapus produk

- **ArticleController.php**
  - CRUD operations untuk artikel

- **TestimonialController.php**
  - CRUD operations untuk testimoni

- **PageController.php**
  - `index()` - List halaman
  - `edit()` - Form edit halaman
  - `update()` - Update konten halaman

### 2. Models (app/Models)

#### Product.php
```php
// Attributes
- name, slug, category, description
- image, gallery, price
- material, dimensions
- is_featured, is_active, order

// Scopes
- active() - Filter produk aktif
- featured() - Filter produk unggulan
- ordered() - Sort by order & created_at

// Auto-generate slug dari name
```

#### Article.php
```php
// Attributes
- title, slug, excerpt, content
- featured_image, author
- is_published, published_at, views

// Scopes
- published() - Filter artikel published
- latest() - Sort by published_at desc

// Methods
- incrementViews() - Tambah view count
```

#### Testimonial.php
```php
// Attributes
- client_name, client_position, client_company
- content, avatar, rating
- is_active, order

// Scopes
- active() - Filter testimoni aktif
- ordered() - Sort by order
```

#### Page.php
```php
// Attributes
- key (unique identifier)
- title, content, meta

// Static Methods
- getByKey($key) - Get page by key
```

### 3. Services (app/Services)

#### ImageService.php
Service untuk handle upload dan delete gambar:

```php
// Methods
- upload($file, $folder) - Upload single image
- uploadMultiple($files, $folder) - Upload multiple images
- delete($path) - Delete image dari storage
```

**Keuntungan menggunakan Service:**
- Reusable code
- Separation of concerns
- Mudah di-test
- Konsisten di semua controller

### 4. Views (resources/views)

#### Layouts
- **frontend.blade.php** - Layout untuk halaman publik
  - Navigation bar
  - Footer
  - WhatsApp CTA
  - Tailwind CSS styling

- **admin.blade.php** - Layout untuk admin panel
  - Sidebar navigation
  - Top bar dengan logout
  - Alert messages
  - Admin styling

#### Frontend Views
```
frontend/
├── home.blade.php              # Homepage
├── about.blade.php             # Tentang kami
├── process.blade.php           # Proses pengerjaan
├── contact.blade.php           # Kontak
├── products/
│   ├── index.blade.php        # List produk
│   └── show.blade.php         # Detail produk
└── articles/
    ├── index.blade.php        # List artikel
    └── show.blade.php         # Detail artikel
```

#### Admin Views
```
admin/
├── dashboard.blade.php         # Dashboard
├── products/
│   ├── index.blade.php        # List produk
│   ├── create.blade.php       # Form tambah
│   └── edit.blade.php         # Form edit
├── articles/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
├── testimonials/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
└── pages/
    ├── index.blade.php
    └── edit.blade.php
```

### 5. Routes (routes/web.php)

#### Frontend Routes
```php
GET  /                          # Home
GET  /tentang-kami             # About
GET  /proses                   # Process
GET  /kontak                   # Contact
GET  /produk                   # Products list
GET  /produk/{slug}            # Product detail
GET  /artikel                  # Articles list
GET  /artikel/{slug}           # Article detail
```

#### Admin Routes (Protected by auth middleware)
```php
GET  /admin/dashboard          # Dashboard
Resource /admin/products       # Product CRUD
Resource /admin/articles       # Article CRUD
Resource /admin/testimonials   # Testimonial CRUD
GET  /admin/pages              # Pages list
GET  /admin/pages/{id}/edit    # Edit page
PUT  /admin/pages/{id}         # Update page
```

### 6. Database (database/migrations)

#### Tables
1. **users** - Admin authentication
2. **products** - Katalog produk
3. **articles** - Blog/artikel
4. **testimonials** - Review klien
5. **pages** - Konten halaman dinamis

## 🔄 Alur Kerja Sistem

### Frontend Flow
```
User Request → Route → Controller → Model → Database
                                  ↓
                              View (Blade)
                                  ↓
                            Response (HTML)
```

### Admin Flow (Create Product)
```
1. User akses /admin/products/create
2. ProductController@create → Tampilkan form
3. User submit form
4. ProductController@store
   ├── Validasi input
   ├── Upload image via ImageService
   ├── Simpan ke database via Model
   └── Redirect dengan success message
```

## 🎨 Design Patterns

### 1. MVC Pattern
- **Model**: Data & business logic
- **View**: Presentation layer
- **Controller**: Request handling

### 2. Service Layer Pattern
- ImageService untuk upload logic
- Memisahkan business logic dari controller

### 3. Repository Pattern (Implicit)
- Eloquent Model sebagai repository
- Scopes untuk query reusable

### 4. Blade Components
- Layout inheritance
- Reusable components
- Section & yield

## 🔐 Security Features

1. **CSRF Protection** - Semua form POST
2. **SQL Injection Prevention** - Eloquent ORM
3. **XSS Protection** - Blade auto-escaping
4. **Authentication** - Laravel Breeze
5. **Authorization** - Middleware auth
6. **File Upload Validation** - Image type & size

## 📊 Database Relationships

```
users (1) ─── (0..*) articles (author)

products (independent)
testimonials (independent)
pages (independent)
```

## 🚀 Performance Optimization

1. **Eager Loading** - Prevent N+1 queries
2. **Pagination** - Limit data per page
3. **Image Optimization** - Proper sizing
4. **Query Scopes** - Reusable efficient queries
5. **Caching Ready** - Structure supports caching

## 📝 Naming Conventions

### Controllers
- Singular noun + Controller
- Example: `ProductController`, `ArticleController`

### Models
- Singular noun
- Example: `Product`, `Article`

### Views
- Lowercase with dash
- Example: `index.blade.php`, `create.blade.php`

### Routes
- Kebab-case
- Example: `/tentang-kami`, `/produk/{slug}`

### Database Tables
- Plural lowercase
- Example: `products`, `articles`

## 🔧 Extensibility

Mudah untuk menambahkan fitur baru:

1. **Tambah Model Baru**
   - Buat migration
   - Buat model dengan relationships
   - Buat controller
   - Tambah routes
   - Buat views

2. **Tambah Field ke Model**
   - Buat migration
   - Update model fillable
   - Update form views
   - Update validation

3. **Tambah Fitur Admin**
   - Buat controller di Admin namespace
   - Tambah routes dengan auth middleware
   - Buat views di admin folder
   - Tambah menu di sidebar

---

Struktur ini dirancang untuk:
✅ Mudah dipahami developer lain  
✅ Mudah di-maintain  
✅ Mudah di-extend  
✅ Mengikuti Laravel best practices  
✅ Production-ready
