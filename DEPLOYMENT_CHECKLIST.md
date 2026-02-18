# Deployment Checklist - KalKayu Living

## 📋 Pre-Deployment Checklist

### 1. Environment Configuration

- [ ] Copy `.env.example` ke `.env`
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Generate `APP_KEY` dengan `php artisan key:generate`
- [ ] Konfigurasi database production
- [ ] Set `APP_URL` sesuai domain production

```env
APP_NAME="KalKayu Living"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your_db_host
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### 2. Database Setup

- [ ] Buat database di hosting
- [ ] Jalankan migrations: `php artisan migrate --force`
- [ ] Jalankan seeder (opsional): `php artisan db:seed --force`
- [ ] Backup database setelah seeder

### 3. File Permissions

```bash
# Set permission untuk storage dan cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Atau jika perlu
chmod -R 777 storage
chmod -R 777 bootstrap/cache
```

### 4. Storage Link

```bash
php artisan storage:link
```

Pastikan folder `public/storage` ter-link ke `storage/app/public`

### 5. Dependencies

```bash
# Install production dependencies only
composer install --optimize-autoloader --no-dev

# Install & build frontend assets
npm install
npm run build
```

### 6. Optimization

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

### 7. Security

- [ ] Pastikan `.env` tidak ter-commit ke git
- [ ] Pastikan `APP_DEBUG=false`
- [ ] Ganti password admin default
- [ ] Set HTTPS di production
- [ ] Konfigurasi CORS jika perlu
- [ ] Review file permissions

### 8. Testing

- [ ] Test semua halaman frontend
- [ ] Test login admin
- [ ] Test CRUD produk
- [ ] Test CRUD artikel
- [ ] Test CRUD testimoni
- [ ] Test upload gambar
- [ ] Test responsive design
- [ ] Test di berbagai browser

## 🚀 Deployment Steps

### Shared Hosting (cPanel)

1. **Upload Files**
   ```
   - Upload semua file ke folder (misal: public_html/kalkayu)
   - Atau upload ke root jika dedicated domain
   ```

2. **Setup Public Directory**
   ```
   - Pindahkan isi folder 'public' ke 'public_html'
   - Update index.php path ke folder Laravel
   ```

3. **Database**
   ```
   - Buat database via cPanel
   - Import database jika ada
   - Update .env dengan kredensial database
   ```

4. **Run Commands via SSH**
   ```bash
   cd /path/to/laravel
   composer install --no-dev
   php artisan migrate --force
   php artisan storage:link
   php artisan optimize
   ```

### VPS (Ubuntu/Nginx)

1. **Install Requirements**
   ```bash
   sudo apt update
   sudo apt install php8.1 php8.1-fpm php8.1-mysql php8.1-mbstring php8.1-xml php8.1-curl
   sudo apt install nginx mysql-server composer
   ```

2. **Clone/Upload Project**
   ```bash
   cd /var/www
   git clone your-repo kalkayu-living
   cd kalkayu-living
   ```

3. **Setup Permissions**
   ```bash
   sudo chown -R www-data:www-data /var/www/kalkayu-living
   sudo chmod -R 775 storage bootstrap/cache
   ```

4. **Install Dependencies**
   ```bash
   composer install --no-dev --optimize-autoloader
   npm install && npm run build
   ```

5. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   # Edit .env dengan nano atau vim
   ```

6. **Database**
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```

7. **Nginx Configuration**
   ```nginx
   server {
       listen 80;
       server_name yourdomain.com;
       root /var/www/kalkayu-living/public;

       add_header X-Frame-Options "SAMEORIGIN";
       add_header X-Content-Type-Options "nosniff";

       index index.php;

       charset utf-8;

       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }

       location = /favicon.ico { access_log off; log_not_found off; }
       location = /robots.txt  { access_log off; log_not_found off; }

       error_page 404 /index.php;

       location ~ \.php$ {
           fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
           fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
           include fastcgi_params;
       }

       location ~ /\.(?!well-known).* {
           deny all;
       }
   }
   ```

8. **Enable Site & Restart**
   ```bash
   sudo ln -s /etc/nginx/sites-available/kalkayu /etc/nginx/sites-enabled/
   sudo nginx -t
   sudo systemctl restart nginx
   ```

9. **SSL Certificate (Let's Encrypt)**
   ```bash
   sudo apt install certbot python3-certbot-nginx
   sudo certbot --nginx -d yourdomain.com
   ```

## 🔄 Post-Deployment

### 1. Verify Installation

- [ ] Website dapat diakses
- [ ] Assets (CSS/JS) ter-load
- [ ] Gambar dapat di-upload
- [ ] Login admin berfungsi
- [ ] CRUD operations berfungsi

### 2. Setup Monitoring

- [ ] Setup error logging
- [ ] Setup uptime monitoring
- [ ] Setup backup otomatis
- [ ] Setup SSL monitoring

### 3. Performance

- [ ] Enable OPcache
- [ ] Setup Redis/Memcached (opsional)
- [ ] Enable Gzip compression
- [ ] Optimize images

### 4. Backup Strategy

```bash
# Database backup
mysqldump -u username -p database_name > backup_$(date +%Y%m%d).sql

# Files backup
tar -czf backup_$(date +%Y%m%d).tar.gz /var/www/kalkayu-living
```

Setup cron job untuk backup otomatis:
```bash
# Backup database setiap hari jam 2 pagi
0 2 * * * mysqldump -u user -p'password' dbname > /backups/db_$(date +\%Y\%m\%d).sql
```

## 🐛 Troubleshooting

### Error: 500 Internal Server Error
```bash
# Check logs
tail -f storage/logs/laravel.log

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Error: Storage link not working
```bash
# Remove old link
rm public/storage

# Create new link
php artisan storage:link
```

### Error: Permission denied
```bash
# Fix permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Error: Mix manifest not found
```bash
# Rebuild assets
npm install
npm run build
```

## 📊 Monitoring

### Log Files
```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Nginx access logs
tail -f /var/log/nginx/access.log

# Nginx error logs
tail -f /var/log/nginx/error.log
```

### Performance Monitoring
- Setup Google Analytics
- Setup error tracking (Sentry, Bugsnag)
- Monitor server resources (CPU, RAM, Disk)

## 🔐 Security Hardening

- [ ] Disable directory listing
- [ ] Hide Laravel version
- [ ] Setup firewall (UFW)
- [ ] Regular security updates
- [ ] Strong database passwords
- [ ] Limit login attempts
- [ ] Setup fail2ban

## 📝 Maintenance

### Regular Tasks
- [ ] Update dependencies: `composer update`
- [ ] Check security advisories
- [ ] Monitor disk space
- [ ] Review error logs
- [ ] Test backups
- [ ] Update content

### Update Procedure
```bash
# Backup first!
php artisan down
git pull origin main
composer install --no-dev
npm install && npm run build
php artisan migrate --force
php artisan optimize
php artisan up
```

## ✅ Final Checklist

- [ ] Website accessible via domain
- [ ] SSL certificate installed
- [ ] Admin panel accessible
- [ ] All features working
- [ ] Backups configured
- [ ] Monitoring setup
- [ ] Documentation updated
- [ ] Client training completed

---

**Deployment Date:** _____________  
**Deployed By:** _____________  
**Domain:** _____________  
**Server:** _____________

🎉 **Deployment Complete!**
