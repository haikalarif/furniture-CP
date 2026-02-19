@echo off
echo ========================================
echo Railway Setup Helper
echo ========================================
echo.

echo [1/6] Running migrations...
railway run php artisan migrate --force
if %errorlevel% neq 0 (
    echo ERROR: Migration failed!
    pause
    exit /b 1
)
echo ✓ Migration completed
echo.

echo [2/6] Creating storage link...
railway run php artisan storage:link --force
if %errorlevel% neq 0 (
    echo ERROR: Storage link failed!
    pause
    exit /b 1
)
echo ✓ Storage link created
echo.

echo [3/6] Clearing cache...
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan view:clear
echo ✓ Cache cleared
echo.

echo [4/6] Running seeders (optional)...
set /p run_seeder="Run database seeders? (y/n): "
if /i "%run_seeder%"=="y" (
    railway run php artisan db:seed --force
    echo ✓ Seeders completed
) else (
    echo ✓ Seeders skipped
)
echo.

echo [5/6] Checking storage directories...
railway run ls -la storage/app/public
echo.

echo [6/6] Checking public/storage symlink...
railway run ls -la public/storage
echo.

echo ========================================
echo Setup completed!
echo ========================================
echo.
echo Next steps:
echo 1. Check if images appear on website
echo 2. Try to login at /login
echo 3. If login fails, create admin user with: railway-create-admin.bat
echo.
pause
