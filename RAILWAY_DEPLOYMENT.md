# Railway Deployment Guide - KalKayu Living

## Prerequisites
- Railway account (https://railway.app)
- GitHub repository with this Laravel project
- MySQL database (Railway provides this)

## PHP Version
This project uses **PHP 8.2** (configured via `.php-version` file)

## Environment Variables Required

Set these in Railway dashboard:

```env
APP_NAME="KalKayu Living"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
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

## Deployment Steps

### 1. Create New Project on Railway
1. Go to https://railway.app
2. Click "New Project"
3. Select "Deploy from GitHub repo"
4. Choose your repository

### 2. Add MySQL Database
1. In your project, click "New"
2. Select "Database" → "Add MySQL"
3. Railway will automatically create database and provide credentials

### 3. Link Database to Laravel Service
1. Go to your Laravel service
2. Click "Variables" tab
3. Click "Add Reference" and select MySQL variables
4. Railway will auto-populate DB_HOST, DB_PORT, etc.

### 4. Add Additional Environment Variables
Add these manually:
- APP_NAME
- APP_ENV=production
- APP_KEY (generate with `php artisan key:generate --show`)
- APP_DEBUG=false
- APP_URL (your Railway URL)
- SESSION_DRIVER=file
- QUEUE_CONNECTION=sync
- LOG_CHANNEL=stack
- LOG_LEVEL=error
- FILESYSTEM_DISK=public

### 5. Deploy
1. Railway will automatically deploy when you push to GitHub
2. First deployment will run migrations automatically (via Procfile)
3. Check logs for any errors

### 6. Storage Link (Important!)
After first deployment, you need to create storage link.

Option A - Via Railway CLI:
```bash
railway run php artisan storage:link
```

Option B - Via Railway Shell:
1. Go to your service in Railway
2. Click "Shell" tab
3. Run: `php artisan storage:link`

## Post-Deployment

### Run Seeders (Optional)
If you want to seed initial data:
```bash
railway run php artisan db:seed
```

Or specific seeder:
```bash
railway run php artisan db:seed --class=FeatureSeeder
railway run php artisan db:seed --class=GallerySeeder
railway run php artisan db:seed --class=PromoProductSeeder
```

### Create Admin User
You can create admin via tinker:
```bash
railway run php artisan tinker
```
Then:
```php
User::create([
    'name' => 'Admin',
    'email' => 'admin@kalkayu.com',
    'password' => bcrypt('password123')
]);
```

## Troubleshooting

### Issue: 500 Error
- Check logs in Railway dashboard
- Verify all environment variables are set
- Ensure APP_KEY is generated and set
- Check if migrations ran successfully

### Issue: Database Connection Failed
- Verify DB credentials are linked from MySQL service
- Check if MySQL service is running
- Try using Railway's reference variables (${{MYSQLHOST}}, etc.)

### Issue: Storage/Images Not Loading
- Run `php artisan storage:link` via Railway CLI or Shell
- Verify FILESYSTEM_DISK=public is set
- Check APP_URL is correct (should be your Railway URL)
- Make sure storage folder has write permissions

### Issue: Migration Failed
- Check database credentials
- Manually run: `railway run php artisan migrate --force`
- Check if database exists and is accessible

### Issue: Build Failed (nixpacks error)
- Railway auto-detects Laravel and uses PHP 8.2 (from .php-version)
- If issues persist, check Railway build logs
- Ensure composer.json requires PHP ^8.2

### Issue: Assets Not Loading
- Check if APP_URL matches your Railway domain
- Verify public folder is accessible
- Check if vite build ran (if using Vite)

## Important Notes

1. **PHP Version**: This project uses PHP 8.2 (configured in .php-version and composer.json)
2. **Auto Migration**: Migrations run automatically on deployment (via Procfile release command)
3. **Cache**: Config, routes, and views are cached for performance (via nixpacks.json)
4. **Storage**: MUST run `php artisan storage:link` after first deployment
5. **Environment**: Always use `APP_ENV=production` and `APP_DEBUG=false` in production
6. **Database**: Use Railway's MySQL reference variables for automatic credential management

## Useful Railway Commands

```bash
# View logs
railway logs

# Run artisan commands
railway run php artisan migrate
railway run php artisan db:seed
railway run php artisan storage:link
railway run php artisan cache:clear

# SSH into container
railway shell

# Link to project (first time)
railway link
```

## File Structure for Railway

```
.
├── .php-version          # Specifies PHP 8.2
├── nixpacks.json         # Build configuration
├── railway.json          # Railway-specific config
├── Procfile              # Process definitions (web + release)
├── .railwayignore        # Files to exclude from deployment
└── composer.json         # PHP dependencies (requires PHP ^8.2)
```

## Support

For Railway-specific issues, check:
- Railway Docs: https://docs.railway.app
- Railway Discord: https://discord.gg/railway
- Railway Status: https://status.railway.app

For Laravel issues:
- Laravel Docs: https://laravel.com/docs
- Laravel Discord: https://discord.gg/laravel

