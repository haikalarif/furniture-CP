# 🚀 KalKayu Living - Railway Deployment

## 📦 Project Status
- ✅ PHP 8.2
- ✅ Laravel 10
- ✅ MySQL Database
- ✅ Vite Assets
- ✅ Storage Images

---

## 🎯 Quick Start

### 1. Upload Images (PENTING!)
```bash
# Windows
upload-images.bat

# Manual
git add storage/app/public/
git commit -m "Add storage images"
git push origin main
```

### 2. Deploy ke Railway
Ikuti: **DEPLOY_RAILWAY_STEP_BY_STEP.md**

### 3. After Deploy
```bash
railway run php artisan storage:link
```

---

## 📚 Dokumentasi

### Deployment Guides
1. **DEPLOY_RAILWAY_STEP_BY_STEP.md** - Panduan lengkap deploy Railway (BACA INI DULU!)
2. **RAILWAY_DEPLOYMENT.md** - Dokumentasi teknis
3. **RAILWAY_QUICK_FIX.md** - Troubleshooting NPM error

### Image Upload Guides
1. **QUICK_UPLOAD_IMAGES.md** - Quick guide upload gambar (3 langkah)
2. **UPLOAD_IMAGES_TO_RAILWAY.md** - Panduan lengkap upload gambar

### Helper Scripts
- **upload-images.bat** - Script otomatis upload gambar (Windows)

---

## 🔧 Configuration Files

### Railway Config
- `.php-version` - PHP 8.2
- `nixpacks.json` - Build configuration (PHP + Node.js)
- `railway.json` - Railway settings
- `Procfile` - Start command
- `.npmrc` - NPM configuration

### Laravel Config
- `composer.json` - PHP dependencies
- `package.json` - NPM dependencies
- `vite.config.js` - Vite configuration

---

## 📋 Deployment Checklist

### Before Deploy
- [ ] Push code ke GitHub
- [ ] Upload images (run `upload-images.bat`)
- [ ] Verify `.php-version` exists
- [ ] Verify `nixpacks.json` exists

### Railway Setup
- [ ] Create Railway project
- [ ] Add MySQL database
- [ ] Link database variables
- [ ] Set environment variables (APP_KEY, APP_URL, etc.)
- [ ] Generate domain

### After Deploy
- [ ] Run `railway run php artisan storage:link`
- [ ] Test website
- [ ] Verify images loading
- [ ] Create admin user (if needed)

---

## 🌐 Environment Variables

Required variables di Railway:

```env
APP_NAME=KalKayu Living
APP_ENV=production
APP_KEY=base64:xxxxx (generate dulu!)
APP_DEBUG=false
APP_URL=https://your-app.railway.app

DB_CONNECTION=mysql
DB_HOST=${{MYSQLHOST}}
DB_PORT=${{MYSQLPORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}

SESSION_DRIVER=file
QUEUE_CONNECTION=sync
LOG_CHANNEL=stack
LOG_LEVEL=error
FILESYSTEM_DISK=public
```

---

## 🎨 Features

### Frontend
- ✅ Homepage dengan hero section
- ✅ Produk catalog dengan filter
- ✅ Galeri dengan lightbox
- ✅ Testimoni
- ✅ Contact form
- ✅ Responsive design (mobile-friendly)

### Admin Panel
- ✅ Dashboard dengan statistik
- ✅ Kelola Produk (CRUD)
- ✅ Kelola Galeri (CRUD)
- ✅ Kelola Keunggulan (CRUD)
- ✅ Kelola Testimoni (CRUD)
- ✅ Kelola Pesan Kontak
- ✅ Kelola Artikel (CRUD)
- ✅ Kelola Halaman (CRUD)
- ✅ Responsive admin panel

---

## 🔐 Default Admin

Setelah deploy, buat admin user:

```bash
railway run php artisan tinker
```

Lalu:
```php
User::create([
    'name' => 'Admin',
    'email' => 'admin@kalkayu.com',
    'password' => bcrypt('password123')
]);
```

---

## 🐛 Troubleshooting

### Build Failed
- Cek `RAILWAY_QUICK_FIX.md`
- Verify nixpacks.json
- Check Railway logs

### Images Not Loading
- Run `railway run php artisan storage:link`
- Verify APP_URL
- Check storage folder uploaded

### Database Error
- Verify MySQL service active
- Check database variables linked
- Test connection: `railway run php artisan db:show`

### 500 Error
- Check APP_KEY set
- Verify APP_DEBUG=false
- Check logs: `railway logs`

---

## 📞 Support

### Railway
- Docs: https://docs.railway.app
- Discord: https://discord.gg/railway
- Status: https://status.railway.app

### Laravel
- Docs: https://laravel.com/docs
- Discord: https://discord.gg/laravel

---

## 🚀 Deployment Flow

```
Local Development
    ↓
Git Commit & Push
    ↓
GitHub Repository
    ↓
Railway Auto-Deploy
    ↓
Build (PHP + Node.js)
    ↓
Run Migrations
    ↓
Start Server
    ↓
Live Website! 🎉
```

---

## 📊 Project Structure

```
kalkayu-living/
├── app/                    # Laravel application
├── resources/              # Views, CSS, JS
├── storage/
│   └── app/
│       └── public/         # Uploaded images ← IMPORTANT!
│           ├── products/
│           ├── galleries/
│           └── hero/
├── public/                 # Public assets
├── database/               # Migrations, seeders
├── routes/                 # Route definitions
├── .php-version           # PHP 8.2
├── nixpacks.json          # Railway build config
├── railway.json           # Railway settings
├── Procfile               # Start command
└── upload-images.bat      # Helper script
```

---

## 🎯 Next Steps

1. ✅ Deploy ke Railway
2. ✅ Upload images
3. ✅ Test website
4. ⬜ Custom domain (optional)
5. ⬜ SSL certificate (auto by Railway)
6. ⬜ Monitoring & analytics
7. ⬜ Backup strategy

---

**Happy Deploying! 🚀**
