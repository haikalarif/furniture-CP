# Railway Deployment Guide - KalKayu Living

## Prerequisites
- Railway account (https://railway.app)
- GitHub repository with this Laravel project
- MySQL database (Railway provides this)

## Environment Variables Required

Set these in Railway dashboard:

```env
APP_NAME="KalKayu Living"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app.railway.app

DB_CONNECTION=mysql
DB_HOST=YOUR_RAILWAY_MYSQL_HOST
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=YOUR_RAILWAY_MYSQL_PASSWORD

SESSION_DRIVER=file
QUEUE_CONNECTION=sync

LOG_CHANNEL=stack
LOG_LEVEL=error
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

### 3. Configure Environment Variables
1. Go to your Laravel service
2. Click "Variables" tab
3. Add all required environment variables above
4. Use the MySQL credentials from Railway database service

### 4. Generate APP_KEY
Run locally:
```bash
php artisan key:generate --show
```
Copy the output and set as APP_KEY in Railway

### 5. Deploy
1. Railway will automatically deploy when you push to GitHub
2. First deployment will run migrations automatically
3. Check logs for any errors

### 6. Storage Link (Important!)
After first deployment, run this command in Railway CLI or add to build:
```bash
php artisan storage:link
```

## Post-Deployment

### Run Seeders (Optional)
If you want to seed initial data:
```bash
php artisan db:seed
```

### Create Admin User
Create your first admin user via tinker or seeder.

## Troubleshooting

### Issue: 500 Error
- Check logs in Railway dashboard
- Verify all environment variables are set
- Ensure APP_KEY is generated and set

### Issue: Database Connection Failed
- Verify DB credentials from Railway MySQL service
- Check DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD

### Issue: Storage/Images Not Loading
- Run `php artisan storage:link`
- Verify storage folder permissions
- Check APP_URL is correct

### Issue: Migration Failed
- Check database credentials
- Manually run: `php artisan migrate --force`

## Important Notes

1. **PHP Version**: This project uses PHP 8.2 (configured in nixpacks.toml)
2. **Auto Migration**: Migrations run automatically on deployment (via Procfile)
3. **Cache**: Config, routes, and views are cached for performance
4. **Storage**: Make sure to run `php artisan storage:link` after deployment
5. **Environment**: Always use `APP_ENV=production` and `APP_DEBUG=false` in production

## Useful Railway Commands

```bash
# View logs
railway logs

# Run artisan commands
railway run php artisan migrate

# SSH into container
railway shell
```

## Support

For Railway-specific issues, check:
- Railway Docs: https://docs.railway.app
- Railway Discord: https://discord.gg/railway
